<?php declare(strict_types=1);

namespace NormTools\Creater;

use Exception;
use PDO;

abstract class BaseOrmCreator
{
    protected string $basePath = __DIR__ . '/../../';
    protected string $modelNamespace;
    protected string $mapperNamespace;
    protected string $currentNamespace;
    /** @var string 创建的类名 */
    protected string $modelClassName;
    /** @var string mapper 的类名 */
    protected string $mapperClassName;
    /** @var string 关联的表名 */
    protected string $tableName;
    /** @var string 新建问价的完整路径 */
    protected string $filePath = '';
    /** @var string 新建类所在目录的完整路径 */
    protected string $dirPath = '';

    /**
     * @var DbProperty[]
     */
    protected array $properties = [];

    /**
     * @param string $className
     * @param string $tableName
     * @param string $baseDir
     * @param string $subDir
     * @throws Exception
     */
    public function __construct(string $className, string $tableName, string $baseDir = 'app/orm/', string $subDir = '')
    {
        if (!$className || !$tableName) {
            throw new Exception('param lost');
        }
        $this->parseDBTable($tableName);
        $this->modelClassName = $className;
        $this->mapperClassName = $className . 'Mapper';
        //$this->tableName = $tableName;
        $this->modelNamespace = trim($this->commonBuildNamespace($baseDir, $subDir, 'Model'), '\\');
        $this->mapperNamespace = trim($this->commonBuildNamespace($baseDir, $subDir, 'Mapper'), '\\');
        $this->currentNamespace = trim($this->buildCurrentClassNamespace($baseDir, $subDir), '\\');
        $this->dirPath = $this->namespace2Dir($this->currentNamespace);
        if (!$this->checkDir($this->dirPath)) {
            throw new Exception('mkdir failed');
        }
    }

    protected function getFullFilePath(string $className): string
    {
        return $this->dirPath . '/' . $className . '.php';
    }

    /**
     * 文件目录转换为 namespace
     *
     * @param string $dir
     * @return string
     */
    protected function dir2Namespace(string $dir): string
    {
        return str_replace('/', '\\', trim($dir, '/'));
    }

    /**
     * namespace 转换为目录路径
     *
     * @param string $namespace
     * @return string
     */
    protected function namespace2Dir(string $namespace): string
    {
        return str_replace('\\', '/', trim($namespace, '\\'));
    }

    /**
     * 组装完整的 namespace
     *
     * @param string $baseDir
     * @param string $subDir
     * @return string
     */
    protected function buildCurrentClassNamespace(string $baseDir, string $subDir): string
    {
        return $this->commonBuildNamespace($baseDir, $subDir, $this->classType);
    }

    /**
     * @param string $baseDir
     * @param string $subDir
     * @param string $middle
     * @return string
     */
    protected function commonBuildNamespace(string $baseDir, string $subDir, string $middle): string
    {
        return $this->dir2Namespace($baseDir) . '\\' . $middle . '\\' . $this->dir2Namespace($subDir);
    }

    /**
     * @param string $dirPath
     * @return bool
     */
    protected function checkDir(string $dirPath): bool
    {
        if (!is_dir($dirPath)) {
            return mkdir($dirPath, 0777, true);
        }
        return true;
    }

    /**
     * 写文件结尾
     *
     * @param $fp
     */
    protected function writeFinish($fp)
    {
        fwrite($fp, "}\n");
    }

    /**
     * 解析数据表字段类型，只返回 int 或 string
     *
     * @param string $typeStr
     * @return string
     */
    protected function parseDbFieldType(string $typeStr): string
    {
        if (strstr($typeStr, 'int') !== false || $typeStr == 'bit(1)') {
            return 'int';
        } else {
            return 'string';
        }
    }

    /**
     * 解析数据表字段默认值，只返回 0 或 ''
     *
     * @param string $fieldType
     * @return int|string
     */
    protected function dbDefaultVal(string $fieldType)
    {
        return $fieldType == 'int' ? 0 : "''";
    }

    /**
     * 解析数据表字段名，转换为驼峰法变量
     *
     * @param string $fieldName
     * @return string
     */
    protected function parseFieldName(string $fieldName): string
    {
        $arr = explode('_', $fieldName);
        $arr = array_map(function ($each) {
            return ucfirst($each);
        }, $arr);
        return lcfirst(implode($arr));
    }

    /**
     * 获取配置文件地址
     *
     * @param string $suffix
     * @return string
     */
    protected function getDbEnvFileStr(string $suffix): string
    {
        $dir = $this->basePath;
        if (!file_exists($dir . $suffix)) {
            $dir = $dir . '../../../';
        }
        if (!file_exists($dir . $suffix)) {
            $dir = '';
        }
        return $dir ? $dir . $suffix : '';
    }

    /**
     * 从配置文件中解析出 db 配置
     *
     * @param string $tableName
     * @return DbProperty[]
     * @throws Exception
     */
    protected function parseDBTable(string $tableName): array
    {
        $suffix = '.norm-db.env';
        $envFile = $this->getDbEnvFileStr($suffix);
        if (!$envFile) {
            throw new Exception('无法找到数据配置文件，请在项目根目录下创建 ' . $suffix . ' 配置文件，详细信息参考 README');
        }
        $dbConf = parse_ini_file($envFile, true);
        $dbConf = $dbConf['DATABASE'] ?? [];
        $host = $dbConf['HOSTNAME'] ?? '';
        $port = $dbConf['HOSTPORT'] ?? 3306;
        $user = $dbConf['USERNAME'] ?? '';
        $pass = $dbConf['PASSWORD'] ?? '';
        $base = $dbConf['DATABASE'] ?? '';

        // 兼容 database.table 格式的参数
        $tableNameArr = explode('.', $tableName);
        if (count($tableNameArr) == 2) {
            $tableName = $tableNameArr[1] ?? '';
            $base = $tableNameArr[0] ?? '';
        }
        $this->tableName = $tableName;
        $pdo = new PDO("mysql:host=$host;sort=$port;dbname=$base;", $user, $pass);
        $stmt = $pdo->prepare('DESCRIBE ' . $tableName);
        $stmt->execute();
        $fields = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($fields as $field) {
            $dbField = $field['Field'] ?? '';
            $fieldName = $this->parseFieldName($dbField);
            $fieldType = $this->parseDbFieldType($field['Type']);
            $this->properties[] = new DbProperty($dbField, $fieldType, $fieldName);
        }
        return $this->properties;
    }

    /**
     * 移动文件指针到指定行数
     *
     * @param resource $fp
     * @param          $endLine
     */
    protected function moveCursor($fp, $endLine)
    {
        $line = 0;
        while (!feof($fp)) {
            ++$line;
            if ($line == $endLine) {
                break;
            }
            fgets($fp);
        }
    }

    /**
     * @param string $fileName
     * @param string $type
     * @return false|string
     */
    protected function getFile(string $fileName, string $type)
    {
        return file_get_contents(__DIR__ . '/../schema/' . $type . '/' . $fileName);
    }

    /**
     * @return bool
     */
    public function checkFileExist(): bool
    {
        return file_exists($this->filePath);
    }

    public function getResFilePath(): string
    {
        return $this->filePath;
    }
}

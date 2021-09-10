<?php declare(strict_types=1);

namespace tools\creator;

use Exception;
use PDO;

abstract class BaseOrmCreator
{
    protected string $basePath = __DIR__ . '/../../';
    protected string $modelNamespace;
    protected string $mapperNamespace;
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
        if (!$className) {
            throw new Exception('param lost');
        }
        $this->modelClassName = $className;
        $this->mapperClassName = $className . 'Mapper';
        $this->tableName = $tableName;
        $this->modelNamespace = trim($this->commonBuildNamespace($baseDir, $subDir, 'Model'), '\\');
        $this->mapperNamespace = trim($this->commonBuildNamespace($baseDir, $subDir, 'Mapper'), '\\');
        $currentNamespace = trim($this->buildCurrentClassNamespace($baseDir, $subDir), '\\');
        $this->dirPath = $this->namespace2Dir($currentNamespace);
        if (!$this->checkDir($this->dirPath)) {
            throw new Exception('mkdir failed');
        }

        $this->filePath = $this->getFullFilePath($this->classType);
        $tableName && $this->parseDBTable($tableName);
    }

    protected function getFullFilePath(string $type): string
    {
        switch ($type) {
            case 'Mapper':
                $className = $this->mapperClassName;
                break;
            case 'Model':
            default:
                $className = $this->modelClassName;
                break;
        }
        $filePath = $this->dirPath . '/' . $className . '.php';
        if (file_exists($filePath)) {
            throw new Exception('file exists: ' . $filePath);
        }
        return $filePath;
    }

    //abstract protected function buildBaseContent(string $className, string $baseModelName);

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
        return strstr($typeStr, 'int') !== false ? 'int' : 'string';
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
     * 从配置文件中解析出 db 配置
     *
     * @param string $tableName
     * @return DbProperty[]
     */
    protected function parseDBTable(string $tableName): array
    {
        $dbConf = parse_ini_file($this->basePath . '.env', true);
        $dbConf = $dbConf['DATABASE'] ?? [];
        $host = $dbConf['HOSTNAME'] ?? '';
        $port = $dbConf['HOSTPORT'] ?? 3306;
        $user = $dbConf['USERNAME'] ?? '';
        $pass = $dbConf['PASSWORD'] ?? '';
        $base = $dbConf['DATABASE'] ?? '';
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
}

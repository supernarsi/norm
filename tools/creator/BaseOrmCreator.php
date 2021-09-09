<?php declare(strict_types=1);

namespace tools\creator;

use Exception;
use PDO;

abstract class BaseOrmCreator
{
    protected string $basePath = __DIR__ . '/../../';
    protected string $namespace;
    protected string $className;
    protected string $tableName;
    protected string $filePath = '';
    protected string $dirPath = '';

    /**
     * @var DbProperty[]
     */
    protected array $properties = [];

    abstract protected function fileExist();

    abstract protected function writeBaseContent(string $className, string $baseModelName);

    /**
     * @param string $className
     * @param string $tableName
     * @param string $newFileDirPath
     * @throws Exception
     */
    public function __construct(string $className, string $tableName, string $newFileDirPath = 'app/orm/')
    {
        if (!$className || !$tableName) {
            throw new Exception('param lost');
        }
        $this->className = $className;
        $this->tableName = $tableName;
        $this->dirPath = $newFileDirPath;
        $this->namespace = str_replace('/', '\\', $newFileDirPath);
        $this->filePath = $this->fileExist();
        $this->parseDBTable($tableName);
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
}

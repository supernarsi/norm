<?php declare(strict_types=1);

namespace tools\creator;

use Exception;

class OrmModelCreator extends BaseOrmCreator
{
    /**
     * 构造 Model 的单个属性的文件内容
     *
     * @param string $fieldName
     * @param string $fieldType
     * @return string
     */
    private function buildProperty(string $fieldName, string $fieldType): string
    {
        $fieldType = $this->parseDbFieldType($fieldType);
        $val = $this->dbDefaultVal($fieldType);
        $content = $this->getFile('class_property_content');
        $content = str_replace('{{fieldName}}', $fieldName, $content);
        $content = str_replace('{{fieldType}}', $fieldType, $content);
        return str_replace('{{val}}', $val, $content);
    }

    /**
     * 构造 Model 的 get 方法文件内容
     *
     * @param string $property
     * @param string $type
     * @return string
     */
    private function buildGetFunction(string $property, string $type): string
    {
        $functionName = 'get' . ucfirst($property);
        $content = $this->getFile('get_function_content');
        $content = str_replace('{{type}}', $type, $content);
        $content = str_replace('{{property}}', $property, $content);
        return str_replace('{{functionName}}', $functionName, $content);
    }

    /**
     * 构造 Model 类的 set 方法的文件内容
     *
     * @param string $property
     * @param string $type
     * @param string $className
     * @return string
     */
    private function buildSetFunction(string $property, string $type, string $className): string
    {
        $functionName = 'set' . ucfirst($property);
        $content = $this->getFile('set_function_content');
        $content = str_replace('{{functionName}}', $functionName, $content);
        $content = str_replace('{{type}}', $type, $content);
        $content = str_replace('{{property}}', $property, $content);
        return str_replace('{{className}}', $className, $content);
    }

    /**
     * 将所有属性组合
     *
     * @return string
     */
    private function buildPropertiesContent(): string
    {
        $str = '';
        foreach ($this->properties as $item) {
            $str .= ($this->buildProperty($item->getModelFieldName(), $item->getDocument()) . PHP_EOL);
        }
        return $str;
    }

    /**
     * 构造 render 方法的内容
     *
     * @return string
     */
    private function buildRenderContent(): string
    {
        $str = '';
        foreach ($this->properties as $property) {
            $modelFieldName = $property->getModelFieldName();
            $fieldName = $property->getDbFieldName();
            $functionName = 'get' . ucfirst($modelFieldName);
            $str .= <<<renderdata
            '$fieldName' => \$this->$functionName(),\n
renderdata;
        }
        $content = $this->getFile('render_content');
        return str_replace('{{renderContent}}', $str, $content);
    }

    /**
     * 将属性内容写入文件
     *
     * @param $fp
     */
    protected function writePropertiesContent($fp)
    {
        fwrite($fp, $this->buildPropertiesContent());
    }

    /**
     * 将单个属性对应的 set 和 get 方法写入文件
     *
     * @param $fp
     * @param string $propertyName
     * @param string $type
     */
    protected function writeSetAndGetFunc($fp, string $propertyName, string $type)
    {
        $str = $this->buildGetFunction($propertyName, $type) . "\n";
        fwrite($fp, $str);
        $str = $this->buildSetFunction($propertyName, $type, $this->className) . "\n";
        fwrite($fp, $str);
    }

    /**
     * 写入所有属性的 set 和 get 方法
     *
     * @param $fp
     */
    protected function writeSetGetProperties($fp)
    {
        fwrite($fp, PHP_EOL);
        foreach ($this->properties as $property) {
            $this->writeSetAndGetFunc($fp, $property->getModelFieldName(), $property->getDocument());
        }
    }

    /**
     * 写 render 方法
     *
     * @param $fp
     */
    protected function writeRenderContent($fp)
    {
        fwrite($fp, $this->buildRenderContent());
    }

    /**
     * @throws Exception
     */
    protected function fileExist(): string
    {
        $className = $this->className;
        $dirPath = $this->basePath . $this->dirPath . '/';
        $filePath = $dirPath . $className . '.php';
        if (file_exists($filePath)) {
            throw new Exception('file exists: ' . $filePath);
        }
        // 不存在则创建文件
        $newClassFile = fopen($filePath, "w");
        // 创建类文件
        $baseContent = $this->writeBaseContent($className, 'Model');
        fwrite($newClassFile, $baseContent);
        return $filePath;
    }

    /**
     * 写 Model 类的基础代码
     *
     * @param string $className
     * @param string $baseModelName
     * @return string
     */
    public function writeBaseContent(string $className, string $baseModelName): string
    {
        $namespace = trim($this->namespace, '/');
        $baseContent = $this->getFile('base_content');
        $baseContent = str_replace('{{namespace}}', $namespace, $baseContent);
        $baseContent = str_replace('{{className}}', $className, $baseContent);
        return str_replace('{{baseModelName}}', $baseModelName, $baseContent);
    }

    /**
     * 创建文件
     */
    public function createField()
    {
        // 打开文件
        $fp = fopen($this->filePath, 'r+');
        $this->moveCursor($fp, 9);
        // 写属性内容
        $this->writePropertiesContent($fp);
        $this->writeSetGetProperties($fp);
        $this->writeRenderContent($fp);
        $this->writeFinish($fp);
    }

    /**
     * @param string $fileName
     * @return false|string
     */
    protected function getFile(string $fileName)
    {
        return file_get_contents(__DIR__ . '/../schema/model/' . $fileName);
    }
}

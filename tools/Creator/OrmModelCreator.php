<?php declare(strict_types=1);

namespace NormTools\Creator;

use Exception;
use NormTools\Exception\NormException;

class OrmModelCreator extends BaseOrmCreator
{
    protected string $classType = 'Model';

    protected function getModelFile(string $file)
    {
        return $this->getFile($file, 'model');
    }

    /**
     * 写 Model 类的基础代码
     *
     * @param string $className
     * @return string
     * @throws NormException
     */
    private function buildBaseContent(string $className): string
    {
        $baseContent = $this->getModelFile('base_content');
        if ($baseContent === false) {
            throw new NormException("base_content file not found");
        }
        try {
            $baseContent = str_replace('{{namespace}}', $this->modelNamespace, $baseContent);
            return str_replace('{{className}}', $className, $baseContent);
        } catch (Exception $e) {
            throw new NormException($e->getMessage());
        }
    }

    /**
     * 构造 Model 的单个属性的文件内容
     *
     * @param string $fieldName
     * @param string $fieldType
     * @return string
     * @throws NormException
     */
    private function buildProperty(string $fieldName, string $fieldType): string
    {
        $fieldType = $this->parseDbFieldType($fieldType);
        $val = $this->dbDefaultVal($fieldType);
        $content = $this->getModelFile('class_property_content');
        if ($content === false) {
            throw new NormException("class_property_content file not found");
        }
        try {
            $content = str_replace('{{fieldName}}', $fieldName, $content);
            $content = str_replace('{{fieldType}}', $fieldType, $content);
            return str_replace('{{val}}', $val, $content);
        } catch (Exception $e) {
            throw new NormException($e->getMessage());
        }
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
        $content = $this->getModelFile('get_function_content');
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
        $content = $this->getModelFile('set_function_content');
        $content = str_replace('{{functionName}}', $functionName, $content);
        $content = str_replace('{{type}}', $type, $content);
        $content = str_replace('{{property}}', $property, $content);
        return str_replace('{{className}}', $className, $content);
    }

    /**
     * 将所有属性组合
     *
     * @return string
     * @throws NormException
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
            $str .= "            '$fieldName' => \$this->$functionName(),\n";
        }
        $content = $this->getModelFile('render_content');
        return str_replace('{{renderContent}}', $str, $content);
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
        fwrite($fp, $this->buildGetFunction($propertyName, $type) . "\n");
        fwrite($fp, $this->buildSetFunction($propertyName, $type, $this->modelClassName) . "\n");
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
     * 创建文件
     *
     * @return bool
     * @throws NormException
     */
    public function createField(): bool
    {
        $this->filePath = $this->getFullFilePath($this->modelClassName);
        if ($this->checkFileExist()) {
            throw new NormException("{$this->modelClassName} already exists");
        }
        // 不存在则创建文件
        $fp = fopen($this->filePath, "w");
        if ($fp === false) {
            throw new NormException("{$this->modelClassName} create failed");
        }
        // 写文件基础内容
        fwrite($fp, $this->buildBaseContent($this->modelClassName));
        // 写属性内容
        fwrite($fp, $this->buildPropertiesContent());
        // 写 set & get 方法
        $this->writeSetGetProperties($fp);
        // 写 render 方法
        fwrite($fp, $this->buildRenderContent());
        $this->writeFinish($fp);
        return true;
    }
}

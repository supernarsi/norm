<?php declare(strict_types=1);

namespace tools\creator;

class OrmMapperCreator extends BaseOrmCreator
{
    protected string $classType = 'Mapper';

    /**
     * Mapper 文件路径
     *
     * @param string $file
     * @return string
     */
    protected function getModelFile(string $file): string
    {
        return $this->getFile($file, 'mapper');
    }

    /**
     * 构建 Mapper 文件基础内容
     *
     * @return string
     */
    protected function buildBaseContent(): string
    {
        $baseContent = $this->getModelFile('base_content');
        $baseContent = str_replace('{{namespace}}', $this->mapperNamespace, $baseContent);
        $modelFullClass = trim($this->modelNamespace . '\\' . $this->modelClassName, '\\');
        $baseContent = str_replace('{{modelFullClass}}', $modelFullClass, $baseContent);
        return str_replace('{{mapperClassName}}', $this->mapperClassName, $baseContent);
    }

    /**
     * 构建文件类属性内容
     *
     * @return string
     */
    protected function buildFieldsContent(): string
    {
        $tableName = $this->tableName;
        $content = $this->getModelFile('base_fields_content');
        $content = str_replace('{{modelClassName}}', $this->modelClassName, $content);
        return str_replace('{{tableName}}', $tableName, $content);
    }

    private function buildSetFunc(DbProperty $property): string
    {
        $funcName = 'set' . ucfirst($property->getModelFieldName());
        $dbField = $property->getDbFieldName();
        $typeOf = $this->parseDbFieldType($property->getDocument());
        $defaultVal = $this->dbDefaultVal($typeOf);
        return "        \$model->$funcName(($typeOf)(\$data['$dbField'] ?? $defaultVal));\n";
    }

    private function buildField2GetFunc(DbProperty $property): string
    {
        $dbField = $property->getDbFieldName();
        $field = $property->getModelFieldName();
        $funcName = 'get' . ucfirst($field);
        return "        \$model->modelPropertyIsSet('$field') && \$dbFields['$dbField'] = \$model->$funcName();\n";
    }

    protected function buildInitModelFunc()
    {
        $tmpStr = '';
        foreach ($this->properties as $property) {
            $tmpStr .= $this->buildSetFunc($property);
        }
        $content = $this->getModelFile('init_model_content');
        $content = str_replace('{{modelClassName}}', $this->modelClassName, $content);
        return str_replace('{{initContent}}', $tmpStr, $content);
    }

    protected function buildPrepareSaveFunc()
    {
        $tmpStr = '';
        foreach ($this->properties as $property) {
            $tmpStr .= $this->buildField2GetFunc($property);
        }
        $content = $this->getModelFile('prepare_save_func_content');
        $content = str_replace('{{modelClassName}}', $this->modelClassName, $content);
        return str_replace('{{content}}', $tmpStr, $content);
    }

    public function createField(): bool
    {
        $this->filePath = $this->getFullFilePath($this->mapperClassName);
        if ($this->checkFileExist()) {
            return false;
        }
        // 不存在则创建文件
        $fp = fopen($this->filePath, "w");
        // 写文件基础内容
        fwrite($fp, $this->buildBaseContent());
        // 写属性内容
        fwrite($fp, $this->buildFieldsContent());
        fwrite($fp, $this->buildInitModelFunc());
        fwrite($fp, $this->buildPrepareSaveFunc());
        $this->writeFinish($fp);
        return true;
    }
}

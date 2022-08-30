<?php declare(strict_types=1);

namespace NormTools\Creater;

class OrmSelectorCreator extends BaseOrmCreator
{
    protected string $classType = 'Selector';

    protected function getModelFile(string $file)
    {
        return $this->getFile($file, 'selector');
    }

    public function buildBaseContent(): string
    {
        $content = $this->getModelFile('selector_content');
        $selectorClassName = $this->modelClassName . 'Selector';
        $content = str_replace('{{namespace}}', $this->currentNamespace, $content);
        $content = str_replace('{{modelNamespace}}', $this->modelNamespace . '\\' . $this->modelClassName, $content);
        $content = str_replace('{{mapperNamespace}}', $this->mapperNamespace . '\\' . $this->mapperClassName, $content);
        $content = str_replace('{{modelClass}}', $this->modelClassName, $content);
        $content = str_replace('{{mapperClass}}', $this->mapperClassName, $content);
        $content = str_replace('{{selectorClass}}', $selectorClassName, $content);
        $content .= "\n";
        return $content;
    }

    /**
     * 创建文件
     */
    public function createField(): bool
    {
        $this->filePath = $this->getFullFilePath($this->modelClassName . 'Selector');
        if ($this->checkFileExist()) {
            return false;
        }
        // 不存在则创建文件
        $fp = fopen($this->filePath, "w");
        // 写文件基础内容
        fwrite($fp, $this->buildBaseContent());
        return true;
    }
}

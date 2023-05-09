<?php declare(strict_types=1);

namespace NormTools\Creator;

class DbProperty
{
    private string $dbFieldName;
    private string $document;
    private string $modelFieldName;

    /**
     * DbProperty constructor.
     *
     * @param string $dbFieldName
     * @param string $document
     * @param string $modelFieldName
     */
    public function __construct(string $dbFieldName, string $document, string $modelFieldName)
    {
        $this->dbFieldName = $dbFieldName;
        $this->document = $document;
        $this->modelFieldName = $modelFieldName;
    }

    /**
     * @return string
     */
    public function getDbFieldName(): string
    {
        return $this->dbFieldName;
    }

    /**
     * @return string
     */
    public function getDocument(): string
    {
        return $this->document;
    }

    /**
     * @return string
     */
    public function getModelFieldName(): string
    {
        return $this->modelFieldName;
    }
}

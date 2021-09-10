<?php declare(strict_types=1);

namespace tools\creator;

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
     * @param string $dbFieldName
     * @return DbProperty
     */
    public function setDbFieldName(string $dbFieldName): DbProperty
    {
        $this->dbFieldName = $dbFieldName;
        return $this;
    }

    /**
     * @return string
     */
    public function getDocument(): string
    {
        return $this->document;
    }

    /**
     * @param string $document
     * @return DbProperty
     */
    public function setDocument(string $document): DbProperty
    {
        $this->document = $document;
        return $this;
    }

    /**
     * @return string
     */
    public function getModelFieldName(): string
    {
        return $this->modelFieldName;
    }

    /**
     * @param string $modelFieldName
     * @return DbProperty
     */
    public function setModelFieldName(string $modelFieldName): DbProperty
    {
        $this->modelFieldName = $modelFieldName;
        return $this;
    }
}

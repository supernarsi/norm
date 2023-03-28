<?php declare(strict_types=1);

namespace tests\mock\Mapper\article;

use Norm\ORM\Mapper\BaseMapper;
use Norm\ORM\Model\Model;
use tests\mock\Model\article\Article;

class ArticleMapper extends BaseMapper
{
    protected static string $tableName = 'article';
    protected string $modelName = Article::class;

    public function getTableName(): string
    {
        return self::$tableName;
    }

    /**
     * @param Article $model
     * @return array
     */
    public function prepareSaveData(Model $model): array
    {
        $dbFields = ['id' => $model->getId()];
        $model->modelPropertyIsSet('id') && $dbFields['id'] = $model->getId();
        $model->modelPropertyIsSet('title') && $dbFields['title'] = $model->getTitle();
        return $dbFields;
    }

    /**
     * @param Article $model
     * @param array $data
     * @return Article
     */
    public function initModel(Model $model, array $data = []): Article
    {
        $model->setId((int)($data['id'] ?? 0));
        $model->setTitle((string)($data['title'] ?? ''));
        return $model;
    }
}

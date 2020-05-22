<?php
declare(strict_types=1);

namespace DailyNewspaper\Controller;

use League\Plates\Engine;
use Psr\Http\Message\ServerRequestInterface;
use DailyNewspaper\Model\DbClass;
use DailyNewspaper\Model\ArticleCRUD;

class GetArticle implements ControllerInterface
{
    protected $plates;
    private ArticleCRUD $articleCRUD;

    public function __construct(Engine $plates, ArticleCRUD $articleCRUD)
    {
        $this->plates = $plates;
        $this->articleCRUD = $articleCRUD;
    }

    public function execute(ServerRequestInterface $request)
    {
        $params = $request->getQueryParams();
        $article_id = intval($params['id']);
        echo $this->plates->render('article', ['article' => $this->articleCRUD::getOne($article_id)]);
    }
}
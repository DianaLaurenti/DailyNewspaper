<?php
declare(strict_types=1);

namespace DailyNewspaper\Controller;

use League\Plates\Engine;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use DailyNewspaper\Model\DbClass;
use DailyNewspaper\Model\ArticleCRUD;

class UpdateArticle extends ControllerBase
{
    private ArticleCRUD $articleCRUD;

    public function __construct(Engine $plates, ArticleCRUD $articleCRUD)
    {
        parent::__construct($plates);
        $this->articleCRUD = $articleCRUD;
    }

    public function execute(ServerRequestInterface $request)
    {
        if($request->getMethod()==='GET'){
            $params = $request->getQueryParams();
            $article_id = intval($params['id']);
            $a = $this->articleCRUD::getOne($article_id);
            echo $this->plates->render('update', ['article' => $a]);
        }
        else{
            $articleArray = $request->getParsedBody();
            $success = $this->articleCRUD::updateOne($articleArray);
            if($success){
                parent::redirect('/edit');
                exit();
            }
            parent::error(422, 'Non è stato possibile modificare l\'articolo.');
        }
    }
}
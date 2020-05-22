<?php
declare(strict_types=1);

namespace DailyNewspaper\Controller;

use League\Plates\Engine;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use DailyNewspaper\Model\DbClass;
use DailyNewspaper\Model\ArticleCRUD;

class UpdateArticle implements ControllerInterface
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
                $home = new EditArticle($this->plates, $this->articleCRUD);
                $home->execute($request);
                exit();
            }
            $request = $request->withHeader('errorMessage', 'Non è stato possibile modificare l\'articolo. Controlla che tutti i campi siano compilati e che il titolo sia unico.');             
            $error = new Error422($this->plates);
            $error->execute($request);
        }
    }
}
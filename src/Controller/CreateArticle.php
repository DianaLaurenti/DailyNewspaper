<?php
declare(strict_types=1);

namespace DailyNewspaper\Controller;

use League\Plates\Engine;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use DailyNewspaper\Model\DbClass;
use DailyNewspaper\Model\ArticleCRUD;

class CreateArticle extends ControllerBase
{
    private ArticleCRUD $articleCRUD;

    public function __construct(Engine $plates, ArticleCRUD $articleCRUD)
    {
        parent::__construct($plates);
        $this->articleCRUD = $articleCRUD;
    }

    public function execute(ServerRequestInterface $request)
    {
        if($request->getMethod() === 'GET')
        {
            echo $this->plates->render('create');
        }
        else
        {
            $articleArray = $request->getParsedBody();
            $success = $this->articleCRUD::createOne($articleArray);
            if(!$success)
            {
                parent::error($request, 'Non è stato possibile creare l\'articolo. Controlla che tutti i campi siano compilati e che il titolo sia unico.', 422);
                /* $uri = $request->getUri()->withPath('/');
                $newRequest = $request->withUri($uri);
                
                $newRequest = $newRequest->withHeader('errorMessage', 'Non è stato possibile creare l\'articolo. Controlla che tutti i campi siano compilati e che il titolo sia unico.');
                
                $error = new Error422($this->plates);
                $error->execute($newRequest); */
            }
            else
            {
                parent::redirect($request, 'GET', '/');
            }
        }
    }
}
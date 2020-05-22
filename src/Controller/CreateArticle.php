<?php
declare(strict_types=1);

namespace DailyNewspaper\Controller;

use League\Plates\Engine;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use DailyNewspaper\Model\DbClass;
use DailyNewspaper\Model\ArticleCRUD;

class CreateArticle implements ControllerInterface
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
                $uri = $request->getUri()->withPath('/');
                $newRequest = $request->withUri($uri);
                //var_dump($newRequest->getUri());
                $newRequest = $newRequest->withHeader('errorMessage', 'Non è stato possibile creare l\'articolo. Controlla che tutti i campi siano compilati e che il titolo sia unico.');
                
                $error = new Error422($this->plates);
                $error->execute($newRequest);
            }
            else
            {
                $home = new Home($this->plates, $this->articleCRUD);
                $home->execute($request);
            }
        }
    }
}
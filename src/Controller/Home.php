<?php
declare(strict_types=1);

namespace DailyNewspaper\Controller;

use League\Plates\Engine;
use Psr\Http\Message\ServerRequestInterface;
use DailyNewspaper\Model\DbClass;
use DailyNewspaper\Model\ArticleCRUD;

class Home implements ControllerInterface
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
        echo $this->plates->render('home', ['articles' => $this->articleCRUD::getAll()]);
    }
}
<?php
declare(strict_types=1);

namespace DailyNewspaper\Controller;

use League\Plates\Engine;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use DailyNewspaper\Model\DbClass;
use DailyNewspaper\Model\ArticleCRUD;

class EditArticle implements ControllerInterface
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
        echo $this->plates->render('edit', ['articles' => $this->articleCRUD::getAll(false)]);
    }
}
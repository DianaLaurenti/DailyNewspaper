<?php
declare(strict_types=1);

namespace DailyNewspaper\Controller;

use League\Plates\Engine;
use Psr\Http\Message\ServerRequestInterface;
use DailyNewspaper\Model\DbClass;
use DailyNewspaper\Model\Article;

class Home implements ControllerInterface
{
    protected $plates;
    private Article $article;

    public function __construct(Engine $plates, Article $article)
    {
        $this->plates = $plates;
        $this->article = $article;
    }

    public function execute(ServerRequestInterface $request)
    {
        echo $this->plates->render('home', ['articles' => $this->article->getTodayArticles()]);
    }
}
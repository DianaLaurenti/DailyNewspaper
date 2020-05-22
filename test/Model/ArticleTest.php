<?php
declare(strict_types=1);

namespace DailyNewspaper\Test\Model;

use League\Plates\Engine;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ServerRequestInterface;
use DailyNewspaper\Model\ArticleCRUD;
use DailyNewspaper\Model\Article;
use PDO;

final class ArticleTest extends TestCase
{
    public function setUp(): void
    {
        $this->pdo = $this->createMock(PDO::class);
        $this->articleCRUD = new ArticleCRUD($this->pdo);
        //$this->request = $this->getMockBuilder(ServerRequestInterface::class)->getMock();
    }

    /**
     * @dataProvider getArticleArray 
     */    
    public function testArrayToArticleReturnsArray($array)
    {
        var_dump($array);      
        $newArticle = $this->articleCRUD::arrayToArticle($array);
        var_dump($newArticle);       
        $this->assertInstanceOf(Article::class, $newArticle);
    }
    public function getArticleArray()
    {
        return[
            [
                ["article_id"=>1,
                "date"=>"2020-05-20",
                "author"=>"Nome Cognome",
                "title"=>"Titolo",
                "content"=>"Contenuto"]
            ],
            [
                ["article_id"=>'2',
                "date"=>"2020-05-20",
                "title"=>"Titolo2",
                "content"=>"Contenuto@"]
            ]
        ];
    }

    /**
     * @dataProvider getNoArticleArray 
     */
    public function testArrayToArticleReturnsNull($array)
    {
        $newArticle = $this->articleCRUD::arrayToArticle($array); 
        var_dump($newArticle);   
        $this->assertTrue($newArticle == null);
    }
    public function getNoArticleArray()
    {
        return[
            [
                ["pomodoro"=>1,
                "date"=>"2020-05-20",
                "author"=>"Nome Cognome",
                "title"=>"Titolo",
                "content"=>"Contenuto"]
            ],
            [
                ["article_id"=>2,
                "date"=>"2020-05-20",
                "author"=>'1',
                "cosa"=>"Titolo2",
                "content"=>"Contenuto@"]
            ],
            [
                ["article_id"=>1,
                "date"=>"2020-05-20",
                "author"=>"Nome Cognome",
                "title"=>"Titolo",
                "content"=>"Contenuto",
                "cosa"=>"Titolo2"]
            ]
        ];
    }

    /* public function testGetTodayArticlesIsEmpty() : void
    {
        $this->assertEmpty($this->article->getTodayArticles());
    }

    public function testGetArticle(): void
    {
        $this->expectOutputString($this->plates->render('home'));
        $this->home->execute($this->request);
    } */
}

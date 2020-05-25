<?php
declare(strict_types=1);

namespace DailyNewspaper\Test\Model;

use League\Plates\Engine;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ServerRequestInterface;
use DailyNewspaper\Model\ArticleCRUD;
use DailyNewspaper\Model\Article;
use PDO;
use PDOStatement;

final class ArticleCRUDTest extends TestCase
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
        $newArticle = $this->articleCRUD::arrayToArticle($array);
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

    public function testGetOne() : void
    {
        $articleRow = new Article();
        $articleRow->setId(1);
        $articleRow->setDate("2020-05-25");
        $articleRow->setTitle("Fake news");
        $articleRow->setAuthor("Fake author");
        $articleRow->setContent("Fake content");

        $mockStmt = $this->getMockBuilder()
            ->setMethods(array("execute","fetchObject"))
            ->getMock();
        $mockStmt->expects($this->once())->method("execute")
            ->with($this->equalTo(array(':article_id' => 1)))
            ->will($this->returnValue("true"));
        $mockStmt->expects($this->once())->method("fetchObject")
            ->will($this->returnValue($articleRow));

        $mockPdo = $this->getMockBuilder(PDO::class)
            ->disableOriginalConstructor()
            ->setMethods(array("prepare"))
            ->getMock();
        $mockPdo->expects($this->once())->method("prepare")
            ->with($this->stringContains("SELECT article_id, date, title, author, content FROM articles WHERE article_id = :article_id;"))
            ->will($this->returnValue($mockStmt));
        
        var_dump($this->articleCRUD::getOne(1));
        $articleCRUD = new ArticleCRUD($mockPdo);
        $this->assertEquals($articleRow, $this->articleCRUD::getOne(1));    
    }
}

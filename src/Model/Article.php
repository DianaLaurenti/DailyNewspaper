<?php
declare(strict_types=1);

namespace DailyNewspaper\Model;

use PDO;
use PDOException;
use DailyNewspaper\Config;

class Article extends DbClass
{
    private int $article_id;
    private string $title;
    private string $author;
    private string $date;
    private string $content;

    public function getTodayArticles(): array
    {
        try {
            $stmt = $this->pdo->query("SELECT date, title, author, content FROM articles WHERE date = DATE('now');");
            $articles = [];
            while ($article = $stmt->fetchObject()) {
                $articles[] = $article;
            }
            return $this->getArticlesExtract($articles);
         } catch (PDOException $e) {
            var_dump($e);
            return [];
         }
    }

    private function getArticlesExtract($articles) : array 
    {
        if(0===count($articles)){
            return null;
        }
        $extracts = [];
        foreach($articles as $a)
        {
            $extracts[] = $a;
        }
        foreach($extracts as $e){
            $e->content = substr($a->content, 0, 400);
        }
        return $extracts;
    }

    public function getArticle(int $idArticle) : Article
    {

    }

    public function createArticle() : bool
    {

    }

    public function updateArticle(int $idArticle) : Article
    {

    }

    public function deleteArticle(int $idArticle) : Article
    {

    }
}
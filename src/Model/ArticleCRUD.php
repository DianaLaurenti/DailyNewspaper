<?php
declare(strict_types=1);

namespace DailyNewspaper\Model;

use PDOException;

class ArticleCRUD extends DbClass
{
    public static function arrayToArticle($arrayArticle): ?Article
    {
        $article = new Article();
        foreach ($arrayArticle as $key => $value)
        {
            if($value !== '' && isset($value))
            {
                switch($key)
                {
                    case 'article_id':
                        $article->setId((int)$value);
                        break;
                    case 'date':
                        $article->setDate($value);                    
                        break;
                    case 'author':
                        $article->setAuthor($value); 
                        break;
                    case 'title':
                        $article->setTitle($value); 
                        break;
                    case 'content':
                        $article->setContent($value); 
                        break;
                    default :
                        return null;
                }
            }
        }
        return $article;
    }

    private static function isValid(Article $article) : bool
    {
        if($article->getContent()===null 
            || $article->getTitle()===null
            || $article->getAuthor()===null)
        {
            return false;
        }
        return true;
    }

    public static function getAll(bool $today = true): array
    {
        if($today){
            $sql = "SELECT article_id, date, title, author, content FROM articles WHERE date = DATE('now');";
        }else{
            $sql = "SELECT article_id, date, title, author, content FROM articles ORDER BY date DESC;";
        }
        try {
            $stmt = self::$pdo->query($sql);
            $articles = [];
            while ($obj = $stmt->fetchObject()) {
                $articles[] = self::arrayToArticle($obj);
            }
            return self::getArticlesExtract($articles);
        } catch (PDOException $e) {
            return [];
        }
    }

    private static function getArticlesExtract($articles) : array 
    {
        if(count($articles) === 0){
            return [];
        }
        $extracts = [];
        foreach($articles as $a)
        {
            $extracts[] = $a;
        }
        foreach($extracts as $e){
            $e->setContent(substr($e->getContent(), 0, 400) . ' [...]');
        }
        return $extracts;
    }

    public static function getOne($idArticle) : ?Article
    {
        try {
            $stmt = self::$pdo->prepare("SELECT article_id, date, title, author, content "
                ."FROM articles WHERE article_id = :article_id;");
            $stmt->execute([':article_id' => $idArticle]);
            return self::arrayToArticle($stmt->fetchObject());
        } catch (PDOException $e) {
            var_dump($e);
            return null;
        }
    }

    public static function createOne($articleArray) : bool
    {
        $article = self::arrayToArticle($articleArray);
        if(self::isValid($article))
        {
            try{
                $sql = 'INSERT INTO articles(date,author,title,content) '
                . "VALUES(date('now'),:author,:title,:content)";
        
                $stmt = self::$pdo->prepare($sql);
                return $stmt->execute([
                    ':author' => $article->getAuthor(),
                    ':title' => $article->getTitle(),
                    ':content' => $article->getContent()
                ]);
    
            }catch(PDOException $e){
                return false;
            }
        }
        else{
            return false;
        }
    }

    public static function updateOne($articleArray) : bool
    {
        $article = self::arrayToArticle($articleArray);
        $sql = "UPDATE articles "
                . "SET author = :author, "
                . "title = :title, "
                . "content = :content "
                . "WHERE article_id = :article_id;";

        if(self::isValid($article)){
            try{
                $stmt = self::$pdo->prepare($sql);

                // passing values to the parameters
                $stmt->bindValue(':article_id', $article->getId());
                $stmt->bindValue(':author', $article->getAuthor());
                $stmt->bindValue(':title', $article->getTitle());
                $stmt->bindValue(':content', $article->getContent());
        
                // execute the update statement 
                // return true or false
                return $stmt->execute();
            }catch(PDOException $e){
                return false;
            }
        }
        return false;        
    }

    public static function deleteOne($idArticle) : bool
    {
        $sql = 'DELETE FROM articles '
        . 'WHERE article_id = :article_id';
        try{
            $stmt = self::$pdo->prepare($sql);
            $stmt->bindValue(':article_id', $idArticle);

            return $stmt->execute();
        }catch(PDOException $e){
            return false;
        }
    }
}
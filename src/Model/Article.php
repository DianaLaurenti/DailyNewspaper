<?php
declare(strict_types=1);

namespace DailyNewspaper\Model;

class Article
{
    private int $article_id;
    private string $title;
    private string $author;
    private string $date;
    private string $content;

    public function getId() : ?int
    {
        if(isset($this->article_id)){
            return $this->article_id;
        }
        else{
            return null;
        }
    }
    public function setId(int $article_id) : void 
    {
        $this->article_id = $article_id;
    }
    public function getTitle() : string
    {
        if(isset($this->title)){
            return $this->title;
        }
        else{
            return "";
        }
    }
    public function setTitle(string $title) : void 
    {
        $this->title = $title;
    }
    public function getAuthor() : string
    {
        if(isset($this->author)){
            return $this->author;
        }
        else{
            return "";
        }
    }
    public function setAuthor(string $author) : void 
    {
        $this->author = $author;
    }
    public function getDate() : string
    {
        if(isset($this->date)){
            return $this->date;
        }
        else{
            return "";
        }
    }
    public function setDate(string $date) : void 
    {
        $this->date = $date;
    }
    public function getContent() : string
    {
        if(isset($this->content)){
            return $this->content;
        }
        else{
            return "";
        }
    }
    public function setContent(string $content) : void 
    {
        $this->content = $content;
    }
}
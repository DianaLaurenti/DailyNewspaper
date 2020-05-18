<?php
declare(strict_types=1);

namespace SimpleMVC\Model;

class Article
{
    protected $plates;

    public function __construct(Engine $plates)
    {
        $this->plates = $plates;
    }

    public function getTodayArticles(): array
    {
        // Collegarci al db
        $pdo = new PDO('sqlite:/foo.sqlite');

        // Selezionare articoli del giorno
        // select con parametri
        $article = this->model->getArtivlrs

        // Stampare un estratto
        echo $this->plates->render('home');
    }
}
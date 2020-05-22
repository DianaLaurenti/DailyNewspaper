<?php
use DailyNewspaper\Controller;

return [
    'GET /' => Controller\Home::class,
    'GET /login' => Controller\Login::class,
    'GET /article' => Controller\GetArticle::class,
    'GET /create' => Controller\CreateArticle::class,
    'POST /create' => Controller\CreateArticle::class,
    'GET /edit' => Controller\EditArticle::class,
    'GET /update' => Controller\UpdateArticle::class,
    'POST /update' => Controller\UpdateArticle::class,
    'GET /delete' => Controller\DeleteArticle::class,
    'POST /delete' => Controller\DeleteArticle::class
];

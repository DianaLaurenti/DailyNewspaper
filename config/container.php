<?php
use League\Plates\Engine;
use Psr\Container\ContainerInterface;
use DailyNewspaper\Model\DbClass;
use DailyNewspaper\Model\SQLiteConnection;

return [
    'view_path' => 'src/View',
    Engine::class => function(ContainerInterface $c) {
        $templates = new Engine($c->get('view_path'));
        $templates->addFolder('templates', $c->get('view_path').'/templates');
        return $templates;
    },
    PDO::class=>function(ContainerInterface $c) {
        return SQLiteConnection::connect();
    },
    DbClass::class => function(ContainerInterface $c) {
        return new DbClass($c->get('PDO'));
    }
];

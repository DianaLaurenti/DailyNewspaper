<?php
declare(strict_types=1);

namespace DailyNewspaper\Controller;

use League\Plates\Engine;
use DI\ContainerBuilder;
use DailyNewspaper\Controller\Error404;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use DailyNewspaper\Model\DbClass;
use DailyNewspaper\Model\ArticleCRUD;

class ControllerBase implements ControllerInterface
{
    protected $plates;

    public function __construct(Engine $plates)
    {
        $this->plates = $plates;
    }

    public function execute(ServerRequestInterface $request)
    {
        return null;
    }

    public function redirect(ServerRequestInterface $request, string $method, string $path)
    {
        $builder = new ContainerBuilder();
        $builder->addDefinitions('config/container.php');
        $container = $builder->build();

        $murl   = sprintf("%s %s", $method, $path);
        $routes = require 'config/route.php';
        $controllerName = $routes[$murl] ?? Error404::class;
        $controller = $container->get($controllerName);

        $uri = $request->getUri()->withPath($path);
        $request = $request->withUri($uri);
        $request = $request->withMethod($method);
        $controller->execute($request);
    }

    public function error(ServerRequestInterface $request, string $message, int $code)
    {
        $builder = new ContainerBuilder();
        $builder->addDefinitions('config/container.php');
        $container = $builder->build();

        switch($code){
            case '422': $controllerName = Error422::class;
            break;
            default: $controllerName = Error404::class;
        }
        $controller = $container->get($controllerName);
        $request = $request->withHeader('errorMessage', $message);             
        $controller->execute($request);
    }
}
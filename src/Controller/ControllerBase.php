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

    public function redirect(string $path)
    {
        header('Location:'.$path);
    }

    public function error(int $code, string $message = '')
    {
        http_response_code($code);
        echo $this->plates->render(strval($code), ['message' => $message]);
    }
}
<?php
declare(strict_types=1);

namespace DailyNewspaper\Controller;

use Psr\Http\Message\ServerRequestInterface;

interface ControllerInterface
{
    public function execute(ServerRequestInterface $request);
    public function redirect(ServerRequestInterface $request, string $method, string $path);
}
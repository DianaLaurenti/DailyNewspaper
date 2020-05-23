<?php
declare(strict_types=1);

namespace DailyNewspaper\Controller;

use League\Plates\Engine;
use Psr\Http\Message\ServerRequestInterface;

class Error404 extends ControllerBase
{
    public function __construct(Engine $plates)
    {
        parent::__construct($plates);
    }

    public function execute(ServerRequestInterface $request)
    {
        http_response_code(404);
        echo $this->plates->render('404');
    }
}

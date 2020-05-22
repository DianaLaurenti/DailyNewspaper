<?php
declare(strict_types=1);

namespace DailyNewspaper\Controller;

use League\Plates\Engine;
use Psr\Http\Message\ServerRequestInterface;

class Error422 implements ControllerInterface
{
    protected $plates;

    public function __construct(Engine $plates)
    {
        $this->plates = $plates;
    }

    public function execute(ServerRequestInterface $request)
    {
        http_response_code(422);
        echo $this->plates->render('422', ['message' => $request->getHeaderLine('errorMessage')]);
    }
}
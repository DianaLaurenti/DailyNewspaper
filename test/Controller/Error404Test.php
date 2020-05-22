<?php
declare(strict_types=1);

namespace DailyNewspaper\Test\Controller;

use League\Plates\Engine;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ServerRequestInterface;
use DailyNewspaper\Controller\Error404;

final class Error404Test extends TestCase
{
    public function setUp(): void
    {
        $this->plates = new Engine('src/View');
        $this->plates->addFolder('templates', 'src/View/templates');
        $this->home = new Error404($this->plates);
        $this->request = $this->getMockBuilder(ServerRequestInterface::class)->getMock();
    }

    public function testExecuteRender404View(): void
    {
        $this->expectOutputString($this->plates->render('404'));
        $this->home->execute($this->request);

        $this->assertEquals(404, http_response_code());
    }
}

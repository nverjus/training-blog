<?php
namespace Tests\lib;

use PHPUnit\Framework\TestCase;
use Blog\BlogApplication;

class ControllerTest extends TestCase
{
    private $app;

    public function setUp()
    {
        $this->app = new BlogApplication;
    }

    public function tearDown()
    {
        $this->app = null;
    }

    public function testExecuteActionDontExists()
    {
        $_SERVER['REQUEST_URI'] = '/test/action';
        $controller = $this->app->getController();
        $this->expectException('RuntimeException');
        $controller->execute();
    }

    public function testExecute()
    {
        $_SERVER['REQUEST_URI'] = '/test/execute';
        $controller = $this->app->getController();
        
        $this->assertSame('1234', $controller->execute());
    }
}

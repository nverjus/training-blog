<?php
namespace Tests\lib;

use PHPUnit\Framework\TestCase;
use Blog\BlogApplication;
use Blog\Controller\FrontController;

class ApplicationTest extends TestCase
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

    public function testGetController()
    {
        $_SERVER['REQUEST_URI'] = '/';
        $controller = $this->app->getController();
        $this->assertInstanceOf(FrontController::class, $controller);
    }

    public function testGetControllerVarsExtraction()
    {
        $_SERVER['REQUEST_URI'] = '/article/4';
        $controller = $this->app->getController();
        $this->assertSame('4', $_GET['id']);
    }

    public function testGetControllerDontExists()
    {
        $_SERVER['REQUEST_URI'] = '/test/controller';
        $this->expectException('RuntimeException');
        $this->app->getController();
    }
}

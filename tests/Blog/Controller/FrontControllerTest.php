<?php
namespace Tests\Blog\Controller;

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

    public function testVarsPage()
    {
        $_SERVER['REQUEST_URI'] = '/';
        $controller = $this->app->getController();
        $this->assertSame("", $_GET['page']);
    }
}

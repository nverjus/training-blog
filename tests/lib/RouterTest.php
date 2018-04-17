<?php
namespace Tests\lib;

use PHPUnit\Framework\TestCase;
use NV\MiniFram\Router;
use NV\MiniFram\Route;

class RouterTest extends TestCase
{
    private $router;

    public function setUp()
    {
        $route1 = new Route(array(
        'url' => "/",
        'controller' => 'blog',
        'action' => 'index',
      ));
        $varsNames[] = 'id';
        $route2 = new Route(array(
        'url' => '/article/([0-9]+)',
        'controller' => 'blog',
        'action' => 'articleView',
        'varsNames' => $varsNames,
      ));

        $this->router = new Router;
        $this->router->addRoute($route1);
        $this->router->addRoute($route2);
    }

    public function tearDown()
    {
        $this->router = null;
    }

    public function testGetRouteDontExists()
    {
        $this->expectException('RuntimeException');
        $route = $this->router->getRoute('/lala');
    }

    public function testGetRouteWithoutVars()
    {
        $route = $this->router->getRoute('/');
        $this->assertSame('index', $route->getAction());
    }

    public function testGetRouteWithVars()
    {
        $route = $this->router->getRoute('/article/4');
        $this->assertSame('4', $route->getVars()['id']);
    }
}

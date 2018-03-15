<?php
namespace Tests\lib;

use PHPUnit\Framework\TestCase;
use NVFram\Route;

class RouteTest extends TestCase
{
    private $route;
    private $varsNames = [];

    public function setUp()
    {
        $this->varsNames[] = 'id';
        $this->route = new Route(array(
          'url' => '/article/([0-9]+)',
          'module' => 'blog',
          'action' => 'index',
          'varsNames' => $this->varsNames,
        ));
    }

    public function tearDown()
    {
        $this->route = null;
        $this->varsNames = [];
    }

    public function testRouteCreation()
    {
        $this->assertSame('/article/([0-9]+)', $this->route->getUrl());
        $this->assertSame('blog', $this->route->getModule());
        $this->assertSame('index', $this->route->getAction());
        $this->assertSame($this->varsNames, $this->route->getVarsNames());
    }

    public function testHasVarsTrue()
    {
        $this->assertTrue($this->route->hasVars());
    }

    public function testHasVarsFalse()
    {
        $this->route = new Route(array(
        'url' => '/',
        'module' => 'blog',
        'action' => 'index',
      ));

        $this->assertFalse($this->route->hasVars());
    }

    public function testMatchTrue()
    {
        $this->assertFalse(!$this->route->match('/article/4'));
    }

    public function testMatchFalse()
    {
        $this->assertFalse($this->route->match('/article/e'));
    }
}

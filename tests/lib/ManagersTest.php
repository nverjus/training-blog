<?php
namespace Tests\lib;

use PHPUnit\Framework\TestCase;
use NV\Managers;
use NV\Manager;
use NV\Config;

class ManagersTest extends TestCase
{
    private $managers;

    public function setUp()
    {
        $config = new Config;
        $this->managers = new Managers($config->getDatabaseInfos());
    }

    public function tearDown()
    {
        $this->managers = null;
    }

    public function testGetManagerOfClassDontExists()
    {
        $this->expectException('InvalidArgumentException');
        $this->managers->getManagerOf('Lala');
    }

    public function testGetManagerOfClassExists()
    {
        $manager = $this->managers->getManagerOf('Article');

        $this->assertInstanceOf(Manager::class, $manager);
    }
}

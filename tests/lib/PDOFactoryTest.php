<?php
namespace Tests\lib;

use PHPUnit\Framework\TestCase;
use NV\PDOFactory;
use Blog\BlogApplication;

class PDOFactoryTest extends TestCase
{
    private $app;

    public function setUp()
    {
        $this->app = new BlogApplication;
    }

    public function tearDown()
    {
        $this->config = null;
    }
    public function testGetDatabaseConnexion()
    {
        $db = PDOFactory::getDatabaseConnexion($this->app->getConfig());

        $this->assertInstanceOf(\PDO::class, $db);
    }
}

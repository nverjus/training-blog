<?php
namespace Tests\lib;

use PHPUnit\Framework\TestCase;
use NVFram\PDOFactory;
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
        $this->app = null;
    }
    public function testGetDatabaseConnexionMySQL()
    {
        $db = PDOFactory::getDatabaseConnexion($this->app->getConfig()->getDatabaseInfos());

        $this->assertInstanceOf(\PDO::class, $db);
    }

    public function testGetDatabaseConnexionNotMySQL()
    {
        $data = $this->app->getConfig()->getDatabaseInfos();
        $data['dms'] = 'PgSQL';

        $this->expectException('InvalidArgumentException');
        $db = PDOFactory::getDatabaseConnexion($data);
    }
}

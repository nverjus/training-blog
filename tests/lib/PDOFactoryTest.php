<?php
namespace Tests\lib;

use PHPUnit\Framework\TestCase;
use NV\PDOFactory;
use NV\Config;

class PDOFactoryTest extends TestCase
{
    private $config;

    public function setUp()
    {
        $this->config = new Config();
    }

    public function tearDown()
    {
        $this->config = null;
    }
    public function testGetMysqlConnexion()
    {
        $db = PDOFactory::getMysqlConnexion($this->config->getDatabaseInfos());

        $this->assertInstanceOf(\PDO::class, $db);
    }
}

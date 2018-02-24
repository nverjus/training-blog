<?php
namespace Tests\lib;

use PHPUnit\Framework\TestCase;
use NV\Config;

class ConfigTest extends TestCase
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

    public function testReadDatabaseInfos()
    {
        $expected = [
      'dms'      => 'mysql',
      'host'     => 'localhost',
      'dbname'   =>'blog',
      'user'     => 'root',
      'password' => "g30PenYe",
    ];
        $this->assertSame($expected, $this->config->getDatabaseInfos());
    }
}

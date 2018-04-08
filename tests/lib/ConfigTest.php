<?php
namespace Tests\lib;

use PHPUnit\Framework\TestCase;
use NVFram\Config;
use Blog\BlogApplication;

class ConfigTest extends TestCase
{
    private $config;

    public function setUp()
    {
        $app = new BlogApplication;
        $this->config = $app->getConfig();
    }

    public function tearDown()
    {
        $this->config = null;
    }

    public function testReadDatabaseInfos()
    {
        $expected = [
      'dms'      => 'MySQL',
      'host'     => 'localhost',
      'dbname'   =>'blog',
      'user'     => 'root',
      'password' => "",
    ];
        $this->assertSame($expected, $this->config->getDatabaseInfos());
    }

    public function testGetNbArticles()
    {
        $this->assertSame(2, $this->config->getNBArticles());
    }
}

<?php
namespace Tests\lib;

use PHPUnit\Framework\TestCase;
use NV\Managers;
use NV\Config;
use Entity\Article;

class ArticleManagerTest extends TestCase
{
    private $manager;

    public function setUp()
    {
        $config = new Config;
        $managers = new Managers($config->getDatabaseInfos());
        $this->manager = $managers->getManagerOf('Article');
    }

    public function tearDown()
    {
        $this->manager = null;
    }

    public function testFindLastX()
    {
        $articles = $this->manager->findLastX(2);
        $this->assertEquals(2, count($articles));
    }

    public function testFindLastXEqualZero()
    {
        $this->expectException('InvalidArgumentException');
        $articles = $this->manager->findLastX(0);
    }

    public function testFindLastXNegative()
    {
        $this->expectException('InvalidArgumentException');
        $articles = $this->manager->findLastX(-1);
    }

    public function testFindLastXNoNumeric()
    {
        $this->expectException('TypeError');
        $articles = $this->manager->findLastX('i');
    }
}

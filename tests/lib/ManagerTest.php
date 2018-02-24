<?php
namespace Tests\lib;

use PHPUnit\Framework\TestCase;
use NV\Managers;
use NV\Config;
use Entity\Article;

class ManagerTest extends TestCase
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

    public function testFindAll()
    {
        $articles = $this->manager->findAll();
        $article = $articles[0];
        $this->assertInstanceOf(Article::class, $article);
    }

    public function testFindAllDesc()
    {
        $articles = $this->manager->findAll(true);
        $article = $articles[0];
        $this->assertInstanceOf(Article::class, $article);
    }

    public function testFindById()
    {
        $article = $this->manager->findById(1);
        $this->assertEquals(1, $article->getId());
    }

    public function testFindByIdEqualZero()
    {
        $this->expectException('InvalidArgumentException');
        $article = $this->manager->findById(0);
    }

    public function testFindByIdLessThanZero()
    {
        $this->expectException('InvalidArgumentException');
        $article = $this->manager->findById(-1);
    }

    public function testFindByIdNoInteger()
    {
        $this->expectException('TypeError');
        $article = $this->manager->findById('e');
    }
}

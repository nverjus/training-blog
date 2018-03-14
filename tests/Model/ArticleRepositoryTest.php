<?php
namespace Tests\lib;

use PHPUnit\Framework\TestCase;
use NV\Manager;
use Blog\BlogApplication;
use Entity\Article;

class ArticleRepositoryTest extends TestCase
{
    private $manager;

    public function setUp()
    {
        $app = new BlogApplication;
        $config = $app->getConfig();
        $manager = new Manager($app);
        $this->repository = $manager->getRepository('Article');
    }

    public function tearDown()
    {
        $this->repository = null;
    }

    public function testFindLastX()
    {
        $articles = $this->repository->findLastX(2);
        $this->assertEquals(2, count($articles));
    }

    public function testFindLastXEqualZero()
    {
        $this->expectException('InvalidArgumentException');
        $articles = $this->repository->findLastX(0);
    }

    public function testFindLastXNegative()
    {
        $this->expectException('InvalidArgumentException');
        $articles = $this->repository->findLastX(-1);
    }

    public function testFindLastXNoNumeric()
    {
        $this->expectException('TypeError');
        $articles = $this->repository->findLastX('i');
    }
}

<?php
namespace Tests\lib;

use PHPUnit\Framework\TestCase;
use NVFram\Manager;
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
        $articles = $this->repository->findLastX(2, 1);
        $this->assertEquals(2, count($articles));
    }

    public function testFindLastXEqualZero()
    {
        $this->expectException('InvalidArgumentException');
        $articles = $this->repository->findLastX(0, 3);
    }

    public function testFindLastXNegative()
    {
        $this->expectException('InvalidArgumentException');
        $articles = $this->repository->findLastX(-1, 2);
    }

    public function testFindLastXNoNumeric()
    {
        $this->expectException('TypeError');
        $articles = $this->repository->findLastX('i', 1);
    }

    public function testNbPagesModuloZero()
    {
        $nbPages = $this->repository->getNbPages(2);
        $this->assertSame(2, $nbPages);
    }

    public function testNbPagesModuloNotZero()
    {
        $nbPages = $this->repository->getNbPages(3);
        $this->assertSame(1, $nbPages);
    }
}

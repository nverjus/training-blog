<?php
namespace Tests\lib;

use PHPUnit\Framework\TestCase;
use NV\MiniFram\Manager;
use Blog\BlogApplication;
use Blog\Entity\Article;

class RepositoryTest extends TestCase
{
    private $repository;

    public function setUp()
    {
        $app = new BlogApplication;
        $manager = new Manager($app);
        $this->repository = $manager->getRepository('Article');
    }

    public function tearDown()
    {
        $this->repository = null;
    }

    public function testFindAll()
    {
        $articles = $this->repository->findAll();
        $article = $articles[0];
        $this->assertInstanceOf(Article::class, $article);
    }

    public function testFindAllDesc()
    {
        $articles = $this->repository->findAll(true);
        $article = $articles[0];
        $this->assertInstanceOf(Article::class, $article);
    }

    public function testFindById()
    {
        $article = $this->repository->findById(1);
        $this->assertEquals(1, $article->getId());
    }

    public function testFindByIdEqualZero()
    {
        $this->expectException('InvalidArgumentException');
        $article = $this->repository->findById(0);
    }

    public function testFindByIdLessThanZero()
    {
        $this->expectException('InvalidArgumentException');
        $article = $this->repository->findById(-1);
    }

    public function testFindByIdNoInteger()
    {
        $this->expectException('TypeError');
        $article = $this->repository->findById('e');
    }
}

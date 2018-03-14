<?php
namespace Tests\lib;

use PHPUnit\Framework\TestCase;
use NV\Repository;
use NV\Manager;
use Blog\BlogApplication;

class ManagerTest extends TestCase
{
    private $manager;

    public function setUp()
    {
        $app = new BlogApplication;
        $this->manager = new Manager($app);
    }

    public function tearDown()
    {
        $this->manager = null;
    }

    public function testGetRepositoryOfClassDontExists()
    {
        $this->expectException('InvalidArgumentException');
        $this->manager->getRepository('Lala');
    }

    public function testGetRepositoryOfClassExists()
    {
        $repository = $this->manager->getRepository('Article');

        $this->assertInstanceOf(Repository::class, $repository);
    }
}

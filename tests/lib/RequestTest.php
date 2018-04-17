<?php
namespace Tests\lib;

use PHPUnit\Framework\TestCase;
use NV\MiniFram\Request;
use Blog\BlogApplication;

class RequestTest extends TestCase
{
    private $request;

    public function setUp()
    {
        $app = new BlogApplication;
        $this->request = $app->getRequest();
    }

    public function tearDown()
    {
        $this->request = null;
    }

    public function testGetDataExist()
    {
        $_GET['test'] = 'lalala';

        $data = $this->request->getData('test');

        $this->assertSame($_GET['test'], $data);
    }

    public function testGetDataDontExist()
    {
        $this->assertNull($this->request->getData('te'));
    }

    public function testGetExistsTrue()
    {
        $this->assertTrue($this->request->getExists('test'));
    }

    public function testGetExistsFalse()
    {
        $this->assertFalse($this->request->getExists('te'));
    }

    public function testPostDataExist()
    {
        $_POST['test'] = 'lalala';

        $data = $this->request->postData('test');

        $this->assertSame($_POST['test'], $data);
    }

    public function testPostDataDontExist()
    {
        $this->assertNull($this->request->postData('te'));
    }

    public function testPostExistsTrue()
    {
        $this->assertTrue($this->request->PostExists('test'));
    }

    public function testPostExistsFalse()
    {
        $this->assertFalse($this->request->postExists('te'));
    }
}

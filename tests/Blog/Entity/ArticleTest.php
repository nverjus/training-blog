<?php
namespace Tests\Entity;

use PHPUnit\Framework\TestCase;
use Blog\Entity\Article;

class ArticleTest extends TestCase
{
    private $article;

    public function setUp()
    {
        $data = [];
        $data['id'] = 10;
        $data['title']= "Test Unitaire";
        $data['subTitle'] = "Sous-titre";
        $data['publicationDate'] = '2018-06-06 05:06:05';
        $data['content'] = "lalalalalalalalalala";

        $this->article = new Article($data);
    }

    public function tearDown()
    {
        $this->article = null;
    }

    public function testHydrator()
    {
        $this->assertEquals(10, $this->article->getId());
        $this->assertEquals('Test Unitaire', $this->article->getTitle());
        $this->assertEquals('Sous-titre', $this->article->getSubTitle());
        $this->assertEquals('lalalalalalalalalala', $this->article->getContent());
        $this->assertEquals(new \DateTime('2018-06-06 05:06:05'), $this->article->getPublicationDate());
    }

    public function testIsNew()
    {
        $data = [];
        $data['title']= "Test Unitaire";
        $data['subTitle'] = "Sous-titre";
        $data ['content'] = "lalalalalalalalalala";
        $this->article = new Article($data);

        $this->assertTrue($this->article->isNew());
    }

    public function testIsNotTrue()
    {
        $this->assertFalse($this->article->isNew());
    }

    public function testIsValid()
    {
        $this->assertTrue($this->article->isValid());
    }

    public function testIsNotValidTitleEmpty()
    {
        $data = [];
        $data['title']= "Test Unitaire";
        $data ['content'] = "";
        $this->article = new Article($data);

        $this->assertFalse($this->article->isValid());
    }

    public function testIsNotValidContentEmpty()
    {
        $data = [];
        $data['title']= "Test Unitaire";
        $data ['content'] = "";
        $this->article = new Article($data);

        $this->assertFalse($this->article->isValid());
    }
}

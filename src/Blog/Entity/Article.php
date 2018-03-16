<?php
namespace Blog\Entity;

use NVFram\Entity;

class Article extends Entity
{
    protected $title;
    protected $subTitle;
    protected $publicationDate;
    protected $content;

    public function isValid()
    {
        if (empty($this->title) || empty($this->content)) {
            return false;
        }

        return true;
    }

    public function setTitle($title)
    {
        if (!empty($title)) {
            $this->title = $title;
        }
    }

    public function setSubTitle($subTitle)
    {
        if (!empty($subTitle)) {
            $this->subTitle = $subTitle;
        }
    }

    public function setPublicationDate($publicationDate)
    {
        $this->publicationDate = new \DateTime($publicationDate);
    }

    public function setContent($content)
    {
        if (!empty($content)) {
            $this->content = $content;
        }
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getSubTitle()
    {
        return $this->subTitle;
    }

    public function getPublicationDate()
    {
        return $this->publicationDate;
    }

    public function getContent()
    {
        return $this->content;
    }
}

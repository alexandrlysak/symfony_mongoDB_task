<?php

namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document
 */
class Post
{
    /**
     * @MongoDB\Id
     */
    protected $id;

    /**
     * @MongoDB\Field(type="integer")
     */
    protected $index;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $title;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $url;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $createdDate;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $thumb;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $shortDescription;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $author;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $content;


    /**
     * Get Id
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * Get Index
     * @return mixed
     */
    public function getIndex()
    {
        return $this->index;
    }

    /**
     * Set Index
     * @param value
     */
    public function setIndex($value)
    {
        $this->index = $value;
    }

    /**
     * Get title
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set title
     * @param $value
     */
    public function setTitle($value)
    {
        $this->title = $value;
    }

    /**
     * Get url
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set url
     * @param $value
     */
    public function setUrl($value)
    {
        $this->url = $value;
    }

    /**
     * Get created date
     * @return mixed
     */
    public function getCreatedDate()
    {
        return $this->createdDate;
    }

    /**
     * Set created date value
     * @param $value
     */
    public function setCreatedDate($value)
    {
        $this->createdDate = $value;
    }

    /**
     * Get thumbnail
     * @return mixed
     */
    public function getThumb()
    {
        return $this->thumb;
    }

    /**
     * Set thumbnail
     * @param $value
     */
    public function setThumb($value)
    {
        $this->thumb = $value;
    }

    /**
     * Get short description
     * @return mixed
     */
    public function getDescription()
    {
        return $this->shortDescription;
    }

    /**
     * Set url
     * @param $value
     */
    public function setDescription($value)
    {
        $this->shortDescription = $value;
    }

    /**
     * Set Author
     * @param $value
     */
    public function setAuthor($value)
    {
        $this->author = $value;
    }

    /**
     * Get author
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }
    /**
     * Set Author
     * @param $value
     */
    public function setContent($value)
    {
        $this->content = $value;
    }

    /**
     * Get author
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

}


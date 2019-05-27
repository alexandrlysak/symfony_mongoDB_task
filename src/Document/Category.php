<?php

namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document
 */
class Category
{
    /**
     * @MongoDB\Id
     */
    protected $id;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $title;

    /**
     * Get Id
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get Title
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
}
<?php

namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document
 */
class PostsCategories
{
    /**
     * @MongoDB\Id
     */
    protected $id;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $categoryId;

    /**
     * @MongoDB\Field(type="integer")
     */
    protected $postId;

    /**
     * Get Id
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get Category id
     * @return mixed
     */
    public function getCategoryId()
    {
        return $this->categoryId;
    }

    /**
     * Set Category Id
     * @param $value
     */
    public function setCategoryId($value)
    {
        $this->categoryId = $value;
    }

    /**
     * Get Post id
     * @return mixed
     */
    public function getPostId()
    {
        return $this->postId;
    }

    /**
     * Set post Id
     * @param $value
     */
    public function setPostId($value)
    {
        $this->postId = $value;
    }
}
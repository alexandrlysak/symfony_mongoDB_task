<?php

namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document
 */
class PostsTags
{
    /**
     * @MongoDB\Id
     */
    protected $id;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $tagId;

    /**
     * @MongoDB\Field(type="string")
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
     * Get Tag Id
     * @return mixed
     */
    public function getTagId()
    {
        return $this->tagId;
    }

    /**
     * Set Tag Id
     * @param $value
     */
    public function setTagId($value)
    {
        $this->tagId = $value;
    }

    /**
     * Get post Id
     * @return mixed
     */
    public function getPostId()
    {
        return $this->postId;
    }

    /**
     * Set Post Id
     * @param $value
     */
    public function setPostId($value)
    {
        $this->postId = $value;
    }
}
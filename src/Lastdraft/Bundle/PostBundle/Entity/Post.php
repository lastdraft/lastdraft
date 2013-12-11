<?php

namespace Lastdraft\Bundle\PostBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Post
 *
 * @package Lastdraft\Bundle\PostBundle\Entity
 */
class Post implements PostInterface
{

    /**
     * Post's unique ID number.
     *
     * @var integer
     */
    private $id;

    /**
     * Post's author entity.
     *
     * @var AuthorInterface
     */
    private $author;

    /**
     * Post's author's unique ID number.
     *
     * @var integer
     */
    private $authorId;

    /**
     * Post's title.
     *
     * @var string
     */
    private $title;

    /**
     * Post's body content.
     *
     * @var string
     */
    private $body;

    /**
     * Post's publish date\time.
     *
     * @var \DateTime
     */
    private $publishOn;

    /**
     * Post's creation date\time.
     *
     * @var \DateTime
     */
    private $createdAt;

    /**
     * Post's last update date\time.
     *
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * {@inheritdoc}
     */
    public function getId ()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthor ()
    {
        return $this->author;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthorId ()
    {
        return $this->authorId;
    }

    /**
     * {@inheritdoc}
     */
    public function setTitle ( $title )
    {
        $this->title = $title;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getTitle ()
    {
        return $this->title;
    }

    /**
     * {@inheritdoc}
     */
    public function setBody ( $body )
    {
        $this->body = $body;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getBody ()
    {
        return $this->body;
    }

    /**
     * {@inheritdoc}
     */
    public function setPublishOn ( $publishOn )
    {
        $this->publishOn = $publishOn;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getPublishOn ()
    {
        return $this->publishOn;
    }

    /**
     * {@inheritdoc}
     */
    public function setCreatedAt ( $createdAt )
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getCreatedAt ()
    {
        return $this->createdAt;
    }

    /**
     * {@inheritdoc}
     */
    public function setUpdatedAt ( $updatedAt )
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getUpdatedAt ()
    {
        return $this->updatedAt;
    }

}

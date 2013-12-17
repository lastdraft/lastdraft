<?php

namespace Lastdraft\Bundle\PostBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Post
 *
 * @package Lastdraft\Bundle\PostBundle\Entity
 */
abstract class AbstractPost implements PostInterface
{

    /**
     * Post's unique ID number.
     *
     * @var integer
     */
    protected $id;

    /**
     * Post's author entity.
     *
     * @var AuthorInterface
     */
    protected $author;

    /**
     * Post's author's unique ID number.
     *
     * @var integer
     */
    protected $authorId;

    /**
     * Post's title.
     *
     * @var string
     */
    protected $title;

    /**
     * Post's body content.
     *
     * @var string
     */
    protected $body;

    /**
     * Post's publish date\time.
     *
     * @var \DateTime
     */
    protected $publishOn;

    /**
     * Post's creation date\time.
     *
     * @var \DateTime
     */
    protected $createdAt;

    /**
     * Post's last update date\time.
     *
     * @var \DateTime
     */
    protected $updatedAt;

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

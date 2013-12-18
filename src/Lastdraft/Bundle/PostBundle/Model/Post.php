<?php

namespace Lastdraft\Bundle\PostBundle\Model;

/**
 * Class Post
 *
 * @package Lastdraft\Bundle\PostBundle\Model
 */
class Post implements PostInterface
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
     * Post's slug.
     *
     * @var string
     */
    protected $slug;

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
    public function __toString ()
    {
        return $this->getTitle();
    }

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
    public function setAuthor ( AuthorInterface $author )
    {
        $this->author = $author;

        return $this;
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
    /*
    public function setSlug ( $slug )
    {
        $this->slug = $slug;

        return $this;
    }
    */

    /**
     * {@inheritdoc}
     */
    /*
    public function getSlug ()
    {
        return $this->slug;
    }
    */

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
    public function setCreatedAt ()
    {
        $this->createdAt = new \DateTime();
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
    public function setUpdatedAt ()
    {
        $this->updatedAt = new \DateTime();
    }

    /**
     * {@inheritdoc}
     */
    public function getUpdatedAt ()
    {
        return $this->updatedAt;
    }

}

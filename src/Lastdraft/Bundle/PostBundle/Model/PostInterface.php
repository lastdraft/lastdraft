<?php

namespace Lastdraft\Bundle\PostBundle\Model;

/**
 * Interface Post
 *
 * @package Lastdraft\Bundle\PostBundle\Model
 */
interface PostInterface
{

    /**
     * Represent the post as a string.
     *
     * @return string
     */
    public function __toString ();

    /**
     * Get the unique ID number for this post.
     *
     * @return integer
     */
    public function getId ();

    /**
     * Set the post's author entity.
     *
     * @param AuthorInterface $author
     * @return PostInterface
     */
    public function setAuthor ( AuthorInterface $author );

    /**
     * Get the post's author entity.
     *
     * @return AuthorInterface
     */
    public function getAuthor ();

    /**
     * Get the ID number of the author who owns this post.
     *
     * @return integer
     */
    public function getAuthorId ();

    /**
     * Set the title for this post.
     *
     * @param string $title The title to be set.
     * @return PostInterface
     */
    public function setTitle ( $title );

    /**
     * Get the title for this post
     *
     * @return string
     */
    public function getTitle ();

    /**
     * Set the slug for this post.
     *
     * @param string $slug The slug to be set.
     * @return PostInterface
     */
    // public function setSlug ( $slug );

    /**
     * Get the slug for this post
     *
     * @return string
     */
    // public function getSlug ();

    /**
     * Set the body for this post.
     *
     * @param string $body The body to be set.
     * @return PostInterface
     */
    public function setBody ( $body );

    /**
     * Get the body for this post.
     *
     * @return string
     */
    public function getBody ();

    /**
     * Set the date/time this post should automatically be visible to the public.
     *
     * @param \DateTime $publishOn The publish date/time.
     * @return PostInterface
     */
    public function setPublishOn ( $publishOn );

    /**
     * Get the date/time this post should be automatically visible to the public.
     *
     * @return \DateTime
     */
    public function getPublishOn ();

    /**
     * Set the date/time this post was created.
     *
     * @return void
     */
    public function setCreatedAt ();

    /**
     * Get the date/time this post was created.
     *
     * @return \DateTime
     */
    public function getCreatedAt ();

    /**
     * Set the date/time this post was last updated.
     *
     * @return void
     */
    public function setUpdatedAt ();

    /**
     * Get the date/time this post was last updated.
     *
     * @return \DateTime
     */
    public function getUpdatedAt ();

}

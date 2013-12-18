<?php

namespace Lastdraft\Bundle\PostBundle\Model;

/**
 * Interface Author
 *
 * @package Lastdraft\Bundle\PostBundle\Model
 */
interface AuthorInterface
{

    /**
     * Represent the author as a string.
     *
     * @return string
     */
    public function __toString ();

    /**
     * Get the author's first name.
     *
     * @return string
     */
    public function getFirstName ();

    /**
     * Set the author's first name.
     *
     * @param $firstName
     * @return AuthorInterface
     */
    public function setFirstName ( $firstName = null );

    /**
     * Get the author's full name (first and surnames).
     *
     * @return string
     */
    public function getFullName ();

    /**
     * Return a collection of post entities belonging to this author.
     *
     * @return PostInterface[]
     */
    public function getPosts ();

    /**
     * Get the author's surname (last name, family name, etc).
     *
     * @return string
     */
    public function getSurname ();

    /**
     * Set the author's surname (last name, family name, etc).
     *
     * @param $surname
     * @return AuthorInterface
     */
    public function setSurname ( $surname = null );

}

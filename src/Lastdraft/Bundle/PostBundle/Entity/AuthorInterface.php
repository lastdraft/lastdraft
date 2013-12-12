<?php

namespace Lastdraft\Bundle\PostBundle\Entity;

/**
 * Interface Author
 *
 * @package Lastdraft\Bundle\PostBundle\Entity
 */
interface AuthorInterface
{

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

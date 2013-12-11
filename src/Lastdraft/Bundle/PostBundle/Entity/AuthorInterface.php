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
     * Return a collection of post entities belonging to this author.
     *
     * @return PostInterface[]
     */
    public function getPosts ();

}

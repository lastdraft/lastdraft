<?php

namespace Lastdraft\Bundle\PostBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Lastdraft\Bundle\UserBundle\Entity\User;

/**
 * Class Author
 *
 * @package Lastdraft\Bundle\PostBundle\Entity
 */
class Author extends User implements AuthorInterface
{

    /**
     * A collection of post entities belonging to this author.
     *
     * @var PostInterface[]
     */
    protected $posts;

    /**
     * {@inheritdoc}
     */
    public function getPosts ()
    {
        return $this->posts;
    }

}

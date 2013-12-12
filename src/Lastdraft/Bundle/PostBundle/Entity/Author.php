<?php

namespace Lastdraft\Bundle\PostBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use FOS\UserBundle\Model\User as BaseUser;

/**
 * Class Author
 *
 * @package Lastdraft\Bundle\PostBundle\Entity
 */
class Author extends BaseUser implements AuthorInterface
{

    /**
     * The unique ID number associated with this author.
     *
     * @var integer
     */
    protected $id;

    /**
     * The author's first name.
     *
     * @var string
     */
    protected $firstName;

    /**
     * The author's surname (last name, family name, etc).
     *
     * @var string
     */
    protected $surname;

    /**
     * A collection of post entities belonging to this author.
     *
     * @var PostInterface[]
     */
    protected $posts;

    /**
     * Get the authors's unique ID number.
     *
     * @return integer
     */
    public function getId ()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getFirstName ()
    {
        return $this->firstName;
    }

    /**
     * {@inheritdoc}
     */
    public function setFirstName ( $firstName = null )
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getPosts ()
    {
        return $this->posts;
    }

    /**
     * {@inheritdoc}
     */
    public function getSurname ()
    {
        return $this->surname;
    }

    /**
     * {@inheritdoc}
     */
    public function setSurname ( $surname = null )
    {
        $this->surname = $surname;

        return $this;
    }

}

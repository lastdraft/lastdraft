<?php

namespace Lastdraft\Bundle\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use FOS\UserBundle\Model\User as BaseUser;

/**
 * Class User
 *
 * @package Lastdraft\Bundle\UserBundle\Entity
 */
class User extends BaseUser
{

    /**
     * @var integer
     */
    protected $id;

    /**
     * @var string
     */
    private $firstName;

    /**
     * @var string
     */
    private $lastName;

    /**
     * Get the user's unique ID number.
     *
     * @return integer
     */
    public function getId ()
    {
        return $this->id;
    }

    /**
     * Set the user's first name.
     *
     * @param string $firstName The first name to set.
     * @return User
     */
    public function setFirstName ( $firstName )
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get the user's first name.
     *
     * @return string The user's first name.
     */
    public function getFirstName ()
    {
        return $this->firstName;
    }

    /**
     * Set the user's last name.
     *
     * @param string $lastName The last name to set.
     * @return User
     */
    public function setLastName ( $lastName )
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get the user's last name.
     *
     * @return string The user's last name.
     */
    public function getLastName ()
    {
        return $this->lastName;
    }

}

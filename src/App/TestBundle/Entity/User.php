<?php

namespace App\TestBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="`user`")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="Attempt", mappedBy="user")
     */
    protected $attempts;


    public function __construct()
    {
        parent::__construct();

        $this->attempts = new ArrayCollection();
    }

    /**
     * Add attempt
     *
     * @param Attempt $attempt
     *
     * @return User
     */
    public function addAttempt(Attempt $attempt)
    {
        $this->attempts[] = $attempt;

        return $this;
    }

    /**
     * Remove attempt
     *
     * @param Attempt $attempt
     */
    public function removeAttempt(Attempt $attempt)
    {
        $this->attempts->removeElement($attempt);
    }

    /**
     * Get attempts
     *
     * @return ArrayCollection
     */
    public function getAttempts()
    {
        return $this->attempts;
    }
}
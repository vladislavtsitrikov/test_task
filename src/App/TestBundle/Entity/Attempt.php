<?php

namespace App\TestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Attempt
 *
 * @ORM\Table(name="attempt")
 * @ORM\Entity(repositoryClass="App\TestBundle\Repository\AttemptRepository")
 */
class Attempt
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="testname", type="string", length=120)
     */
    private $testname;

    /**
     * @var int
     *
     * @ORM\Column(name="correct", type="integer")
     */
    private $correct;

    /**
     * @var int
     *
     * @ORM\Column(name="total", type="integer")
     */
    private $total;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="attempts")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     */
    protected $datetimestamp;

    public function __construct()
    {
        $this->setDatetimestamp(new \DateTime());
    }


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set testname
     *
     * @param string $testname
     *
     * @return Attempt
     */
    public function setTestname($testname)
    {
        $this->testname = $testname;

        return $this;
    }

    /**
     * Get testname
     *
     * @return string
     */
    public function getTestname()
    {
        return $this->testname;
    }

    /**
     * Set correct
     *
     * @param integer $correct
     *
     * @return Attempt
     */
    public function setCorrect($correct)
    {
        $this->correct = $correct;

        return $this;
    }

    /**
     * Get correct
     *
     * @return int
     */
    public function getCorrect()
    {
        return $this->correct;
    }

    /**
     * Set total
     *
     * @param integer $total
     *
     * @return Attempt
     */
    public function setTotal($total)
    {
        $this->total = $total;

        return $this;
    }

    /**
     * Get total
     *
     * @return int
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * Set date_time stamp
     *
     * @param \DateTime $datetimestamp
     *
     * @return Attempt
     */
    public function setDatetimestamp($datetimestamp)
    {
        $this->datetimestamp = $datetimestamp;

        return $this;
    }

    /**
     * Get date_time stamp
     *
     * @return \DateTime
     */
    public function getDatetimestamp()
    {
        return $this->datetimestamp;
    }

    /**
     * Set user
     *
     * @param User $user
     *
     * @return Attempt
     */
    public function setUser(User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }
}


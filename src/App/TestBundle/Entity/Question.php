<?php

namespace App\TestBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Question
 *
 * @ORM\Table(name="question")
 * @ORM\Entity(repositoryClass="App\TestBundle\Repository\QuestionRepository")
 */
class Question
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
     * @ORM\Column(name="text", type="string", length=255)
     */
    private $text;

    /**
     * @var int
     *
     * @ORM\Column(name="type", type="smallint")
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity="Test", inversedBy="questions")
     * @ORM\JoinColumn(name="test_id", referencedColumnName="id")
     */
    private $test;

    /**
     * @ORM\OneToMany(targetEntity="Answer", mappedBy="question")
     */
    protected $answers;


    function __construct()
    {
        $this->answers = new ArrayCollection();
    }

    /**
     * Get class object as string
     * @return string
     */
    public function __toString()
    {
        return ($this->text) ? $this->text . ' :: ' . $this->test->getName(): '';
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
     * Set text
     *
     * @param string $text
     *
     * @return Question
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set type
     *
     * @param integer $type
     *
     * @return Question
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set test
     *
     * @param Test $test
     *
     * @return Question
     */
    public function setTest(Test $test)
    {
        $this->test = $test;

        return $this;
    }

    /**
     * Get test
     *
     * @return Test
     */
    public function getTest()
    {
        return $this->test;
    }

    /**
     * Add answer
     *
     * @param Answer $answer
     *
     * @return Question
     */
    public function addAnswer(Answer $answer)
    {
        $this->answers[] = $answer;

        return $this;
    }

    /**
     * Remove answer
     *
     * @param Answer $answer
     */
    public function removeAnswer(Answer $answer)
    {
        $this->answers->removeElement($answer);
    }

    /**
     * Get answers
     *
     * @return ArrayCollection
     */
    public function getAnswers()
    {
        return $this->answers;
    }
}


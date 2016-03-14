<?php
namespace AppBundle\Entity;
use Symfony\Component\Validator\Constraints as Assert;

class Task
{

    /**
     * @Assert\NotBlank()
     */
    protected $task;
    /**
     * @Assert\NotBlank()
     * @Assert\Type("\DateTime")
     */
    protected $dueDate;

    /**
     *
     */
    public $codeReference;


    /**
     * @Assert\Choice(
     *     choices = { "M", "F", null },
     *     message = "Choose a valid gender."
     * )
     */
    public $gender;



    public function getTask()
    {
        return $this->task;
    }

    public function setTask($task)
    {
        $this->task = $task;
    }

    public function getDueDate()
    {
        return $this->dueDate;
    }

    public function setDueDate(\DateTime $dueDate = null)
    {
        $this->dueDate = $dueDate;
    }
}
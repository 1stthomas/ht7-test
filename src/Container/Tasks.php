<?php

namespace Ht7\Test\Container;

use \Ht7\Test\Model\ITask;

/**
 * Description of Method
 *
 * @author Thomas Pluess
 */
class Tasks
{

    /**
     * Pre test tasks.
     *
     * @var     array           Indexed array of pre test tasks.
     */
    protected $tasks;

    public function __construct()
    {
        $this->tasks = [];
    }

    /**
     * Add a pre test task.
     *
     * @param   array   $task   Indexed array of pre test tasks.
     */
    public function addTask(ITask $task)
    {
        $this->tasks[] = $task;
    }

    /**
     * Get all defined pre test tasks.
     *
     * @return  array           Indexed array of pre test tasks.
     */
    public function getTasks()
    {
        return $this->tasks;
    }

    public function setTasks(array $data)
    {
        foreach ($data as $task) {
            $this->addTask($task);
        }
    }

}

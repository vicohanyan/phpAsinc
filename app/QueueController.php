<?php

namespace app;

use QueueModule\QueueManager;

class QueueController
{
    private QueueManager $queue;

    public function __construct()
    {
        $this->queue = new QueueManager();
    }

    /**
     * @return void
     */
    public function addTaskToQueue():void
    {
        $task1 = new Task1();
        $task2 = new Task2();
        $this->queue->addTask($task1);
        $this->queue->addTask($task2);
        $this->queue->execute();
    }

    /**
     * @return array
     */
    public function getTasks():array {
        return $this->queue->getTasksList();
    }

}
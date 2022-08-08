<?php

namespace QueueModule;

class QueueManager
{
    const TASK_STATUSES = [
        0 => "waiting",
        1 => "running",
        2 => "finished",
    ];
    const MAX_PROCESS_COUNT = 5;
    protected array $tasks = [];

    /**
     * Add a task to queue with waiting status
     * @param TaskInterface $task
     * @return void
     */
    public function addTask(TaskInterface $task): void
    {
        $this->tasks = [
            'task' => $task,
            'status' => 0,
        ];
    }

    /**
     * @return void
     */
    public function execute(): void
    {
        $processCount = 0;
        if (!empty($this->tasks)) {
            foreach ($this->tasks as $item) {
                if ($processCount == self::MAX_PROCESS_COUNT) {
                    continue;
                }
                $process = pcntl_fork();
                if ($process == -1) {
                    die('could not creat new process');
                } else if ($process) {
                    pcntl_wait($status);
                } else {
                    $processCount++;
                    $thisPID = getmypid();
                    $item['pid'] = $thisPID;
                    $item['status'] = self::TASK_STATUSES[2];
                    $item['task']->handle();
                    $this->setProcessEnded($thisPID);
                    sleep(2);
                }
            }
        }
    }

    /**
     * get tasks in list with statuses
     * @return array
     */
    public function getTasksList(): array
    {
        return $this->tasks;
    }

    /**
     * @param string $pid
     * @return void
     */
    public function setProcessEnded(string $pid): void
    {
        foreach ($this->tasks as $key => $task) {
            if ($task['pid'] == $pid) {
                unset($key);
            }
        }
    }

}
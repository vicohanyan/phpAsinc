<?php

namespace app;

use QueueModule\TaskInterface;

class Task2 implements TaskInterface
{

    public function handle()
    {
        var_dump("task 2");
    }
}
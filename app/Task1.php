<?php

namespace app;

use QueueModule\TaskInterface;

class Task1 implements TaskInterface
{

    public function handle()
    {
        var_dump("task 1");
    }
}
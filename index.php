<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
define("DOCUMENT_ROOT", $_SERVER['DOCUMENT_ROOT']);
const MAX_PROCESS_COUNT = 5;

require_once "core/Autoloader.php";

use app\QueueController;

$controller = new QueueController();
$controller->addTaskToQueue();
var_dump($controller->getTasks());




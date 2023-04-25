<?php

use LuKa\HeadlessTaskServerPhp\Server;
use LuKa\HeadlessTaskServerPhp\Structs\Options;
use LuKa\HeadlessTaskServerPhp\Structs\Task;

require '../vendor/autoload.php';

$server = new Server('http://127.0.0.1:8080/');

if ($server->isAlive()) {
    echo 'Server is OK' . PHP_EOL;
} else {
    echo 'Hmm, server ded...';
    die();
}

try {
    $task = Task::fromFile(__DIR__ . '/example.js');
    $task->setVar('myVar', 'Some TeSt VALUE');
} catch (Exception $e) {
    echo $e->getMessage() . PHP_EOL;
    echo 'Check path to file';
    die();
}

$options = new Options();
$options->setLocale('en-US');

try {
    $response = $server->runTask($task, $options);
}
catch (Exception $e) {
    echo $e->getMessage() . PHP_EOL;
    echo 'We cant understand response, check server';
    die();
}

echo 'Response received' . PHP_EOL;
echo 'Status is: ' . $response->getStatus() . PHP_EOL;
echo 'Title is: '. json_encode($response->getOutput()) . PHP_EOL;
echo 'Test passed. Bye';

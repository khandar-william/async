<?php
require dirname(__DIR__) . '/vendor/autoload.php';
use Wrench\BasicServer;

$server = new BasicServer('ws://localhost:8088', array(
    'check_origin' => false
));

// Register your applications
$server->registerApplication('count', new MyApp\CountApplication());
$server->run();
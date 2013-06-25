<?php

// connect to telnet only

require __DIR__.'/../vendor/autoload.php';

$loop = React\EventLoop\Factory::create();
$socket = new React\Socket\Server($loop);

$conns = new \SplObjectStorage();

function broadcast_count($conns) {
    $count = count($conns);
    foreach ($conns as $conn) {
        $conn->send($count);
    }
}

$socket->on('connection', function ($conn) use ($conns) {
    $conns->attach($conn);
    broadcast_count($conns);

    $conn->on('data', function ($data) use ($conns, $conn) {
        // when someone message to server
    });

    $conn->on('end', function () use ($conns, $conn) {
        $conns->detach($conn);
        broadcast_count($conns);
    });
});

echo "Socket server listening on port 8088.\n";

$socket->listen(8088);
$loop->run();
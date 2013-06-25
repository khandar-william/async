<?php
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;
use MyApp\Count;

    require dirname(__DIR__) . '/vendor/autoload.php';

    $server = IoServer::factory(
    	new WsServer(
        	new Count()
		)
      , 8088
    );

    $server->run();
<?php
namespace MyApp;
use Wrench\Application\Application;

/**
 * Example application for Wrench: display user count
 */
class CountApplication extends Application
{
    protected $clients = array();

    /**
     * @see Wrench\Application.Application::onConnect()
     */
    public function onConnect($client)
    {
        $id = $client->getId();
        // echo "connected: $id\n";
        $this->clients[$id] = $client;
        $this->broadcastCount();
    }

    public function onDisconnect($client)
    {
    	$id = $client->getId();
        // echo "disconnected: $id\n";
    	unset($this->clients[$id]);
        $this->broadcastCount();
    }

    protected function broadcastCount()
    {
    	$count = count($this->clients);
    	foreach ($this->clients as $client) {
    		$client->send($count);
    	}
    }

    public function onData($data, $client)
    {
        // not used
    }
}
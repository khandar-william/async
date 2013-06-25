<?php

namespace WebSocket\Application;

class CountApplication extends Application
{
    private $_clients = array();

    protected function broadcastCount() 
    {
    	$count = json_encode(count($this->_clients));
    	foreach ($this->_clients as $client) 
    	{
    		$client->send($count);
    	}
    }
	
	public function onConnect($client)
    {
		$id = $client->getClientId();
        $this->_clients[$id] = $client;		
        $this->broadcastCount();
    }

    public function onDisconnect($client)
    {
        $id = $client->getClientId();		
		unset($this->_clients[$id]);     
		$this->broadcastCount();
    }

    public function onData($data, $client)
    {		
        //
    }
	
}
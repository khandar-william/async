In Search for node.js Alternative Using PHP
===========================================

Background
----------

node.js is the new cool kid in web programming world. It supports asynchronous, event-driven web server natively. It's very easy to communicate with clients (browser) through websockets (using Socket.io) which makes implementing many real-time features possible.

Problem
-------

Is there any PHP alternative to accomplish equal task? Let's say for counting online user in real-time.

Goal
----

To implement real-time user count functionality using PHP as server-side.
Use [this stackoverflow answer](http://stackoverflow.com/a/8449996) as example of what we want to achieve.

Requirements
------------

Provide a web page with text "There are: X connected users". 
Every time a new window visits that page, increase X.
Every time a window closes, decrease X.
All browser windows must see the same number.

Socket.io is a node.js library that wraps the communication between client and server as if they are communicating through WebSocket. If the browser doesn't support WebSocket, it will fall back to more traditional approach like AJAX or Flash.
Currently, there is no PHP equivalent for Socket.io. Even if we can communicate with Socket.io client (JavaScript browser) using the above WebSocket server libraries, if it falls back to AJAX for example, all the libraries above don't handle that. We need to handle that manually by imitating how Socket.io in node.js works, or we could create our own Socket.io replacement. 
In general, because WebSocket is a new technology and only major browsers support it, it's a good idea to prepare a fallback method for old browsers. In node.js, we can easily accomplish this using Socket.io. 
In PHP, one solution would be to use Graceful WebSocket in client and implement two version of PHP servers (WebSocket only and HTTP only). Of course, then we will need to synchronize these two servers.

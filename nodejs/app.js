var app = require('http').createServer(handler)
  , io = require('socket.io').listen(app)
  , fs = require('fs')
 
app.listen(8088);

function handler (req, res) {
    var filepath = __dirname + '/index.html';
    fs.readFile(filepath, function (err, data) {
      if (err) {
        res.writeHead(500);
        return res.end('Error loading file');
      }

      res.writeHead(200);
      res.end(data);
    });
}

var count = 0;

function update_count(socket) {
  socket.emit('message', {count: count});
  socket.broadcast.emit('message', {count: count});
}

io.sockets.on('connection', function (socket) {
  count++;
  update_count(socket);
  socket.on('disconnect', function() {
    count--;
    update_count(socket);
  });
});
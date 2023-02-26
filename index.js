const express = require('express');
const app = express();
const http = require('http');
const server = http.createServer(app);
const { Server } = require("socket.io");
const io = new Server(server, {
  transports: ['websocket', 'polling'],
  cors: {
    origin: "https://web.itslets.com",
    methods: ["GET", "POST"]
  }
});


app.get('/', (req, res) => {
  res.sendFile(__dirname + '/socket.html');
});


 
const socketIO = (socket) => {
  console.log('a user connected');

  socket.on('chat message', msg => {
    console.log('chat message', msg);
    io.emit('chat message', msg);
  });

  socket.on('disconnect', () => {
    console.log('user disconnected');
  });
}




io.on('connection', socketIO);


const port =  process.env.PORT || 3000;
server.listen(port, () => {
  console.log('listening on :'+port);
});
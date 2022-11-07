let express  = require('express');
let app      = express();
let http = require('http').Server(app);
let io = require('socket.io')(http);
 
io.on('connection', (socket) => {  

  console.log('connected')
  socket.on('sendnotifi', function(dataArr){
		//io.emit('sendnotifi', dataArr);
		io.to(dataArr.socket_id).emit('sendnotifi', dataArr);
  });  
  socket.on('new_lets', function(dataArr){
	  io.to(dataArr.socket_id).emit('new_lets', dataArr);
  });  
  socket.on('newaccepted', function(dataArr){
	  io.to(dataArr.socket_id).emit('newaccepted', dataArr);
  });  
  socket.on('acceptpartner', function(dataArr){
    io.to(dataArr.socket_id).emit('acceptpartner', dataArr);
  });  
  socket.on('rejectPartner', function(dataArr){
	  io.to(dataArr.socket_id).emit('rejectPartner', dataArr);
  });  
  socket.on('cancelPartner', function(dataArr){
	  io.to(dataArr.socket_id).emit('cancelPartner', dataArr);
  });  
  socket.on('cancelbypartner', function(dataArr){
	  io.to(dataArr.socket_id).emit('cancelbypartner', dataArr);
  });  
  socket.on('rejectaccepted', function(dataArr){
	  io.to(dataArr.socket_id).emit('rejectaccepted', dataArr);
  });  
  socket.on('cancelaccepted', function(dataArr){
	  io.to(dataArr.socket_id).emit('cancelaccepted', dataArr);
  });  
}); 

var port = process.env.PORT || 3000; 
http.listen(port, function(){
  console.log('node is running on '+ port);
});

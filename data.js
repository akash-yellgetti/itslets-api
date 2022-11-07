let express  = require('express');
let app      = express();
let http = require('http').Server(app);
let io = require('socket.io')(http);
 
io.on('connection', (socket) => {
  console.log("Hello");    
  socket.on('sendnotifi', function(socketID){
		io.to(socketID).emit('newtask', {
			delivery_id:1,
			order_id: 1,
			partner_id: 1, 
			delboy_id: 1,
			partner_name: "MTR", 
			partner_type: 1, 
			partner_type_var: "Restaurant", 
			del_location: "RT Nagar, Bengaluru - 560032",
			user_id: 1,
			user_name: "John Wick",
			timer_val: 10,
			from: socket.nickname, 
			created: new Date()
		});
  });
}); 
var port = process.env.PORT || 3001; 
http.listen(port, function(){
   console.log('listening in http://128.199.89.56:' + port);
});
<!-- 
*  Simple HTML websocket Client
*  original source: https://github.com/ghedipunk/PHP-WebSockets
*  this modified source: http://www.abrandao.com  
*  
*/
-->
<html>
<head>
<title>PHP Websocket Client</title>
<style>
 html,body{font:normal 0.9em arial,helvetica;}
 #log {width:440px; height:200px; border:1px solid #7F9DB9; overflow:auto;}
 #msg {width:330px;}
 .alert-box { width:75%;   color:#555;  border-radius:5px;   font-family:Tahoma,Geneva,Arial,sans-serif;font-size:11px;
    padding:5px 5px 5px 10px;    margin:10px;}
.alert-box span {    font-weight:bold;    text-transform:uppercase;}
.error {   background:#ffecec  ;  border:1px solid #f5aca6;}
.success {  background:#e9ffd9 ;   border:1px solid #a6ca8a; }
.warning { background:#fff8c4 ;  border:1px solid #f2c779;  }
.notice { background:#e3f7fc ;border:1px solid #8ed9f6;  }
</style>
</head>
<body onload="connect();">
 <h3>HTML5 WebSocket Client connecting to <span id="surl"> </span> </h3>
 <script>
  if ("WebSocket" in window)
  {
    document.write("<div class='alert-box success'><span>WebSockets supported!</span> Your browser can do websockets </div>");
  }
  else
  {
   // the browser doesn't support WebSockets
   document.write("<div class='alert-box error'><span>Error: No Websockets supported</span> Your Browser: "+ navigator.userAgent +" does not support websockets. Upgrade to modern browser </div>");
  }
  </script>
 
 <div id="log"></div>
 <input id="msg" type="textbox" onkeypress="onkey(event)"/>
 
 <button onclick="send()">Send</button>
 <button onclick="quit()">Quit</button><bR>
 <hr>
 <div>Commands:  hello,name,temp, age, date, time, thanks,id,users, bye</div>
 <hr>
 <div class='alert-box notice'><span>Update to your server</span> Change values below to match your server</div>
 Host:<input id="host" type="textbox" size="35" value="echo.websocket.org"/>
 Port:<input id="port" type="textbox" size="4" value="80"/>
 <button onclick="connect()">Re-connect</button>
<Hr>
 More details at:<a href="http://www.abrandao.com/2013/06/25/websockets-html5-php/">websockets abrandao.com</a>
 <script>
var socket;
var url = null;
var host= null;
var port=null;
var path=null;
function connect()
{
host=document.getElementById("host").value;
port=document.getElementById("port").value;
console.log("Connecting to "+host+":"+port);
 init();
}
function init(){
  host="ws://"+host+":"+port;
  url=host;
  console.log("Connecting to "+host+" url:"+url);
  document.getElementById("surl").innerText =url;
      log('trying WebSocket - : '+url);
  try{
    socket = new WebSocket(host);
    log('WebSocket - status '+socket.readyState);
    socket.onopen    = function(msg){ log("Welcome - status "+this.readyState); };
    socket.onmessage = function(msg){ 
   console.log("Ws-data"+msg);
   log("Server>: "+msg.data);
   };
    socket.onclose   = function(msg){ log("Disconnected - status "+this.readyState); };
  }
  catch(ex){ log(ex); }
  $("msg").focus();
}
function send(){
  var txt,msg;
  txt = $("msg");
  msg = txt.value;
  if(!msg){ alert("Message can not be empty"); return; }
  txt.value="";
  txt.focus();
  try
    {
   socket.send(msg); 
  log('>>: '+msg); } 
  catch(ex)
  { log(ex);   }
}
function quit(){
  log("Goodbye! "+url);
  socket.close();
  socket=null;
}
// Utilities
function $(id)
  { return document.getElementById(id); }
  
function log(msg){ 
  $("log").innerHTML+="<br>"+msg; 
  var textarea = document.getElementById('log');
  textarea.scrollTop = textarea.scrollHeight; //scroll to bottom
  }
  
function onkey(event){ if(event.keyCode==13){ send(); } }
</script>
 </body>
</html>

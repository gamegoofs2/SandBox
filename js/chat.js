var user = getCookie('username');
var password = getCookie('password');
if(!user && !password) {
    window.location = 'login/index.html';
}

setInterval("request()",500);
function request() {
    $.post("lib/display.php",
        function(data){
            document.getElementById("chat").innerHTML = data;
            var objDiv = document.getElementById("chat");
            objDiv.scrollTop = objDiv.scrollHeight;
   	});
}

function send(message) {
    $.post("lib/post.php", { msg: message, user: user },
        function(data) {
          if(data) {
            alert("Message failed to send:" + data);
          }
          else {
              document.getElementById('msg').value = "";
          }
        });
}

function keypress(e, message) {
    if(window.event) {
        e = window.event;
    }

    if(e.keyCode == 13) {
        send(message);
    }
}

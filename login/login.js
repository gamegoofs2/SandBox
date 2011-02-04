var user = getCookie('username');
var pass = getCookie('password');

if(getCookie('username') && getCookie('password')) {
    //Set below location to chat location
    window.location = "../chat.htm";
}

function collectData() {
    var user = document.getElementById('username').value;
    var pass = document.getElementById('password').value;

    $.post('login.php', {user: user, pass: pass},
        function(data){
            if(data){
                if(data == "true") {
                    createCookies(user, pass);
                    //Set below location to chat location
                    window.location = "../chat.htm";
                }
                else {
                    $('.error').html(data+"<br />");
                    $('.error').css('display', 'inline');
                }
            }
            else {
                $('.error').css('display', 'inline');
            }
    });
}

function createCookies(user, pass) {
    setcookie('username', user, 31);
    setcookie('password', pass, 31);
}



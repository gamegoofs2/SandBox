var username, password, password2, email, email2, image;
function register_click() {
    username = document.getElementById('username').value;
    password = document.getElementById('password').value;
    password2 = document.getElementById('password2').value;
    email = document.getElementById('email').value;
    email2 = document.getElementById('email2').value;
    //image = document.getElementById('image').value;

    send(username, password, password2, email, email2, image);
}
function keypress(e) {
        if(window.event) {
            e = window.event;
        }

        if(e.keyCode == 13) {
            username = document.getElementById('username').value;
            password = document.getElementById('password').value;
            password2 = document.getElementById('password2').value;
            email = document.getElementById('email').value;
            email2 = document.getElementById('email2').value;
            //image = document.getElementById('image').value;

            send(username, password, password2, email, email2, image);
        }
}
function send(username, password, password2, email, email2, image) {
    $.post("register.php", {username: username, password: password, password2: password2,
                            email: email, email2: email2, image: image},
        function(data) {
            alert(data);
            if(data == "taken") {
                $('#user').css('display', 'inline');
            }
            else if(data) {
                $('#error').css('display', 'inline');
            }
            else {
                $('#fields').animate({ opacity : 0}, 1000);
                $('#success').animate({ opacity : 1, top : '0px'}, 1000);
            }
        });
}


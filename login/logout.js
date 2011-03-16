function logout() {
    var username = getCookie("username");
    $.post('logout.php', { user: username},
        function(data){
           if(data) {
               setcookie('username', '', -1);
               setcookie('password', '', -1);
               window.location = 'login/index.html';
               return(1);
           }
           else {
               return(0);
           }
        });
}

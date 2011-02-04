function logout() {
    $.post('logout.php', { user: username},
        function(data){
           if(!data) {
               return(0);
           }
        });

    setcookie('username', '', -1);
    setcookie('password', '', -1);
    window.location = 'login/index.html';
}

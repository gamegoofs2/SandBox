<?php
    //Validation
    if(!$_POST['user'] && $_POST['pass']) {
        die();
    }
    include_once '../lib/sanitize.php'; //Sanitization functions
    include_once '../lib/users.php';
    include_once '../lib/config.php'; //Config file.
    
    //Gather user data.
    $username = sanitize($_POST['user']);
    $password = sanitize($_POST['pass']);

    //Convert password to salted.
    $password = md5("%#@b".$password."^*c!@");

    //Create connect and test it.
    $con = mysql_connect($dbhost, $dbuser, $dbpass);
    if(!$con) {
        die();
    }

    //Select database
    mysql_select_db($dbname);

    //Query database
    $sql = "SELECT username, password, image FROM users WHERE username='". $username ."' AND password='". $password ."'";
    $result = mysql_query($sql, $con);

    if(mysql_num_rows($result)) {
        mysql_fetch_array($result, MYSQL_ASSOC);
        if(addUser($username, $img)) {
            die("true");//Success
        }
        die("Already logged in.");//Failed to add user.
    }
    else {
        die("Incorrect user or password.");//Failure
    }
?>

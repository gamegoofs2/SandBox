<?php
    error_reporting(-1);
    include_once '../lib/sanitize.php'; //Import sanitization functions
    include_once '../lib/config.php'; //Import database info.

    //Connect to MySQL database
    $con = mysql_connect($dbhost, $dbuser, $dbpass);
    //Test connection.
    if(!$con) {
        die("1");
    }

    //Retrieve user input and sanitize it.
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];
    $email = $_POST['email'];
    $email2 = $_POST['email2'];
    //$image = $_POST['image'];

    //Verif data
    if(!$username) {
        die("2");
    }
    if(!$password) {
        die("3");
    }
    if($password != $password2) {
        die("4");
    }
    if(!$email) {
        die("5");
    }
    if($email != $email2) {
        die("6");
    }
    if(!preg_match('/\b[\w-]+@[\w-]+\.[A-Za-z_-]{2,4}\b/', $email)) {
        die("7");
    }
//    if(!$image) {
//        die("8");
//    }

    $password = md5("%#@b".$password."^*c!@");

    //Database name referenced in config.php
    mysql_select_db($dbname, $con);

    //Check to make sure username is not taken.
    $sql = "SELECT username FROM users WHERE username='".$username."'";
    $result = mysql_query($sql, $con);
    if(mysql_num_rows($result)) {
        die('taken');
    }

    //Submit user data to the database.
    $sql = "INSERT INTO `".$dbname."`.`users` (`id`, `username`, `password`, `email`, `image`)
            VALUES (NULL, '".$username."', '".$password."', '".$email."', '".$image."');";

    $result = mysql_query($sql, $con);

    if(!$result) {
        die("8");
    }
    //Script ran successfully.
?>

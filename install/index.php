<!--
Copyright(C) 2010 Evan Uebel
This file automates the install of Sandbox chat.
This file will create and setup the database
file according to its needs.
-->
<?php if(!$_POST['adminUser'] && !$_POST['adminPass'] && !$_POST['adminEmail']) {?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="install.css" rel="stylesheet" type="text/css" />

        <title>Sandbox Install</title>
    </head>
    <body>
        <div id="wrapper">
            <form id="form-wrapper" action="index.php" method="post" >
                Admin Username: <input type="text" name="adminUser" /><br />
                  <span class="mini">Master user for in chat commands. eg. admin</span><br /><br />
                Admin Password: &nbsp;&nbsp;<input type="password" name="adminPass" /><br />
                  <span class="mini">Password for said user.</span><br /><br />
                Confirm Password: <input type="password" name="passConf" /><br /><br />
                Admin Email: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="text" name="adminEmail" /><br />
                <span class="mini">Email address for admin user.</span><br />
                  <input type="submit" value="Install" />
            </form>
        </div>
    </body>
</html>
<?php }
else {
    include_once '../lib/config.php';
    //Retrieve all data
    $adminUser = $_POST['adminUser'];
    $adminPass = $_POST['adminPass'];
    $passConf = $_POST['passConf'];
    $adminEmail = $_POST['adminEmail'];
    
    //Ensure that passwords match
    if($adminPass != $passConf) {
        die('Passwords did not match. <a href="index.php">Back</a>');
    }

    //Start database connection
    $con = mysql_connect('localhost', $dbuser, $dbpass);
    
    //Test selected database
    if(!mysql_select_db($dbname)){
        die('Invalid database.');
    }

    //Create title table
    $sql = "CREATE TABLE `". $dbname ."`.`title` (`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `title` VARCHAR(100) NOT NULL, `user` VARCHAR(100) NOT NULL)
        ENGINE = MyISAM;";
    $result = mysql_query($sql, $con);
    if(!$result) {
        die('Title table failed to create. Click for <a href="#">help</a>.');
    }

    //Create user table
    $sql = "CREATE TABLE `". $dbname ."`.`users` (`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `username` VARCHAR(200) NOT NULL, `password` VARCHAR(200) NOT NULL,
        `email` VARCHAR(200) NOT NULL) ENGINE = MyISAM;";
    $result = mysql_query($sql, $con);
    if(!$result) {
        die('Username, password, email table failed to create. Click for <a href="#">help</a>.');
    }

    $sql = "INSERT INTO `". $dbname ."`.`users` (`id`, `username`, `password`, `email`)
        VALUES (NULL, '". $adminUser ."', '". $adminPass ."', '');";
    $result = mysql_query($sql, $con);
    if(!$result) {
        die('Admin user failed. Click for <a href="#">help</a>.');
    }
    //Send success message
    echo "Successful install! <a href='../chat.htm'>Chat Now!</a><br />
          You should now delete the install folder for security purposes.";
}
?>
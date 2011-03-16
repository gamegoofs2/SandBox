<?php
    $file = file("users.txt");
    $username = "liz\n";
    for($i=0;$i<count($file);$i++) {
        if ($file[$i] == $username) {
            unset($file[$i]);
            echo "Name deleted <br />";
            die();
        }
        else {
            echo $file[$i];
            echo "Name not found.<br />";
        }
    }
    print_r($file);
?>
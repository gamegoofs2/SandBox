<?php
    function addUser($username) {
        if(!$username) {
            return 0;
        }
        
        $username = strtolower($username);
        
        $file = file("../users.txt");
        foreach ($file as $array) {
            if($array == $username."\n") {
                return 0;
            }
        }

        $file = fopen("../users.txt", a);

        if (flock($file, LOCK_EX)) {
            fseek($file, 0, SEEK_END);
            fputs($file, "$username\n");
            flock($file, LOCK_UN);
        }
        fclose($file);
        return 1;
    }
?>

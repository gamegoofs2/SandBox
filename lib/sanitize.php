<?php
    function sanitize($string) {
        $string = stripslashes($string);
        $string = htmlentities($string);
        $string = strip_tags($string);
        return $string;
    }
    function sanitizeMySQL($string) {
        $string = mysql_real_escape_string($string);
        $string = sanitize($string);
    }

?>

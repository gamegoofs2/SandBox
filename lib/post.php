<?php
//die("Hello World");
$msg = $_POST['msg'];
$user = $_POST['user'];

if(!$msg) {
    die();
}

$message = "<span class='message'><span class='user-msg'>".$user."</span>".$msg."</span>";

$file = fopen("../chat.txt", a);

if (flock($file, LOCK_EX)) {
  fseek($file, 0, SEEK_END);
  fputs($file, "$msg\n");
  flock($file, LOCK_UN);
}
fclose($file);

?>
<?php
$file = file("../chat.txt");

foreach ($file as $array) {
  echo $array . "<br />";
}
?>
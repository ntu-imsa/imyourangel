<?php
require './lib/facebook.php';
require './lib/library.php';
$facebook->destroySession();
header("Location: ./");
?>
<?php
/*"SJSU CMPE 138 FALL 2023 TEAM4"*/
@include 'config.php';

session_start();
session_unset();
session_destroy();

header('location:login.php');

?>

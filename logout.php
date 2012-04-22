<?php
session_start();
unset($_SESSION); // clear all sesssion
session_destroy(); // session destroy if unset fail
header('Location:index.php');  //redirect and refresh the page
?>

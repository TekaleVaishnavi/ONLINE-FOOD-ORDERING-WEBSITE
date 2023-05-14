<?php
include('../confg/constants.php');
///display the session 
session_destroy();//unsets $_SESSION['user]
header('location:'.SITEURL.'admin/login.php');
//redirect to login page


?>
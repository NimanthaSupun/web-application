<?php
//Include constant.php for SITEURL
include('../config/constants.php');

//1. Display the Session
session_destroy();//unset $_SESSION['user']

//2. Redirect to Login page
header('location:'.SITEURL.'admin/login.php');
?>
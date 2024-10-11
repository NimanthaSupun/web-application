<?php

//Start Session
session_start();

//create constant to store non repeating values
define('SITEURL','http://localhost/sportsweb/');
define('LOCALHOST','localhost');
define('DB_USERNAME','root');
define('DB_PASSWORD','');
define('DB_NAME','ecommerce-sports');

$conn = mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD,) or die(mysqli_error($conn));//Database Connection
$db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error($conn));//Select Database

?>
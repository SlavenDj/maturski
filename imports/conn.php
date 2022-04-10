<?php 
$database_host = "localhost";
$database_user = "root";
$database_password = "";
$database_name = "maturski";
$mydb = mysqli_connect($database_host, $database_user, $database_password, $database_name);
if ($mydb->connect_error) 
    die("my_database failed: " . $mydb->connect_error);


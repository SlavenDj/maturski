<?php
$database_host = "fdb33.awardspace.net";
$database_user = "4091460_maturskii";
$database_password = "sifrazabazu1";
$database_name = "4091460_maturskii";






























// ! DALJE NE DIRATI NIŠTA !!!
if ($_SERVER["SERVER_NAME"] == "localhost") {
    $database_host = "localhost";
    $database_user = "root";
    $database_password = "";
    $database_name = "maturski";
}



$mydb = mysqli_connect($database_host, $database_user, $database_password, $database_name);
if ($mydb->connect_error)
    die("my_database failed: " . $mydb->connect_error);

mysqli_set_charset($mydb, "utf8");

<?php
$jmbg = $_GET['q'];
include "admin_files/conn.php";
include "admin_files/querys.php";

$ucenik = $mydb->query(findUcenik($jmbg));
if ($ucenik->num_rows == 0) 
    echo "false";
else{
    $ucenik= $ucenik->fetch_array();
    echo "Pronađen: {$ucenik["ime"]} {$ucenik["prezime"]}";
}
$mydb->close();
?>

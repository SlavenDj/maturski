<?php
for ($class = 6; $class <= 9; $class++)
    if (isset($_POST["dodaj_predmet_$class"]))
        $mydb->query(qryInsert($class));

if (isset($_POST["naziv_predmeta"]))
    $mydb->query("INSERT INTO `predmeti` (`Naziv`) VALUES (' {$_POST["naziv_predmeta"]}')");

if (isset($_POST["naziv_smera"]))
    $mydb->query("INSERT INTO `smer` (`Naziv`) VALUES (' {$_POST["naziv_smera"]}')");

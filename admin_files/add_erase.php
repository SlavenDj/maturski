<?php
for ($class = 6; $class <= 9; $class++)
    if (isset($_POST["dodaj_predmet_$class"]))
        $mydb->query(qryInsert($class));

if (isset($_POST["naziv_predmeta"]))
    $mydb->query(insertInto("predmeti", $_POST["naziv_predmeta"]));

if (isset($_POST["naziv_smera"]))
    $mydb->query(insertInto("smer", $_POST["naziv_smera"]));


function insertInto($table, $value)
{
    return "INSERT INTO `$table` (`Naziv`) VALUES ('$value')";
}

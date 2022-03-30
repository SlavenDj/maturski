<?php
include "querys.php";

function q5($x)
{
    return "INSERT INTO `veza_razred_predmet` 
    (`predmet`,`Razred`,`redni_broj`) VALUES 
    (" . $x["dodaj_ovaj_predmet_6"] . ",6," . (int)$x["redni_broj_6"] . ")";
}

if (isset($_POST["izbrisi_ovaj_predmet_6"]))
    if ($mydb->query($q4) !== TRUE)
        echo "Error: " . $q4 . "<br>" . $mydb->error;

if (isset($_POST["dodaj_ovaj_predmet_6"])) {
    if ($mydb->query(q5($_POST)) !== TRUE)
        echo "Error: " . q5($_POST) . "<br>" . $mydb->error;
}

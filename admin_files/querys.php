<?php

//svi predmeti
$sviPred = 
"SELECT id, naziv 
FROM predmeti";


$sviSmerovi = "SELECT id, naziv FROM smer";

function sviPred($class)
{
    return 
    "SELECT veza_razred_predmet.id, naziv
    FROM   `veza_razred_predmet`
    INNER JOIN `predmeti`
            ON predmeti.id = veza_razred_predmet.predmet
            AND razred = $class 
    ORDER  BY redni_broj";
}

function qryDelete($class)
{
    return 
    "DELETE 
    FROM `veza_razred_predmet` 
    WHERE ID=" . (int)$_POST["izbrisi_predmet_$class"];
}
function qryInsert($class)
{
    return "INSERT INTO `veza_razred_predmet` 
    (`predmet`,`Razred`,`redni_broj`) VALUES 
    (" . $_POST["dodaj_predmet_$class"] . ",$class," . (int)$_POST["redni_broj_$class"] . ")";
}


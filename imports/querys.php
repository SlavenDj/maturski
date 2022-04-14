<?php

//svi predmeti
$sviPred = 
"SELECT id, naziv 
FROM predmeti";

function sviPred($x)
{
    return 
    "SELECT veza_razred_predmet.id, naziv
    FROM   `veza_razred_predmet`
    INNER JOIN `predmeti`
            ON predmeti.id = veza_razred_predmet.predmet
            AND razred = $x 
    ORDER  BY redni_broj";
}

function qryDelete($x)
{
    return 
    "DELETE 
    FROM `veza_razred_predmet` 
    WHERE ID=" . (int)$_POST["izbrisi_ovaj_predmet_$x"];
}
function qryInsert($x)
{
    return "INSERT INTO `veza_razred_predmet` 
    (`predmet`,`Razred`,`redni_broj`) VALUES 
    (" . $_POST["dodaj_ovaj_predmet_$x"] . ",$x," . (int)$x["redni_broj_$x"] . ")";
}


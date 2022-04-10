<?php

//svi predmeti
$sviPred = "SELECT id, naziv FROM predmeti";




//brisanje_predmeta
@$q4 =
    "DELETE FROM `veza_razred_predmet` 
    WHERE ID=" . (int)$_POST["izbrisi_ovaj_predmet_6"];

//ubacivanje predmeta


function q5($x)
{
    return "INSERT INTO `veza_razred_predmet` 
    (`predmet`,`Razred`,`redni_broj`) VALUES 
    (" . $x["dodaj_ovaj_predmet_6"] . ",6," . (int)$x["redni_broj_6"] . ")";
}
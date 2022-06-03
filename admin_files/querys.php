<?php
$sviPred = "SELECT id, naziv FROM predmeti";
$sviSmerovi = "SELECT id, naziv FROM smer";

function sviPred($class)
{
    return
        "SELECT
        veza_razred_predmet.id,
        predmeti.naziv, Redni_broj,
        predmeti.id AS ID_predmeta
        FROM
            `veza_razred_predmet`
            INNER JOIN `predmeti` ON predmeti.id = veza_razred_predmet.predmet
            AND razred = $class
        ORDER BY
            redni_broj";
}

function qryDelete($class)
{
    return
        "DELETE
        FROM   `veza_razred_predmet`
        WHERE  id=" . (int)$_POST["izbrisi_predmet_$class"];
}

function qryInsert($class)
{
    return "INSERT INTO `veza_razred_predmet` (
                    `predmet`,
                    `razred`,
                    `redni_broj`
                )
                VALUES
                (
                    {$_POST["dodaj_predmet_$class"]},
                    $class,
                    {$_POST["redni_broj_$class"]}  
                )";
}

function findUcenik($jmbg)
{
    return "SELECT *, ucenik.id AS ucenikID
            FROM   ucenik 
            WHERE  jmbg = '$jmbg';";
}

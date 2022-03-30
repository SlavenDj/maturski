<?php

//svi predmeti
$q2 = "SELECT id, naziv FROM predmeti";

//nazivi i ids predmeti sestog razreda
$q3 =
    "SELECT veza_razred_predmet.id,
naziv
FROM   `veza_razred_predmet`
INNER JOIN `predmeti`
        ON predmeti.id = veza_razred_predmet.predmet
           AND razred = 6 
ORDER  BY redni_broj";

//brisanje_predmeta
$q4 =
    "DELETE FROM `veza_razred_predmet` 
    WHERE ID=" . (int)$_POST["izbrisi_ovaj_predmet_6"];

//ubacivanje predmeta



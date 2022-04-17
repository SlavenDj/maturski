<?php


for ($i = 6; $i < 10; $i++) {
    if (isset($_POST["izbrisi_predmet_$i"]))
        if ($mydb->query(qryDelete($i)) !== TRUE)
            echo "Error: " . qryDelete($i) . "<br>" . $mydb->error;

    if (isset($_POST["dodaj_predmet_$i"]))
        if ($mydb->query(qryInsert($i)) !== TRUE)
            echo "Error: " . qryInsert($i) . "<br>" . $mydb->error;
}
if (isset($_POST["izbrisi_predmet"]))
    $mydb->query("DELETE FROM predmeti WHERE ID=" . (int)$_POST["izbrisi_predmet"]);

//dodavanje predmeta    
if (isset($_POST["naziv_predmeta"]))
    if ($mydb->query("INSERT INTO `predmeti` (`Naziv`) VALUES ('" . $_POST["naziv_predmeta"] . "');") !== TRUE)
        echo "Error: " . $mydb->error;

<?php



if (isset($_POST["izbrisi_ovaj_predmet_6"]))
    if ($mydb->query($q4) !== TRUE)
        echo "Error: " . $q4 . "<br>" . $mydb->error;

if (isset($_POST["dodaj_ovaj_predmet_6"])) {
    if ($mydb->query(q5($_POST)) !== TRUE)
        echo "Error: " . q5($_POST) . "<br>" . $mydb->error;
}

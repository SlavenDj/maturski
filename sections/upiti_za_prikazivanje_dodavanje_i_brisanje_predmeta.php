<?php
include "querys.php";
//brisanje predmeta
if (isset($_POST["izbrisi_ovaj_predmet"]))
    $mydb->query("DELETE FROM predmeti WHERE ID=" . (int)$_POST["izbrisi_ovaj_predmet"]);

//dodavanje predmeta    
if (isset($_POST["naziv_predmeta"]))
    if ($mydb->query("INSERT INTO `predmeti` (`Naziv`) VALUES ('" . $_POST["naziv_predmeta"] . "');") !== TRUE)
        echo "Error: " . $mydb->error;

//vadjenje predmeta
$svi_predmeti = $mydb->query($q2);
if ($svi_predmeti->num_rows > 0) {
    echo "<table><th>Naziv predmeta</th>";
    while ($predmet = $svi_predmeti->fetch_assoc()) {
        echo "<tr><td>" . $predmet["naziv"] . "</td>   </tr>";
    }
    echo "</table>";
} else
    echo "Nema rezultata";


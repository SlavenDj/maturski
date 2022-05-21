<?php
$table = "smer";
$res = $mydb->query("SELECT id, naziv FROM {$table}");

if ($res->num_rows <= 0)
    echo "<p class='not-found'>Nema rezultata</p>";
else {
    echo "<table><th>Naziv smera</th>";
    while ($row = $res->fetch_assoc())
        echo "<tr><td>{$row["naziv"]} </td> 
            <td> " .
            button($row["id"], "Ukloni", $table, "delete", null) .
            button($row["id"], "Preimenuj", $table, "edit", null) .
            "</td></tr>";
    echo "</table>";
}
?>
<form method="POST" class="obrazac_dodavanja">
    <input type="text" name="naziv_smera" id="naziv_smera" placeholder="Novi smer">
    <button>Dodaj novi smer</button>
</form>
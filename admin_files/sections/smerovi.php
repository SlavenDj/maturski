<?php


$table = "smer";
$res = $mydb->query("SELECT id, naziv FROM {$table}");

if ($res->num_rows <= 0) {
    echo "<p class='not-found'>Nema rezultata</p>";
    return;
}

echo "<table><th>Naziv predmeta</th>";
while ($predmet = $res->fetch_assoc())
    echo "<tr><td>{$predmet["naziv"]} </td> 
        <td> " .  btns($predmet["id"], $table, $btnText1, $btnText2) . "</td>
        </tr>";
echo "</table>";

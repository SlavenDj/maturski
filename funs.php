<?php
/*
* db = dababase
* q = query
* n = name
TODO: napravti funckiju da pikazivnje ekrana kad nema sadrzaja
 */

$btns=
"
<button data-id=>  
";
function btns($id){
    return "
    <button data-id=$id class='delete'> Ukloni </button>
    </td><td>
    <button data-id=$id class='edit'> Promeni ime i redosled </button>
    ";
}
function printInTable($db, $q)
{
    $res = $db->query($q);
    if ($res->num_rows > 0) {
        echo "<table><th>Naziv predmeta</th>";
        while ($predmet = $res->fetch_assoc())
            echo "<tr><td>" . $predmet["naziv"] . "</td> <td> ".  btns($predmet["id"]) ."</td></tr>";
        echo "</table>";
        return;
    }
    echo "Nema rezultata";
}

function selectMenu($db, $q, $n)
{
    echo "<select name='$n'>";
    echo "<option value=" . 000 . "> --- </option>";
    $res = $db->query($q);
    if ($res->num_rows > 0) {
        while ($predmet = $res->fetch_assoc())
            echo "<option value=" . $predmet["id"] . ">" . $predmet["naziv"] . "</option>";
        echo "</select>";
        return;
    }
    echo "Nema rezultata";
}

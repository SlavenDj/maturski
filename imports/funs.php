<?php
/*
    * db = dababase
    * q = query
    * n = name
    TODO: napravti funckiju da pikazivnje ekrana kad nema sadrzaja
    */


function btns($id)
{
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
            echo "<tr><td>" . $predmet["naziv"] . "</td> <td> " .  btns($predmet["id"]) . "</td></tr>";
        echo "</table>";
        return;
    }
    echo "<p>Nema rezultata</p>";
}

function selectMenu($db, $q, $n)
{
    $res = $db->query($q);
    if ($res->num_rows > 0) {
        echo "<select name='$n'>";
        echo "<option value=" . 000 . "> --- </option>";
        while ($predmet = $res->fetch_assoc())
            echo "<option value=" . $predmet["id"] . ">" . $predmet["naziv"] . "</option>";
        echo "</select>";
        return;
    }
    echo "<p>Nema rezultata</p>";
}


function sviPred($x)
{
    return "SELECT veza_razred_predmet.id,
            naziv
            FROM   `veza_razred_predmet`
            INNER JOIN `predmeti`
                    ON predmeti.id = veza_razred_predmet.predmet
                    AND razred = $x 
            ORDER  BY redni_broj";
}


function qryDelete($x)
{
    return "DELETE FROM `veza_razred_predmet` 
    WHERE ID=" . (int)$_POST["izbrisi_ovaj_predmet_$x"];
}

function qryInsert($x)
{
    return "INSERT INTO `veza_razred_predmet` 
    (`predmet`,`Razred`,`redni_broj`) VALUES 
    (" . $_POST["dodaj_ovaj_predmet_$x"] . ",$x," . (int)$x["redni_broj_$x"] . ")";
}


function grade($grade, $class, $subject)
{
    return "
    <label for='$subject-$grade-$class'> $grade
        <input type = 'radio' 
            value='$grade' 
            id='$subject-$grade-$class'  
            name='$subject-$class' > 
    </label>";
};
function insertingGrades($db, $class)
{
    echo "<p>Ocene u $class. razredu</p>";
    $res = $db->query(sviPred($class));
    if ($res->num_rows > 0) {

        echo "<table><th>Naziv predmeta</th>";
        while ($subject = $res->fetch_assoc())
            echo "<tr><td>" . $subject["naziv"] . "</td> <td>" .

                grade(2, $class, $subject["naziv"]) .
                grade(3, $class, $subject["naziv"]) .
                grade(4, $class, $subject["naziv"]) .
                grade(5, $class, $subject["naziv"]) .

                "</td></tr>";
        echo "</table>";
        return;
    }
    echo "<p>Nema predmeta podešenih u $class. razredu</p>";
}
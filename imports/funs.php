<?php
/*
    * db = dababase
    * q = query
    * n = name
    TODO: napravti funckiju da pikazivnje ekrana kad nema sadrzaja
    */

function btns($id, $txt1="Ukloni", $txt2="Promeni raspored")
{
    return "
    <button data-id=$id class='delete'> $txt1 </button>
    </td><td>
    <button data-id=$id class='edit'> $txt2 </button>
    ";
}
function printInTable($db, $q, $btnText1,$btnText2 )
{
    $res = $db->query($q);
    if ($res->num_rows > 0) {
        echo "<table><th>Naziv predmeta</th>";
        while ($predmet = $res->fetch_assoc())
            echo "<tr><td>" . $predmet["naziv"] . "</td> <td> " .  btns($predmet["id"], $btnText1 ,$btnText2 ) . "</td></tr>";
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

function grade($grade, $class, $subject)
{
    return "
    <label for='$subject-$grade-$class'> $grade
        <input type = 'radio' 
            value='$grade' 
            id='$subject-$grade-$class'  
            name='$subject-$class' > 
    </label>";
}

function insertingGrades($db, $class)
{
    echo "<div>";
    echo "<p>Ocene u $class. razredu</p>";
    $res = $db->query(sviPred($class));
    if ($res->num_rows > 0) {
        showSubjects($res, $class);
        echo "</div>";
        return;
    }
    echo "<p>Nema predmeta podešenih u $class. razredu</p>";
    echo "</div>";
}
function showSubjects($res, $class)
{
    echo "<table><th>Naziv predmeta</th>";
    while ($subject = $res->fetch_assoc())
        echo "<tr><td>" . $subject["naziv"] . "</td> <td>" .

            grade(2, $class, $subject["naziv"]) .
            grade(3, $class, $subject["naziv"]) .
            grade(4, $class, $subject["naziv"]) .
            grade(5, $class, $subject["naziv"]) .

            "</td></tr>";
    echo "</table>";
}

<?php
/*
    * db = dababase
    * q = query
    * n = name
    TODO: napravti funckiju da pikazivnje ekrana kad nema sadrzaja
    */

function btns(string $id, string $txt1, string $txt2, $table)
{
    return "
    <button data-id=$id data-table=$table class='delete'> $txt1 </button>
    </td><td>
    <button data-id=$id data-table=$table class='edit'> $txt2 </button>
    ";
}
function printInTable(mysqli $db, $table, string $q, string $btnText1 = "Ukloni", string $btnText2 = "Promeni raspored")
{
    $res = $db->query($q);

    if ($res->num_rows <= 0) {
        echo "<p class='not-found'>Nema rezultata</p>";
        return;
    }

    echo "<table><th>Naziv predmeta</th>";
    while ($predmet = $res->fetch_assoc())
        echo "<tr><td>{$predmet["naziv"]} </td> 
        <td> " .  btns($predmet["id"], $btnText1, $btnText2, $table) . "</td>
        </tr>";
    echo "</table>";
}

function selectMenu($db, $q, $n)
{
    $res = $db->query($q);

    if ($res->num_rows <= 0) {
        echo "<p class='not-found'>Nema rezultata</p>";
        return;
    }

    echo "<select name='$n'>";
    echo "<option value=" . 000 . "> --- </option>";
    while ($predmet = $res->fetch_assoc())
        echo "<option value=" . $predmet["id"] . ">" . $predmet["naziv"] . "</option>";
    echo "</select>";;
}

function grade($grade, $class, $subject)
{
    return "
    <label for='$subject-grad-$grade-class-$class'> $grade
        <input type = 'radio' 
            value='$grade' 
            id='$subject-grad-$grade-class-$class'  
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

    echo "<p class='not-found'>Nema predmeta podešenih u $class. razredu</p>";
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
function prikaziSmer($mydb, $sviSmerovi, $title, $index, $not_found_message){
    $res = $mydb->query($sviSmerovi);

    if ($res->num_rows == 0) {
        echo "<p class='not-found'>{$not_found_message}</p>";
        return;
    }


    echo "<table><th>{$title}</th>";
    while ($row = $res->fetch_assoc())
        echo "<tr><td> {$row["naziv"]} </td> 
        <td> <input value = '{$row["id"]}' type='radio' name='smer-{$index}'value=></td>
    </tr>";
    echo "</table>";
}

function predmetiU($mydb, $class)
{
    echo "<div class='Predmeti'>
    <h2>
        Predmeti u {$class}. razredu
    </h2>";

    printInTable($mydb, "veza_razred_predmet", sviPred($class));

    echo "<form method='POST'>";

    selectMenu($mydb, "SELECT id, naziv FROM predmeti", "dodaj_predmet_{$class}");
    echo
    "
    <input 
    type='number' 
    id='redni_broj_{$class}' 
    name='redni_broj_{$class}' 
    required 
    placeholder='Redni broj predmeta na svedočanstvu'>
    <button>dodaj</button>
    </form>
    <form method='POST'>";
    selectMenu($mydb, sviPred($class), 'izbrisi_predmet_{$class}');
    echo "<button>Ukloni</button></form></div>";
}
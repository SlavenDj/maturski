<?php
function printInTable(
    $database,
    $sql_table,
    $query,
    $table_header,
    $btnText1 = "Ukloni",
    $btnText2 = "Promeni raspored"
) {
    $result = $database->query($query);

    if ($result->num_rows == 0) {
        echo "<div class='not-found'>Nema rezultata</div>";
        return;
    }

    echo "<table><th>{$table_header}</th>";
    while ($row = $result->fetch_assoc())
        echo
        "<tr><td>{$row["naziv"]} </td> " .
            button($row["id"], $btnText1, $sql_table, "delete") .
            button($row["id"], $btnText2, $sql_table, "edit") .
            "</tr>";
    echo "</table>";
}

function button(
    $id,
    $txt,
    $sql_table,
    $html_class
) {
    return "
    <td>
    <button 
        data-id=$id 
        data-table=$sql_table 
        class={$html_class}>$txt</button></td>";
}

function selectMenu($database, $query, $selectMenuName)
{
    $res = $database->query($query);

    if ($res->num_rows == 0) {
        echo "<p class='not-found'>Nema rezultata</p>";
        return;
    }

    echo "<select name='$selectMenuName'>";
    echo "<option value=" . 000 . "> List svih predmeta </option>";
    while ($predmet = $res->fetch_assoc())
        echo "<option value=" . $predmet["id"] . ">" . $predmet["naziv"] . "</option>";
    echo "</select> ";
}

function grade($grade, $class, $subject)
{
    /*return "
    <label for='$subject-grad-$grade-class-$class'> $grade
        <input type = 'radio' 
            value='$grade' 
            id='$subject-grad-$grade-class-$class'  
            name='$subject-$class' 
            class='ocena'
            data-ocena='$grade'
            > 
    </label>";*/

    return "
    
        <input type = 'radio' 
            value='$grade' 
            id='$subject-grad-$grade-class-$class'  
            name='$subject-$class' 
            class='ocena'
            data-ocena='$grade'
            > 
    ";
}

function insertingGrades($database, $class)
{
    echo "<div id='ocene-$class'>";
    echo "<p>Ocene u $class. razredu</p>";
    $res = $database->query(sviPred($class));
    if ($res->num_rows > 0) {
        showSubjects($res, $class);
        if ($class == 9)
        echo "<button type= >Prijavi se</button></div>";
        else
        echo "<button type='button' class='back'>Nazad</button>
        <button type='button' class='next'>Dalje</button></div>";
        return;
    }

    echo "<p class='not-found'>Nema predmeta podešenih u $class. razredu</p>";
    echo " <button type='button' class='back'>Nazad</button>
    <button type='button' class='next'>Dalje</button></div>";
}
function showSubjects($res, $class)
{
    echo "<table><th>Naziv predmeta</th>";
    while ($subject = $res->fetch_assoc())
        echo "<tr><td>" . $subject["naziv"] . "</td> <td>" .
            grade(2, $class, $subject["ID_predmeta"]) .
            grade(3, $class, $subject["ID_predmeta"]) .
            grade(4, $class, $subject["ID_predmeta"]) .
            grade(5, $class, $subject["ID_predmeta"]) .
            "</td></tr>";
    echo "</table>";
}
function prikaziSmer($mydb, $sviSmerovi, $title, $index, $not_found_message)
{
    $res = $mydb->query($sviSmerovi);

    if ($res->num_rows == 0) {
        echo "<p class='not-found'>{$not_found_message}</p>";
        return;
    }


    echo "<table><th>{$title}</th>";
    while ($row = $res->fetch_assoc())
        echo "<tr><td> {$row["naziv"]} </td> 
        <td> <input value = '{$row["id"]}' type='radio' name='smer-{$index}'></td>
    </tr>";
    echo "</table>";
}

function predmetiU($class)
{
    include "conn.php";
    echo "<div class='Predmeti'>
    <h2>
        Predmeti u {$class}. razredu
    </h2>";

    printInTable($mydb, "veza_razred_predmet", sviPred($class), "Naziv predmeta");

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

    echo "</form></div>";
}
function prikaziSmerUcenik($mydb, $sviSmerovi, $title, $index, $not_found_message, $polje_name, $ucenik)
{
    $res = $mydb->query($sviSmerovi);

    if ($res->num_rows == 0) {
        echo "<p class='not-found'>{$not_found_message}</p>";
        return;
    }

    echo "<table><th>{$title}</th>";
    while ($row = $res->fetch_assoc()) {
        echo "<tr><td> {$row["naziv"]} </td> 
                <td> <input value = '{$row["id"]}' type='radio' name='smer-{$index}'";
        if ($ucenik[$polje_name] == $row["id"])
            echo "checked";
        echo "></td>
            </tr>";
    }
    echo "</table>";
}

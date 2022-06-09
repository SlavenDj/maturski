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
    //<p class='predmer'></p>

    {
        $prefix = "";
        $redni_broj = "";
        if (isset($row["Redni_broj"])) {
            $prefix = $row["Redni_broj"] . ".";
            $redni_broj = $row["Redni_broj"];
        }

        echo
        "<tr><td> $prefix {$row["naziv"]} </td> " .
            button($row["id"], $btnText1, $sql_table, "delete", $redni_broj) .
            button($row["id"], $btnText2, $sql_table, "edit", $redni_broj) .
            "</tr>";
    }
    echo "</table>";
}

function button(
    $id,
    $txt,
    $sql_table,
    $html_class,
    $redniBroj
) {
    return "
    <td>
    <button 
        data-id='$id' 
        data-redni-broj='$redniBroj '
        data-table='$sql_table'
        class='{$html_class}'>$txt</button></td>";
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
    $checked = ''; 
    // if ($grade == 5) $checked = 'checked'; 
    // ! CHECK THIS OUT
    return "
        <input type = 'radio' 
            value='$grade' 
            id='$subject-grad-$grade-class-$class'  
            name='$subject-$class' 
            class='ocena ocena-$grade'
            data-ocena='$grade'
            $checked
            > 
    ";
}

function insertingGrades($database, $class)
{
    echo "<div id='ocene-$class'>";
    echo "<h3 class='ocene-title' data-razred='$class'>$class</h3>";
    $res = $database->query(sviPred($class));
    if ($res->num_rows > 0) {
        showSubjects($res, $class);
        echo "</div>";
        return;
    }

    echo "<p class='not-found'>Nema predmeta podešenih u $class. razredu</p>";
    echo " </div>";
}
function showSubjects($res, $class)
{
    echo "<table class='tabela-ocena'><th>Naziv predmeta</th>";
    while ($subject = $res->fetch_assoc())
        echo "<tr><td class='naziv-predmeta'>" . $subject["naziv"] . "</td> <td class='ocene-2-3-4-5'>" .
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

    echo "<label id='smer-$index-title' for='smer$index'>{$title}</label>";
    echo "<select name='smer-$index' id='smer$index'>";
    if ($index + 1 == 2)
        echo "<option value='0'> Ne želim drugo zanimanje </option> ";
    while ($row = $res->fetch_assoc())
        echo "<option value='{$row["id"]}'> {$row["naziv"]} </option> ";
    echo "</select>";
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
    echo "<label for =''>{$title}</label>";
    echo "<select name='smer-{$index}'> id='smer-{$index}'>";
    if ($index + 1 == 2)
        echo "<option> Ne želim drugo zanimanje </option>
        ";

    while ($row = $res->fetch_assoc()) {
        echo "<option value='{$row["id"]}'";
        if ($ucenik[$polje_name] == $row["id"])
            echo "selected";
        echo "> {$row["naziv"]} </option>  ";
    }
    echo "</select>";
}

function sviPred2($class)
{
    return
        "SELECT skracenica, veza_razred_predmet.id, naziv, predmeti.id AS ID_predmeta
                    FROM   `veza_razred_predmet`
                    INNER JOIN `predmeti`
                            ON predmeti.id = veza_razred_predmet.predmet
                            AND razred = $class 
                    ORDER  BY redni_broj";
}

function gradeUcenik($grade, $class, $subject, $mark)
{
    $stringX = "
    <label for='$subject-grad-$grade-class-$class'> $grade
        <input type = 'radio' 
            value='$grade' 
            id='$subject-grad-$grade-class-$class'  
            name='$subject-$class' 
            ";


    if ($mark == $grade)
        $stringX .= "checked";

    $stringX .= "> </label>";
    return $stringX;
}

function insertingGradesUcenik($database, $class, $ucenikId)
{
    echo "<div>";
    echo "<p>Ocene u $class. razredu</p>";
    $res = $database->query(sviPred2($class));
    if ($res->num_rows > 0) {
        showSubjectsUcenik($res, $class, $ucenikId);
        echo "</div>";
        return;
    }

    echo "<p class='not-found'>Nema predmeta podešenih u $class. razredu</p>";
    echo "</div>";
}

function insertingGradesUcenikSuzeni($database, $class, $ucenikId)
{
    echo "<div>";
    // echo "<p>Ocene u $class. razredu</p>";
    $res = $database->query(sviPred2($class));
    if ($res->num_rows > 0) {
        showSubjectsUcenikSuzeni($res, $class, $ucenikId);
        echo "</div>";
        return;
    }

    echo "<p class='not-found'>Nema predmeta podešenih u $class. razredu</p>";
    echo "</div>";
}

function showSubjectsUcenikSuzeni($res, $class, $ucenikId)
{
    include "admin_files/conn.php";
    // echo "<table><th>Naziv predmeta</th>";
    $skracenice = "<div class='red-sracenica'>";
    $redOcena = "<div class='red-ocena'>";
    while ($subject = $res->fetch_assoc()) {
        $mark = $mydb->query("SELECT ocena From ocena WHERE razred=$class AND ucenik=$ucenikId AND predmet={$subject["ID_predmeta"]}");
        $mark = $mark->fetch_assoc();
        if(isset($mark["ocena"]))
        $mark = $mark["ocena"];
        else
        $mark='';
        $Tag = "span";
        $skracenice = $skracenice . "<$Tag>{$subject["skracenica"]}  </$Tag>";
        // ! HERE
        $redOcena = $redOcena . "<$Tag> <input value='$mark'
        class='ocena-polje'
        
        type='number' name='{$subject["ID_predmeta"]}-$class' min='2' max='5' placeholder='X'
        oninput = '
            
            let max = parseInt(this.max);
            let min = parseInt(this.min);
    
            if (parseInt(this.value) > max) 
                this.value = max; 
                if (parseInt(this.value) < min) 
                this.value = min; 
        '
        
        
        > </$Tag>";
    }
    echo "$skracenice </div>  $redOcena </div>";
}

function showSubjectsUcenik($res, $class, $ucenikId)
{
    include "admin_files/conn.php";
    echo "<table><th>Naziv predmeta</th>";
    while ($subject = $res->fetch_assoc()) {
        $mark = $mydb->query("SELECT ocena From ocena WHERE razred=$class AND ucenik=$ucenikId AND predmet={$subject["ID_predmeta"]}");
        $mark = $mark->fetch_assoc();

        @$mark = $mark["ocena"];
        //echo $mark;
        echo "<tr><td>" . $subject["naziv"] . "</td> <td>" .
            gradeUcenik(2, $class, $subject["ID_predmeta"], $mark) .
            gradeUcenik(3, $class, $subject["ID_predmeta"], $mark) .
            gradeUcenik(4, $class, $subject["ID_predmeta"], $mark) .
            gradeUcenik(5, $class, $subject["ID_predmeta"], $mark) .
            "</td></tr>";
    }
    echo "</table>";
}



function insertingGradesUcenikSuzeni2($database, $class)
{
    echo "<div>";
    // echo "<p>Ocene u $class. razredu</p>";
    $res = $database->query(sviPred2($class));
    if ($res->num_rows > 0) {
        showSubjectsUcenikSuzeni2($res, $class);
        echo "</div>";
        return;
    }

    echo "<p class='not-found'>Nema predmeta podešenih u $class. razredu</p>";
    echo "</div>";
}


function showSubjectsUcenikSuzeni2($res, $class)
{
    // include "admin_files/conn.php";
    // echo "<table><th>Naziv predmeta</th>";
    $skracenice = "<div class='red-sracenica'>";
    $redOcena = "<div class='red-ocena'>";
    while ($subject = $res->fetch_assoc()) {

        //echo $mark;
        $Tag = "span";
        $skracenice = $skracenice . "<$Tag>{$subject["skracenica"]}  </$Tag>";
        // ! HERE
        $redOcena = $redOcena . "<$Tag> <input 
        class='ocena-polje'
        
        type='number' name='{$subject["ID_predmeta"]}-$class' min='2' max='5' placeholder='X'
        oninput = '
            let max = parseInt(this.max);
            let min = parseInt(this.min);
    
            if (parseInt(this.value) > max) 
                this.value = max; 
                if (parseInt(this.value) < min) 
                this.value = min; 
        '
        
        
        > </$Tag>";
    }
    echo "$skracenice </div>  $redOcena </div>";
}


function logOut()
{
    session_unset();
    session_destroy();
    header("Location: index.php");
}

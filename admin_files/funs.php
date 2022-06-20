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
            class='ocena ocena-$grade razred-$class'
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
        if (isset($mark["ocena"]))
            $mark = $mark["ocena"];
        else
            $mark = '';
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
    header("Location: ./");
}
function addNewUserQuery($usename, $password)
{
    return
        "INSERT INTO `admin` (`username`, `password`) 
                VALUE (
                    '$usename',
                    '$password')";
}
function addNewUser($db, $username, $password)
{
    $db->query(addNewUserQuery($username, password_hash($password, PASSWORD_DEFAULT)));
}

function updatePasswordQuery($userId, $password)
{
    $password = password_hash($password, PASSWORD_DEFAULT);
    return
        "UPDATE `admin` 
                SET `password`='$password' 
            WHERE id=$userId";
}

function oceneIz($db, $id, $razred, $ucenik)
{
    $predmet = $db->query("SELECT ocena FROM ocena WHERE predmet=$id AND razred=$razred AND ucenik=$ucenik");
    $predmet = $predmet->fetch_array();
    return $predmet["ocena"];
}

function verifyLogInInfo($mydb, $username, $password)
{
    $query = "SELECT `id`, `password` FROM `admin` where `username`='$username'";
    $admin = ($mydb->query($query))->fetch_array();
    if (isset($admin["id"]) && password_verify($password, $admin["password"])) {
        $_SESSION["userID"] = $admin["id"];
        $_SESSION["username"] = $username;
        return true;
    }
    return false;
}

function prikaziTabeluPregledanihUcenika($mydb)
{
    $idijeviPredmetaZaRacunanje = array(1, 2, 14, 20, 16);
    echo '<table class="export">
    <thead>
        <tr>
            <td rowspan="3">Rd. br.</td>
            <td rowspan="3"> Prezime i ime </td>
            <td rowspan="3">Ime oca</td>
            <td colspan="5" rowspan="2">Bodovi po uspjehu</td>
            <td colspan="11">Bodovi po predmetima</td>
            <td rowspan="3">Svega</td>
        </tr>
        <tr>
            <td colspan="2">Srpski</td>
            <td colspan="2">Strani j.</td>
            <td colspan="2">Matem.</td>
            <td colspan="2">Fizika</td>
            <td colspan="2">Inform.</td>
            <td rowspan="2">Ukupno</td>
        </tr>
        <tr>
            <td>VI</td>
            <td>VII</td>
            <td>VIII</td>
            <td>IX</td>
            <td>Ukupno</td>
            <td>VIII</td>
            <td>IX</td>
            <td>VIII</td>
            <td>IX</td>
            <td>VIII</td>
            <td>IX</td>
            <td>VIII</td>
            <td>IX</td>
            <td>VIII</td>
            <td>IX</td>
        </tr>
    </thead>';
    $pregledaniUcenici = $mydb->query("SELECT * FROM ucenik WHERE pregledano=1");
    $redniBroj = 0;
    while ($row = $pregledaniUcenici->fetch_array()) {
        $redniBroj++;
        echo "<tr>
                <td>
                    $redniBroj. 
                </td>
                <td>
                <a href='../ucenikSuzbijen.php?jmbg={$row["jmbg"]}'> 
                    {$row["prezime"]} {$row["ime"]} 
                    </a>
                </td>
                <td>
                    {$row["ime_oca"]} 
                </td>";
        $opstiUpseh = 0;
        $predmeti = 0;
        for ($razred = 6; $razred <= 9; $razred++) {
            $ocene = $mydb->query("SELECT * FROM ocena WHERE ucenik={$row["ID"]} AND razred=$razred");
            $prosek = 0;
            $brojPredmeta = 0;
            while ($jednaOcena = $ocene->fetch_array()) {
                $prosek += $jednaOcena["ocena"];
                $brojPredmeta++;
                if (in_array($jednaOcena["predmet"], $idijeviPredmetaZaRacunanje) && $razred >= 8)
                    $predmeti += $jednaOcena["ocena"] / 5.0 * 2;
            }
            if ($brojPredmeta) {
                echo "<td>" . round($prosek / $brojPredmeta, 2) . "</td>";

                $opstiUpseh += ($razred <= 7) ? $prosek / $brojPredmeta  * 2 : $prosek / $brojPredmeta  * 3;
            }
        }
        echo " <td>" . round($opstiUpseh, 2) . "</td>";
        echo "<td>" . oceneIz($mydb, 14, 8, $row["ID"]) . "</td>"; //srpski 
        echo "<td>" . oceneIz($mydb, 14, 9, $row["ID"]) . "</td>";

        echo "<td>" . oceneIz($mydb, 16, 8, $row["ID"]) . "</td>"; //eng 
        echo "<td>" . oceneIz($mydb, 16, 9, $row["ID"]) . "</td>";

        echo "<td>" . oceneIz($mydb, 1, 8, $row["ID"]) . "</td>"; //matematika 
        echo "<td>" . oceneIz($mydb, 1, 9, $row["ID"]) . "</td>";

        echo "<td>" . oceneIz($mydb, 2, 8, $row["ID"]) . "</td>"; //fizika 
        echo "<td>" . oceneIz($mydb, 2, 9, $row["ID"]) . "</td>";

        echo "<td>" . oceneIz($mydb, 20, 8, $row["ID"]) . "</td>"; //informatika 
        echo "<td>" . oceneIz($mydb, 20, 9, $row["ID"]) . "</td>";

        echo " <td>" . round($predmeti, 2) . "</td>";
        echo " <td>" . round($predmeti + $opstiUpseh, 2) . "</td>";
    }

    echo "</table> ";
}

function adminChechingVariables($mydb)
{
    if (isset($_GET["logout"]) || !isset($_SESSION["username"]))
        logOut();

    if (isset($_POST["new-order-nuber"]))
        $mydb->query($_POST["new-order-nuber"]);

    if (isset($_POST["new-admin-username"]) && isset($_POST["new-admin-password"]))
        addNewUser($mydb, $_POST["new-admin-username"], $_POST["new-admin-password"]);

    if (isset($_POST["new-pwrd-1"]))
        $mydb->query(updatePasswordQuery($_SESSION["userID"], $_POST["new-pwrd-1"]));

    if (isset($_POST["new-username"]))
        $mydb->query("UPDATE `admin` set `username`='" . $_GET["new-username"] . "'");
}

function nav()
{
    echo '<nav id="menu">

        <a href="admin.php">
            <button>Spisak učenika</button>
        </a>
        <a href="predmeti_i_smerovi.php">
            <button>Predmeti i smjerovi</button>
        </a>

        <form action="noviUcenikSuzeno.php">
            <button title="Dodaj novog učenika">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" class="plus-color">
                    <path d="M0 0h24v24H0z" fill="none" />
                    <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z" />
                </svg>
            </button>
        </form>

        <form action="../ucenikSuzbijen.php" method="get" id="find-ucenik-form">
            <input type="text" name="jmbg" id="find-jmbg" placeholder="Unesi JMBG učenika">
            <button id="pronadi-me">Pronađi učenika</button>
        </form>

        <form method="POST">
            <input type="text" name="new-admin-username" id="new-admin-username" hidden required>
            <input type="password" name="new-admin-password" id="new-admin-password" hidden minlength="8" required>
            <button id="dodaj-admina">Dodaj novog admina</button>
        </form>

        <form method="POST" id="change-pass">
            <input type="text" name="new-pwrd-1" id="new-pwrd-1" hidden>
            <button id="promeni-pass">Promeni šifru</button>
        </form>

        <form>
            <input type="text" value="true" hidden name="logout">
            <button>Odjavi se sa <?php echo $_SESSION["username"] ?></button>
        </form>

    </nav>';
}

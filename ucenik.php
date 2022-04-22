<!DOCTYPE html>
<html lang="en">
<?php 
include "admin_files/conn.php";
include "admin_files/funs.php";
include "admin_files/querys.php";
$res = $mydb->query("SELECT * FROM ucenik JOIN ocena ON ucenik.id=ocena.ucenik;");

$ucenik = $res->fetch_assoc();

?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/style.css">
    <title>Ucenik - <?php echo $ucenik["ime"];?></title>
</head>

<body>
    <form method="post" action="prijavaImports/hvala.php">
        <?php
         ?>
<?php



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
        if (
            $ucenik[$polje_name]
            ==
            $row["id"]
        )
            echo "checked";

        echo "></td>
    </tr>";
    }
    echo "</table>";
}






$naslovi = array("Smer koji želiš da upišeš", "Alternativni smer");
?>
<div>
    <?php
    for ($i = 0; $i < 2; $i++) {
        $j = $i + 1;
        prikaziSmerUcenik($mydb, $sviSmerovi, $naslovi[$i], $i, "Nema unesenih smerova u bazi", "smer$j", $ucenik);
        echo "smer$j";
    }
    ?>
    <button type='button'>Dalje</button>
</div>
<div id="vuk">
    <p>Da li si vukovac?</p>
    <input type="radio" name="vukovac" id="vukovac-da" value="1">
    <label for="vukovac-da">Jesam</label>

    <input type="radio" name="vukovac" id="vukovac-ne" value="0">
    <label for="vukovac-ne">Nisam</label>

    <button type='button'>Dalje</button>
</div>

<div id="podaci-ucenika">

    <label for="ime">Ime:</label>
    <input value="<?php echo $ucenik["ime"]; ?>" type="text" id="ime" name="ime">

    <label for="prezime">Prezime:</label>
    <input value="<?php echo $ucenik["prezime"]; ?>" type="text" id="prezime" name="prezime">

    <label for="telefon">Telefon:</label>
    <input value="<?php echo $ucenik["telefon"]; ?>" type="tel" id="telefon" name="telefon" placeholder="###/###-###" pattern="[0-9]{3}/[0-9]{3}-[0-9]{3}">
    <small>Npr. 066/887-516</small>
    <br>


    <label for="mail">E-mail:</label>
    <input value="<?php echo $ucenik["mail"]; ?>" type="email" id="mail" name="mail">

    <label for="jmbg">JMBG:</label>
    <input value="<?php echo $ucenik["jmbg"]; ?>" type="text" id="jmbg" name="jmbg" minlength="13" maxlength="13">

    <label for="datum-rodjenja">Datum rođenja:</label>
    <input value="<?php echo $ucenik["datum_rodjenja"]; ?>" type="date" id="datum-rodjenja" name="datum_rodjenja">

    <label for="mestoR">Mesto rođenja:</label>
    <input value="<?php echo $ucenik["mesto_rodjenja"]; ?>" type="text" id="mestoR" name="mestoR">

    <label for="adresa">Adresa prebivališta:</label>
    <input value="<?php echo $ucenik["adresa"]; ?>" type="text" id="adresa" name="adresa">
    <button type='button'>Nazad</button>
    <button type='button'>Dalje</button>

</div>

<div id="jezik-ver">

    <p>Strani jezici i veronauka</p>


    <label for="j3">Jezik od 3.:</label>
    <select id="j3" name="j3" value="<?php echo $ucenik["jezik_od_3"]; ?>">
        <option value="">Koji jezik si počeo učiti u 3. razredu</option>
        <option value="engleski jezik">Engleski jezik</option>
        <option value="nemacki jezik">Njemački jezik</option>
    </select>


    <label for="j6">Jezik od 6.:</label>
    <select id="j6" name="j6" value="<?php echo $ucenik["jezik_od_6"]; ?>">
        <option value="">Koji jezik si počeo učiti u 6. razredu</option>
        <option value="engleski jezik">Engleski jezik</option>
        <option value="nemacki jezik">Njemački jezik</option>
    </select>

    <label for="veronauka">Veronauka ili etika/kultura religije</label>
    <select name="veronauka" id="veronauka" value="">
        <option <?php if ($ucenik["veronauka"] == "") echo "selected"; ?> value="">Izaberi koji predemt želiš da izučavaš? Veronauku ili etiku</option>
        <option <?php if ($ucenik["veronauka"] == "pravoslavna") echo "selected"; ?> value="pravoslavna">Pravoslavna veronauka</option>
        <option <?php if ($ucenik["veronauka"] == "rimokatolicka") echo "selected"; ?> value="rimokatolicka">Rimokatolička veronauka</option>
        <option <?php if ($ucenik["veronauka"] == "islamska") echo "selected"; ?> value="islamska">Islamaska veronauka</option>
        <option <?php if ($ucenik["veronauka"] == "etika i kultura religije") echo "selected"; ?> value="etika i kultura religije">etika i kultura religije</option>
    </select>
    <button type='button'>Nazad</button>
    <button type='button'>Dalje</button>

</div>

<div id="svedocansto-9">

    <p>Podaci sa svedočansta 9 razreda</p>


    <label for="os">Naziv osnovne škole:</label>
    <input value="<?php echo $ucenik["osnovna_skola"]; ?>" type="text" id="os" name="os">

    <label for="dbroj">Djelovodni broj</label>
    <input value="<?php echo $ucenik["djelovodni_broj"]; ?>" type="text" id="dbroj" name="dbroj">
    <small>
        On se nalazi u gornje dijelu svjedočanstva.
        <b>

            Prikaži
        </b>
    </small>


    <label for="datum-izdavanja">Datum izdavanja:</label>
    <input value="<?php echo $ucenik["datum_izdavanja"]; ?>" type="date" id="datum-izdavanja" name="datum-izdavanja">

    <label for="mesto-izdavanja">Mjesto izdavanja:</label>
    <input value="<?php echo $ucenik["mesto_izdavanja"]; ?>" type="text" id="mesto-izdavanja" name="mesto-izdavanja">


    <button type='button'>Nazad</button>
    <button type='button'>Dalje</button>
</div>

<div id="Majka">

    <p>
        Podaci o Majci
    </p>

    <label for="ime-majke">Ime Majke:</label>
    <input value="<?php echo $ucenik["ime_majke"]; ?>" type="text" id="ime-majke" name="ime-majke">

    <label for="prezime-majke">Prezime Majke:</label>
    <input value="<?php echo $ucenik["prezime_majke"]; ?>" type="text" id="prezime-majke" name="prezime-majke">

    <label for="telefon-majke">Broj telefona Majke:</label>
    <input value="<?php echo $ucenik["telefon_majke"]; ?>" type="tel" id="telefon-majke" name="telefon-majke">

    <label for="zanimanje-majke">Zanimanje Majke:</label>
    <input value="<?php echo $ucenik["zanimanje_majke"]; ?>" type="text" id="zanimanje-majke" name="zanimanje-majke">

    <label for="adresa-majke">Adresa prebivališta Majke:</label>
    <input value="<?php echo $ucenik["adresa_majke"]; ?>" type="text" id="adresa-majke" name="adresa-majke">

    <button type='button'>Nazad</button>
    <button type='button'>Dalje</button>
</div>

<div id="otac">

    <p>
        Podaci o ocu
    </p>

    <label for="ime-oca">Ime oca:</label>
    <input value="<?php echo $ucenik["ime_oca"]; ?>" type="text" id="ime-oca" name="ime-oca">

    <label for="prezime-oca">Prezime oca:</label>
    <input value="<?php echo $ucenik["prezime_oca"]; ?>" type="text" id="prezime-oca" name="prezime-oca">

    <label for="telefon-oca">Broj telefona oca:</label>
    <input value="<?php echo $ucenik["telefon_oca"]; ?>" type="tel" id="telefon-oca" name="telefon-oca">

    <label for="zanimanje-oca">Zanimanje oca:</label>
    <input value="<?php echo $ucenik["zanimanje_oca"]; ?>" type="text" id="zanimanje-oca" name="zanimanje-oca">

    <label for="adresa-oca">Adresa prebivališta oca:</label>
    <input value="<?php echo $ucenik["adresa_oca"]; ?>" type="text" id="adresa-oca" name="adresa-oca">

    <button type='button'>Nazad</button>
    <button type='button'>Dalje</button>
</div>

<p>
    Ocene
</p>

<?php

function insertingGradesUcenik($database, $class)
{
    echo "<div>";
    echo "<p>Ocene u $class. razredu</p>";
    $res = $database->query(sviPred($class));
    if ($res->num_rows > 0) {
        showSubjects($res, $class);
        echo "</div>";
        return;
    }

    echo "<p class='not-found'>Nema predmeta podešenih u $class. razredu</p>";
    echo "</div>";
}

function showSubjectsUcenik($res, $class)
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

for ($raz = 6; $raz < 10; $raz++)
    insertingGrades($mydb, $raz);

$mydb->close();
?>

<button>Prijavi se</button>
</form>
</body>

</html>
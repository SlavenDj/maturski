<!DOCTYPE html>
<html lang='sr'>
<?php
include "../admin_files/conn.php";
include "../admin_files/funs.php";
include "../admin_files/querys.php";



if (isset($_POST["ime"])) {
    $ucenikID = "SELECT id FROM ucenik where jmbg='$jmbg'";
    $res = $mydb->query($ucenikID);
    $row = $res->fetch_assoc();
    if ($row == null) {
        $unosUcenika = "INSERT INTO ucenik (jmbg) VALUES ('$jmbg')";
        $mydb->query($unosUcenika);
    }
    $ucenikID = "SELECT id FROM ucenik where jmbg='$jmbg'";
    $res = $mydb->query($ucenikID);
    $row = $res->fetch_assoc();
    $ucenikID = $row["id"];
    $azurirajUcenika =
        "UPDATE ucenik
                SET
                    ime ='{$_POST["ime"]}',
                    prezime ='{$_POST["prezime"]}',
                    telefon ='{$_POST["telefon"]}',
                    mail = '{$_POST["mail"]}',
                    datum_rodjenja ='{$_POST["datum_rodjenja"]}',
                    mesto_rodjenja ='{$_POST["mesto_rodjenja"]}',
                    adresa ='{$_POST["adresa"]}',
                    razredUpisa = '{$_POST["razred"]}'
                WHERE id=$ucenikID;";
    $mydb->query($azurirajUcenika);

    $izborniPredmetiISvedocanstvo =
        "UPDATE ucenik
            SET
                jezik_od_3= '{$_POST["jezik_od_3"]}',
                jezik_od_6= '{$_POST["jezik_od_6"]}',
                zeljeniJezik= '{$_POST["zeljeniJezik"]}',
                jezikPre= '{$_POST["jezikPre"]}',
                veronauka= '{$_POST["veronauka"]}',
                osnovna_skola= '{$_POST["osnovna_skola"]}',
                djelovodni_broj= '{$_POST["djelovodni_broj"]}',
                datum_izdavanja= '{$_POST["datum_izdavanja"]}',
                mesto_izdavanja= '{$_POST["mesto_izdavanja"]}'
            WHERE id=$ucenikID;";

    $mydb->query($izborniPredmetiISvedocanstvo);
    $podaciRoditelja =
        "UPDATE ucenik
            SET
                ime_majke= '{$_POST["ime-majke"]}',
                prezime_majke= '{$_POST["prezime-majke"]}',
                telefon_majke= '{$_POST["telefon-majke"]}',
                zanimanje_majke= '{$_POST["zanimanje-majke"]}',
                adresa_majke= '{$_POST["adresa-majke"]}',

                ime_oca= '{$_POST["ime-oca"]}',
                prezime_oca= '{$_POST["prezime-oca"]}',
                telefon_oca= '{$_POST["telefon-oca"]}',
                zanimanje_oca= '{$_POST["zanimanje-oca"]}',
                adresa_oca= '{$_POST["adresa-oca"]}',

                ime_staratelja= '{$_POST["ime-staratelja"]}',
                prezime_staratelja= '{$_POST["prezime-staratelja"]}',
                telefon_staratelja= '{$_POST["telefon-staratelja"]}',
                zanimanje_staratelja= '{$_POST["zanimanje-staratelja"]}',
                adresa_staratelja= '{$_POST["adresa-staratelja"]}'
            WHERE id=$ucenikID;";

    $mydb->query($podaciRoditelja);
    $AzurirajSmer =
        @"UPDATE ucenik
        SET
            smer1= '{$_POST["smer-0"]}',
            smer2= '{$_POST["smer-1"]}'
            
        WHERE id=$ucenikID;";
    $mydb->query($AzurirajSmer);
    //AzurirajOcene
    for ($class = 6; $class <= 9; $class++) {
        $res = $mydb->query(sviPred2($class));
        if ($res->num_rows)
            while ($subject = $res->fetch_assoc()) {
                $idPredmeta = $subject["ID_predmeta"];
                if (isset($_POST["$idPredmeta-$class"])) {
                    $postojiLi = $mydb->query(
                        "SELECT ocena.ocena AS oc FROM ocena 
                            WHERE 
                                ucenik = $ucenikID AND 
                                razred = $class AND 
                                predmet = $idPredmeta"
                    );
                    //echo $postojiLi;
                    $postojiLi = $postojiLi->fetch_array();

                    if (isset($postojiLi["oc"]) == false)
                        $unesiOcenu =
                            "INSERT INTO ocena
                                (predmet, razred, ucenik, ocena)
                                VALUES
                                (
                                    $idPredmeta,
                                    $class, 
                                    $ucenikID, 
                                    {$_POST["$idPredmeta-$class"]}
                                    )";
                    else if (isset($_POST["$idPredmeta-$class"]))
                        $unesiOcenu =
                            "UPDATE ocena
                            SET
                                ocena.ocena={$_POST["$idPredmeta-$class"]}
                            WHERE 
                                ucenik = $ucenikID AND 
                                predmet = $idPredmeta AND 
                                razred = $class";
                    else
                        $unesiOcenu =
                            "UPDATE ocena
                    SET
                        ocena.ocena=''
                    WHERE 
                        ucenik = $ucenikID AND 
                        predmet = $idPredmeta AND 
                        razred = $class";
                    $mydb->query($unesiOcenu);
                }
            }
    }
}


if (isset($_POST["razredKojiUpisuje"]))
    $ucenik["razredUpisa"] = $_POST["razredKojiUpisuje"];
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/style.css">
    <title>Novi učenik</title>
</head>

<body class="suzen">

    <form method="post">

        <div id="podaci-ucenika">

            <input type="text" id="raz-ups" name="razred" value="1" hidden>
            <div>
                <label for="ime">Ime:</label>
                <input type="text" id="ime" name="ime">
            </div>
            <div>

                <label for="prezime">Prezime:</label>
                <input type="text" id="prezime" name="prezime">
            </div>




        </div>
        <div id="svedocansto-9">



            <div>
                <label for="osnovna_skola">Naziv škole:</label>
                <input type="text" id="osnovna_skola" name="osnovna_skola" list="unesene-skole">

            </div>
            <datalist id="unesene-skole">
                <?php
                $res = $mydb->query("SELECT osnovna_skola FROM ucenik group by osnovna_skola");
                while ($row = $res->fetch_array())
                    echo "<option value='{$row["osnovna_skola"]}'>";

                ?>

            </datalist>

            <div>
                <label for="djelovodni_broj">Djelovodni broj svedočanstva:</label>
                <input type="text" id="djelovodni_broj" name="djelovodni_broj">

            </div>

            <div>
                <label for="datum_izdavanja">Datum izdavanja svedočanstva:</label>
                <input type="date" id="datum_izdavanja" name="datum_izdavanja">
            </div>
            <div>

                <label for="mesto_izdavanja">Mjesto izdavanja svedočanstva:</label>
                <input type="text" id="mesto_izdavanja" name="mesto_izdavanja">
            </div>

        </div>



        <div id="jezik-ver" <p>Strani jezici i veronauka</p>

            <?php
            $jezici = array("engleski jezik", "nemacki jezik", "francuski jezik", "ruski jezik");
            ?>
            <div>
                <label for="jezik_od_3">Jezik od 3.:</label>
                <select id="jezik_od_3" name="jezik_od_3">
                    <option value="">Koji jezik si počeo učiti u 3. razredu</option>

                    <?php
                    for ($i = 0; $i < 4; $i++) {
                        echo "<option value='{$jezici[$i]}'";

                        echo ">{$jezici[$i]}</option>";
                    }
                    ?>
                </select>
            </div>

            <div>
                <label for="jezik_od_6">Jezik od 6.:</label>
                <select id="jezik_od_6" name="jezik_od_6">
                    <option value="">Koji jezik si počeo učiti u 6. razredu</option>
                    <?php
                    for ($i = 0; $i < 4; $i++) {
                        echo "<option value='{$jezici[$i]}'";
                        
                        echo ">{$jezici[$i]}</option>";
                    }
                    ?>
                </select>
            </div>

            <div>
                <label for="jezikPre">Jezik od proslog razreda:</label>
                <select id="jezikPre" name="jezikPre">
                    <option value="">Koji jezik si učio u prošlom razredu</option>
                    <?php
                    for ($i = 0; $i < 4; $i++) {
                        echo "<option value='{$jezici[$i]}'";

                        echo ">{$jezici[$i]}</option>";
                    }
                    ?>
                </select>
            </div>

            <div>
                <label for="zeljeniJezik">Zeljeni jezik.:</label>
                <select id="zeljeniJezik" name="zeljeniJezik">
                    <option value="">Koji jezik želiš dalje izučavati</option>
                    <?php
                    for ($i = 0; $i < 2; $i++) {
                        echo "<option value='{$jezici[$i]}'";

                        echo ">{$jezici[$i]}</option>";
                    }

                    ?>
                </select>
            </div>

            <div>
                <label for="veronauka">Veronauka ili etika/kultura religije</label>
                <select name="veronauka" id="veronauka" value="">
                    <option value="">Izaberi koji predemt želiš da izučavaš? Veronauku ili etiku</option>
                    <option value="pravoslavna">Pravoslavna veronauka</option>
                    <option value="rimokatolicka">Rimokatolička veronauka</option>
                    <option value="islamska">Islamaska veronauka</option>
                    <option value="etika i kultura religije">etika i kultura religije</option>
                </select>
            </div>


        </div>




        <div id="Majka">

            <div>
                <label for="telefon">Telefon:</label>
                <input type="tel" id="telefon" name="telefon" placeholder="###/###-###">
            </div>

            <div>
                <label for="mail">E-mail:</label>
                <input type="email" id="mail" name="mail">

            </div>
            <div>
                <label for="jmbg">JMBG:</label>
                <input type="text" id="jmbg" name="jmbg" minlength="13" maxlength="13">
            </div>

            <div>
                <label for="datum-rodjenja">Datum rođenja:</label>
                <input type="date" id="datum-rodjenja" name="datum_rodjenja">
            </div>

            <div>
                <label for="mesto_rodjenja">Mesto rođenja:</label>
                <input type="text" id="mesto_rodjenja" name="mesto_rodjenja">
            </div>

            <div>
                <label for="adresa">Adresa prebivališta:</label>
                <input type="text" id="adresa" name="adresa">
            </div>

            <div>

                <label for="ime-majke">Ime Majke:</label>
                <input type="text" id="ime-majke" name="ime-majke">
            </div>
            <div>

                <label for="prezime-majke">Prezime Majke:</label>
                <input type="text" id="prezime-majke" name="prezime-majke">
            </div>
            <div>

                <label for="telefon-majke">Broj telefona Majke:</label>
                <input type="tel" id="telefon-majke" placeholder="### ###-###" name="telefon-majke">
            </div>
            <div>

                <label for="zanimanje-majke">Zanimanje Majke:</label>
                <input type="text" id="zanimanje-majke" name="zanimanje-majke">
            </div>
            <div>

                <label for="adresa-majke">Adresa prebivališta Majke:</label>
                <input type="text" id="adresa-majke" name="adresa-majke">
            </div>

        </div>

        <div id="otac">


            <div>

                <label for="ime-oca">Ime oca:</label>
                <input type="text" id="ime-oca" name="ime-oca">
            </div>
            <div>

                <label for="prezime-oca">Prezime oca:</label>
                <input type="text" id="prezime-oca" name="prezime-oca">
            </div>
            <div>

                <label for="telefon-oca">Broj telefona oca:</label>
                <input type="tel" id="telefon-oca" placeholder="### ###-###" name="telefon-oca">
            </div>
            <div>

                <label for="zanimanje-oca">Zanimanje oca:</label>
                <input type="text" id="zanimanje-oca" name="zanimanje-oca">
            </div>
            <div>

                <label for="adresa-oca">Adresa prebivališta oca:</label>
                <input type="text" id="adresa-oca" name="adresa-oca">
            </div>

        </div>
        <div id="staratelj">


            <div>

                <label for="ime-staratelja">Ime staratelja:</label>
                <input type="text" id="ime-staratelja" name="ime-staratelja">
            </div>
            <div>

                <label for="prezime-staratelja">Prezime staratelja:</label>
                <input type="text" id="prezime-staratelja" name="prezime-staratelja">
            </div>
            <div>

                <label for="telefon-staratelja">Broj telefona staratelja:</label>
                <input type="tel" placeholder="### ###-###" id="telefon-staratelja" name="telefon-staratelja">

            </div>
            <div>
                <label for="zanimanje-staratelja">Zanimanje staratelja:</label>
                <input type="text" id="zanimanje-staratelja" name="zanimanje-staratelja">
            </div>
            <div>

                <label for="adresa-staratelja">Adresa prebivališta staratelja:</label>
                <input type="text" id="adresa-staratelja" name="adresa-staratelja">
            </div>

        </div>
        <div id="smerovi">
            <?php
            prikaziSmer($mydb, $sviSmerovi, "Smer koji želiš da upišeš", 0, "Nema unesenih smerova u bazi");
            prikaziSmer($mydb, $sviSmerovi, "Alternativni smer", 1, "Nema unesenih smerova u bazi");
            ?>

        </div>
        <p>
            Ocene
        </p>

        <?php

        for ($raz = 6; $raz < 10; $raz++)
            insertingGradesUcenikSuzeni2($mydb, $raz);
        ?>

        <button>Sačuvaj izmene</button>
    </form>




    <script src="../prijava.js"></script>
</body>
<?php
$mydb->close();
?>

</html>
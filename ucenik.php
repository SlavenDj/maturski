<!DOCTYPE html>
<html lang='sr'>
<?php
include "admin_files/conn.php";
include "admin_files/funs.php";
include "admin_files/querys.php";

$jmbg = $_POST["jmbg"];

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
                    else
                        $unesiOcenu =
                            "UPDATE ocena
                            SET
                                ocena.ocena={$_POST["$idPredmeta-$class"]}
                            WHERE 
                                ucenik = $ucenikID AND 
                                predmet = $idPredmeta AND 
                                razred = $class";
                    $mydb->query($unesiOcenu);
                }
            }
    }
}

$ucenik = $mydb->query(findUcenik($jmbg));
// if ($ucenik->num_rows == 0) {
//     echo "Nema u??nika sa JMBG: ";
//     return;
// }
$ucenik = $ucenik->fetch_assoc();
$ime = $ucenik["ime"];
if (isset($_POST["razredKojiUpisuje"]))
    $ucenik["razredUpisa"] = $_POST["razredKojiUpisuje"];
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/style.css">
    <title>Ucenik - <?php echo $ime; ?></title>
</head>

<body>

    <form method="post">
        <button type="button" id="print">
            Od??tampaj
        </button>


        <div id="podaci-ucenika">

            <input type="text" value="<?php echo $ucenik["razredUpisa"]; ?>" id="raz-ups" name="razred" hidden>
            <label for="ime">Ime:</label>
            <input value="<?php echo $ucenik["ime"]; ?>" type="text" id="ime" name="ime">

            <label for="prezime">Prezime:</label>
            <input value="<?php echo $ucenik["prezime"]; ?>" type="text" id="prezime" name="prezime">





        </div>
        <div id="svedocansto-9">

            <p>Podaci sa svedo??ansta prethodnog razreda</p>

            <label for="osnovna_skola">Naziv ??kole:</label>
            <input value="<?php echo $ucenik["osnovna_skola"]; ?>" type="text" id="osnovna_skola" name="osnovna_skola" list="unesene-skole">

            <datalist id="unesene-skole">
                <?php
                $res = $mydb->query("SELECT osnovna_skola FROM ucenik group by osnovna_skola");
                while ($row = $res->fetch_array())
                    echo "<option value='{$row["osnovna_skola"]}'>";

                ?>

            </datalist>

            <label for="djelovodni_broj">Djelovodni broj svedo??anstva:</label>
            <input value="<?php echo $ucenik["djelovodni_broj"]; ?>" type="text" id="djelovodni_broj" name="djelovodni_broj">
            <small>
                On se nalazi u gornje dijelu svjedo??anstva.
                <b id="show-tip">
                    Prika??i
                </b>
            </small>
            <div id="tip">
                <img src="imgs/tip.gif" alt="gde se nalazi delovodni broj" loading="lazy">
                <p>
                    Dodirni/ kikni bilo gde da bi sakrio sliku.
                </p>
            </div>
            <label for="datum_izdavanja">Datum izdavanja svedo??anstva:</label>
            <input value="<?php echo $ucenik["datum_izdavanja"]; ?>" type="date" id="datum_izdavanja" name="datum_izdavanja">

            <label for="mesto_izdavanja">Mjesto izdavanja svedo??anstva:</label>
            <input value="<?php echo $ucenik["mesto_izdavanja"]; ?>" type="text" id="mesto_izdavanja" name="mesto_izdavanja">

        </div>



        <div id="jezik-ver" <?php
                            if ($ucenik["razredUpisa"] > 1)
                                echo "style='display:none'";
                            ?>>

            <p>Strani jezici i veronauka</p>

            <?php
            $jezici = array("engleski jezik", "nemacki jezik", "francuski jezik", "ruski jezik");
            ?>
            <label for="jezik_od_3">Jezik od 3.:</label>
            <select id="jezik_od_3" name="jezik_od_3" value="<?php echo $ucenik["jezik_od_3"]; ?>">
                <option value="">Koji jezik si po??eo u??iti u 3. razredu</option>

                <?php
                for ($i = 0; $i < 4; $i++) {
                    echo "<option value='{$jezici[$i]}'";
                    if (($ucenik["jezik_od_3"] == $jezici[$i]))
                        echo "selected";
                    echo ">{$jezici[$i]}</option>";
                }
                ?>
            </select>

            <label for="jezik_od_6">Jezik od 6.:</label>
            <select id="jezik_od_6" name="jezik_od_6" value="<?php echo $ucenik["jezik_od_6"]; ?>">
                <option value="">Koji jezik si po??eo u??iti u 6. razredu</option>
                <?php
                for ($i = 0; $i < 4; $i++) {
                    echo "<option value='{$jezici[$i]}'";
                    if (($ucenik["jezik_od_6"] == $jezici[$i]))
                        echo "selected";
                    echo ">{$jezici[$i]}</option>";
                }
                ?>
            </select>

            <label for="jezikPre">Jezik od proslog razreda:</label>
            <select id="jezikPre" name="jezikPre" value="<?php echo $ucenik["jezikPre"]; ?>">
                <option value="">Koji jezik si u??io u pro??lom razredu</option>
                <?php
                for ($i = 0; $i < 4; $i++) {
                    echo "<option value='{$jezici[$i]}'";
                    if (($ucenik["jezikPre"] == $jezici[$i]))
                        echo "selected";
                    echo ">{$jezici[$i]}</option>";
                }
                ?>
            </select>

            <label for="zeljeniJezik">Zeljeni jezik.:</label>
            <select id="zeljeniJezik" name="zeljeniJezik" value="<?php echo $ucenik["zeljeniJezik"]; ?>">
                <option value="">Koji jezik ??eli?? dalje izu??avati</option>
                <?php
                for ($i = 0; $i < 2; $i++) {
                    echo "<option value='{$jezici[$i]}'";
                    if (($ucenik["zeljeniJezik"] == $jezici[$i]))
                        echo "selected";
                    echo ">{$jezici[$i]}</option>";
                }

                ?>
            </select>

            <label for="veronauka">Veronauka ili etika/kultura religije</label>
            <select name="veronauka" id="veronauka" value="">
                <option <?php if ($ucenik["veronauka"] == "") echo "selected"; ?> value="">Izaberi koji predemt ??eli?? da izu??ava??? Veronauku ili etiku</option>
                <option <?php if ($ucenik["veronauka"] == "pravoslavna") echo "selected"; ?> value="pravoslavna">Pravoslavna veronauka</option>
                <option <?php if ($ucenik["veronauka"] == "rimokatolicka") echo "selected"; ?> value="rimokatolicka">Rimokatoli??ka veronauka</option>
                <option <?php if ($ucenik["veronauka"] == "islamska") echo "selected"; ?> value="islamska">Islamaska veronauka</option>
                <option <?php if ($ucenik["veronauka"] == "etika i kultura religije") echo "selected"; ?> value="etika i kultura religije">etika i kultura religije</option>
            </select>


        </div>




        <div id="Majka">
            <p>Proveri da li su slede??i odaci ta??ni</p>
            <label for="telefon">Telefon:</label>
            <input value="<?php echo $ucenik["telefon"]; ?>" type="tel" id="telefon" name="telefon" placeholder="###/###-###">

            <label for="mail">E-mail:</label>
            <input value="<?php echo $ucenik["mail"]; ?>" type="email" id="mail" name="mail">

            <!-- <label for="jmbg">JMBG:</label> -->
            <input value="<?php echo $ucenik["jmbg"]; ?>" type="text" id="jmbg" name="jmbg" minlength="13" maxlength="13" hidden>

            <!-- <label for="datum-rodjenja">Datum ro??enja:</label> -->
            <input value="<?php echo $ucenik["datum_rodjenja"]; ?>" type="date" id="datum-rodjenja" name="datum_rodjenja" hidden>

            <!-- <label for="mesto_rodjenja">Mesto ro??enja:</label> -->
            <input value="<?php echo $ucenik["mesto_rodjenja"]; ?>" type="text" id="mesto_rodjenja" name="mesto_rodjenja" hidden>

            <label for="adresa">Adresa prebivali??ta:</label>
            <input value="<?php echo $ucenik["adresa"]; ?>" type="text" id="adresa" name="adresa">
            <p>
                Podaci o Majci
            </p>

            <label for="ime-majke">Ime Majke:</label>
            <input value="<?php echo $ucenik["ime_majke"]; ?>" type="text" id="ime-majke" name="ime-majke">

            <label for="prezime-majke">Prezime Majke:</label>
            <input value="<?php echo $ucenik["prezime_majke"]; ?>" type="text" id="prezime-majke" name="prezime-majke">

            <label for="telefon-majke">Broj telefona Majke:</label>
            <input value="<?php echo $ucenik["telefon_majke"]; ?>" type="tel" id="telefon-majke" placeholder="### ###-###" name="telefon-majke">

            <label for="zanimanje-majke">Zanimanje Majke:</label>
            <input value="<?php echo $ucenik["zanimanje_majke"]; ?>" type="text" id="zanimanje-majke" name="zanimanje-majke">

            <label for="adresa-majke">Adresa prebivali??ta Majke:</label>
            <input value="<?php echo $ucenik["adresa_majke"]; ?>" type="text" id="adresa-majke" name="adresa-majke">

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
            <input value="<?php echo $ucenik["telefon_oca"]; ?>" type="tel" id="telefon-oca" placeholder="### ###-###" name="telefon-oca">

            <label for="zanimanje-oca">Zanimanje oca:</label>
            <input value="<?php echo $ucenik["zanimanje_oca"]; ?>" type="text" id="zanimanje-oca" name="zanimanje-oca">

            <label for="adresa-oca">Adresa prebivali??ta oca:</label>
            <input value="<?php echo $ucenik["adresa_oca"]; ?>" type="text" id="adresa-oca" name="adresa-oca">

        </div>
        <div id="staratelj">

            <p>
                Podaci o staretelju
            </p>

            <label for="ime-staratelja">Ime staratelja:</label>
            <input value="<?php echo $ucenik["ime_staratelja"]; ?>" type="text" id="ime-staratelja" name="ime-staratelja">

            <label for="prezime-staratelja">Prezime staratelja:</label>
            <input value="<?php echo $ucenik["prezime_staratelja"]; ?>" type="text" id="prezime-staratelja" name="prezime-staratelja">

            <label for="telefon-staratelja">Broj telefona staratelja:</label>
            <input value="<?php echo $ucenik["telefon_staratelja"]; ?>" type="tel" placeholder="### ###-###" id="telefon-staratelja" name="telefon-staratelja">

            <label for="zanimanje-staratelja">Zanimanje staratelja:</label>
            <input value="<?php echo $ucenik["zanimanje_staratelja"]; ?>" type="text" id="zanimanje-staratelja" name="zanimanje-staratelja">

            <label for="adresa-staratelja">Adresa prebivali??ta staratelja:</label>
            <input value="<?php echo $ucenik["adresa_staratelja"]; ?>" type="text" id="adresa-staratelja" name="adresa-staratelja">

        </div>
        <div id="smerovi">
            <?php
            prikaziSmerUcenik($mydb, $sviSmerovi, "Smer koji ??eli?? da upi??e??", 0, "Nema unesenih smerova u bazi", "smer1", $ucenik);
            if ($ucenik["razredUpisa"] == 1) prikaziSmerUcenik($mydb, $sviSmerovi, "Alternativni smer", 1, "Nema unesenih smerova u bazi", "smer2", $ucenik);
            ?>

        </div>
        <p <?php
            if ($ucenik["razredUpisa"] > 1)
                echo "style='display:none'";
            ?>>
            Ocene
        </p>

        <?php
        if ($ucenik["razredUpisa"] == 1)
            for ($raz = 6; $raz < 10; $raz++)
                insertingGradesUcenik($mydb, $raz, $ucenik["ucenikID"]);
        ?>

        <button>Sa??uvaj izmene</button>
    </form>

    <div id="pdf">
        <header>
            <div id="skola">
                ???? ?????????????????????????????? ??????????
            </div>
            <div id="skolska-godina-y">
                <?php
                echo intval(date("Y"));
                ?>
            </div>
            <div id="skolska-godina-y2">
                <?php
                echo intval(date("Y")) + 1;
                ?>
            </div>
            <div id="mesto-gore">
                ????????????????
            </div>
        </header>
        <div id="table-header">
            <div id="razred-text">
                <?php
                $razredTxtIRimski = array("I", "II", "III", "IV", "prvi", "drugi", "tre??i", "??etvrti");
                echo $razredTxtIRimski[$ucenik["razredUpisa"] + 3];

                ?>
            </div>
            <div id="razred-rismki">
                <?php
                echo $razredTxtIRimski[$ucenik["razredUpisa"] - 1];
                ?>
            </div>
            <div id="puni-naziv-skole">
                ???? ?????????????????????????????? ?????????? ????????????????
            </div>
            <div id="prazno-1">
                ----/---
            </div>
            <div id="struka-1">
                ????????????????????????????
            </div>
            <div id="struka-2">
                ????????????????????????????
            </div>
            <div id="smer-1">
                <?php
                $smer1 = $mydb->query("SELECT naziv FROM smer JOIN ucenik ON smer.id=ucenik.smer1");
                $smer1 = $smer1->fetch_array();
                echo $smer1["naziv"];
                ?>
            </div>
            <div id="smer-2">
                <?php
                $smer2 = $mydb->query("SELECT smer2 FROM ucenik where id={$ucenik["ucenikID"]}");
                $smer2 = $smer2->fetch_array();
                if ($smer2["smer2"] != 0 && $ucenik["razredUpisa"] == 1) {
                    $smer2 = $mydb->query("SELECT naziv FROM smer JOIN ucenik ON smer.id=ucenik.smer2");
                    $smer2 = $smer2->fetch_array();
                    echo $smer2["naziv"];
                } else
                    echo "Ne zelim drugo zanimanje"
                ?>
            </div>
        </div>

        <div id="main_data">
            <div id="imeUcenika">
                <?php
                echo $ucenik["ime"] . " " . $ucenik["prezime"]
                ?>
            </div>
            <div id="rodjUcenika">
                <?php
                echo
                date('d.m.Y', strtotime($ucenik["datum_rodjenja"]));
                ?>
            </div>
            <div id="mesto_rodjenjaodjUcenika">
                <?php
                echo  $ucenik["mesto_rodjenja"]
                ?>
            </div>
            <?php
            $ids = array("otac", "Majka", "staratelj");
            // $polja = array("ime", "prezime", "adresa", "zanimanje");
            $odKoga = array("oca", "majke", "staratelja");
            for ($i = 0; $i < 3; $i++) {
                echo "<div id='{$ids[$i]}'>";
                if ($ucenik["ime_{$odKoga[$i]}"] != null)
                    echo  $ucenik["ime_{$odKoga[$i]}"] . " " .
                        $ucenik["prezime_{$odKoga[$i]}"] . ", " .
                        $ucenik["adresa_{$odKoga[$i]}"] . ", " .
                        $ucenik["zanimanje_{$odKoga[$i]}"];
                else
                    echo "--------------------";
                echo "</div>";
            }
            ?>

            <div id="adresaUcenika">
                <?php
                echo  $ucenik["adresa"]
                ?>
            </div>
            <div id="osnovna-skola">
                <?php
                echo  $ucenik["osnovna_skola"]
                ?>
            </div>
            <div id="delovodni-broj">
                <?php
                echo  $ucenik["djelovodni_broj"]
                ?>
            </div>
            <div id="datum-mesto-idaje">
                <?php
                echo
                date('d.m.Y', strtotime($ucenik["datum_izdavanja"])) .
                    ", " . $ucenik["mesto_izdavanja"];
                ?>
            </div>
            <div id="j-3">
                <?php
                echo $ucenik["jezik_od_3"]

                ?>
            </div>
            <div id="j-6">
                <?php
                echo $ucenik["jezik_od_6"]

                ?>
            </div>
            <div id="prethodni-razred">
                <?php
                echo $ucenik["jezikPre"]

                ?>
            </div>
            <div id="zeljeni-jezik">
                <?php
                echo $ucenik["zeljeniJezik"]

                ?>
            </div>
            <div id="veronauka">
                <!-- ???? - ?????????????????????? ???????????????????? -->
                <?php
                echo $ucenik["veronauka"]
                ?>
            </div>
        </div>
        <div id="broj-tel-majke">
            <?php
            if ($ucenik["telefon_majke"])
                echo "????. ??????. ??????????:  {$ucenik["telefon_majke"]}"  ?>
        </div>
        <div id="broj-tel-oca">
            <?php
            if ($ucenik["telefon_oca"])
                echo "????. ??????. ??????:  {$ucenik["telefon_oca"]}"  ?>
        </div>
        <div id="broj-tel-staratelja">
            <?php
            if ($ucenik["telefon_staratelja"])
                echo "????. ??????. ??????????????????:  {$ucenik["telefon_staratelja"]}"  ?>
        </div>
        <div id="broj-tel-uc">
            ???????? ???????????????? ??????????????: <?php echo $ucenik["telefon"] ?>
        </div>
        <img src="ePrijava za upis u??enika u srednju ??kolu-pdf.svg" alt="" draggable="false" />
        <div id="placehoder-za-mesto-datum">
            ?? ____________________________, ________20___.??????.
        </div>
        <div id="mesto-2">
            ??????????????????
        </div>
        <div id="potpis">
            ???????????? ??????????????-????
        </div>
        <div id="datum-d-m">

            <?php
            echo date("d.m.");
            ?>
        </div>
        <div id="datum-y">
            <?php
            echo intval(date("Y")) % 100;
            ?>
        </div>
    </div>

    <script>
        document.getElementById("print").addEventListener("click", () => {
            print()
        })
    </script>
    <script src="prijava.js"></script>
</body>
<?php
$mydb->close();
?>

</html>
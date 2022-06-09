<!DOCTYPE html>
<html lang='sr'>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hvala!</title>
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <style>
        /* .center {
            text-align: center;
        } */
        .bod {
            font-size: 1.5rem;
        }

        #ime-prezime-uper {
            text-transform: uppercase;
            font-weight: bold;
        }

        .name {
            text-align: left;
        }

        main {
            display: flex;
            flex-direction: column;
            gap: 2rem;

        }

        #bodovi {
            display: grid;
            max-width: 430px;
            width: 100%;
            align-self: center;
            grid-template-columns: 1fr auto;
            margin: 2rem;
            row-gap: 1rem;
        }

        small {
            margin-top: 1rem;
        }

        .indicator {
            font-size: 2rem;
        }
    </style>
</head>

<body>
    <nav>
        <a href="https://elskolapd.com/" target="_blank" rel="noopener noreferrer">
            <img src="../imgs/LOGO REDIZAJN HD.webp" alt="logo JU Elektretehničke škole Prijedor" id="logo-big">
        </a>

    </nav>
    <?php
    include "../admin_files/conn.php";
    $idijeviPredmetaZaRacunanje = array(1, 2, 14, 20, 16);
    $jmbg = $_POST["jmbg"];
    if (isset($_POST["ime"])) {
        $res = $mydb->query("SELECT id FROM ucenik where jmbg='$jmbg'");
        $row = $res->fetch_assoc();

        $unosUcenika =
            "INSERT INTO ucenik
            (jmbg, datum_upisa, vreme_upisa)
        VALUES
        ( 
            '{$_POST["jmbg"]}',
            '" . date("Y-m-d") . "',
            '" . date("H:i:s") . "'
            );";
        // echo $unosUcenika;
        $mydb->query($unosUcenika);

        $unosUcenika =
            "UPDATE ucenik
            SET
                ime ='{$_POST["ime"]}',
                prezime ='{$_POST["ime"]}',
                telefon ='{$_POST["telefon"]}',
                datum_rodjenja ='{$_POST["datum_rodjenja"]}',
                mesto_rodjenja ='{$_POST["mesto_rodjenja"]}',
                adresa ='{$_POST["adresa"]}',
                razredUpisa = {$_POST["razred"]}
            WHERE jmbg='$jmbg';";

        $ucenikID = "SELECT ID FROM ucenik WHERE jmbg='$jmbg'";
        $ucenikID = ($mydb->query($ucenikID))->fetch_assoc();
        $ucenikID = $ucenikID["ID"];
        $unosUcenika =
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
                WHERE jmbg='{$jmbg}';";

        $mydb->query($unosUcenika);
        $unosUcenika =
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
                WHERE jmbg='{$jmbg}';";

        $mydb->query($unosUcenika);


        $unosUcenika =
            "UPDATE ucenik
            SET
                smer1= '{$_POST["smer-0"]}',
                smer2= '{$_POST["smer-1"]}'
            WHERE jmbg='{$jmbg}';";


        $mydb->query($unosUcenika);
    }
    function sviPred($class)
    {
        return
            "SELECT veza_razred_predmet.id, naziv, predmeti.id AS ID_predmeta
                    FROM   `veza_razred_predmet`
                    INNER JOIN `predmeti`
                            ON predmeti.id = veza_razred_predmet.predmet
                            AND razred = $class 
                    ORDER  BY redni_broj";
    }
    $opstiUpseh = 0;
    $predmeti = 0;
    for ($class = 6; $class <= 9; $class++) {
        $zbir_ocena_u_nekom_razredu = 0;
        $broj_predmeta = 0;
        $res = $mydb->query(sviPred($class));
        if ($res->num_rows > 0) {
            while ($subject = $res->fetch_assoc()) {

                $idPredmeta = $subject["ID_predmeta"];
                $broj_predmeta++;
                if (isset($_POST["$idPredmeta-$class"])) {
                    if ($row == null)
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
                                    ucenik=$ucenikID AND 
                                    predmet=$idPredmeta AND 
                                    razred=$class";
                    $zbir_ocena_u_nekom_razredu += intval($_POST["$idPredmeta-$class"]);
                    if (in_array($idPredmeta, $idijeviPredmetaZaRacunanje)) {
                        // echo $idPredmeta. " ";
                        if ($class >= 8) {
                            $predmeti += intval($_POST["$idPredmeta-$class"]) / 5.0 * 2;
                        }
                    }
                    $mydb->query($unesiOcenu);
                }
            }
        }
        $broj_bovoda_u_nekom_razredu = $zbir_ocena_u_nekom_razredu * 1.0 / $broj_predmeta;
        if ($class <= 7)
            $opstiUpseh += $broj_bovoda_u_nekom_razredu  * 2;
        else
            $opstiUpseh += $broj_bovoda_u_nekom_razredu  * 3;
    }


    ?>
    <main class="white-bg">


        <p class="center" id='postovani'>
            Poštovani učeniče echo <?php "{$_POST["ime"]} {$_POST["prezime"]}" ?>;,
            <br>
            Ako si tačno unio/la sve podatke, tvoji bodovi izgledaju ovako:

        </p>


        <div id="bodovi">
            <p class="name">
                Opšti uspjeh
            </p>
            <p class="bod">
                <?php
                echo round($opstiUpseh, 2);
                ?>
            </p>
            <p class="name">
                Predmeti značajni za struku <b class="indicator" <?php if ($opstiUpseh == 50) echo 'class="hide-small"'; ?>>*</b>
            </p>
            <p class="bod">
                <?php
                echo round($predmeti, 2);
                ?>
            </p>
            <p class="name">
                <b>
                    Ukupno

                </b>
            </p>
            <p class="bod">
                <?php
                echo round($predmeti + $opstiUpseh, 2);
                ?>
            </p>
        </div>
        <p class="center">
            Hvala ti što si koristio naš sajt. <br>

            <?php if ($_POST['sledeci-korac'] == 'dolazi-na-upis') echo '<br>Očekujemo te na upisu!' ?>

        </p>

        <small <?php if ($opstiUpseh == 50) echo 'class="hide-small"'; ?>>
            <b class="indicator">*</b> Objašnjenje: Broj bodova je izračunat prema predmetima potrebnim na <b>elektrotehničku školu</b>. Za ostale škole, npr. gimnazija, medicinska... ovaj broj bodova ne važi, jer se gledaju drugi predmeti.
        </small>
    </main>
    <input id='jmbg' hidden value='<?php echo $jmbg; ?>'>

    <script>
        const jmbg = document.getElementById('jmbg');
        genderNumber = `${jmbg[9]}${jmbg[10]}${jmbg[11]}`,
            gender = genderNumber > 499 ? "woman" : "man";
        document.getElementById("postovani").innerHTML =
            gender === "man" ?
            "Poštovani učeniče, <br> Ako si tačno unio sve podatke, tvoji bodovi izgledaju ovako: " :
            "Poštovana učenice, <br> Ako si tačno unijela sve podatke, tvoji bodovi izgledaju ovako: ";
    </script>
</body>

</html>
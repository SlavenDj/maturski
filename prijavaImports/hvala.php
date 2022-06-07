<!DOCTYPE html>
<html lang='sr'>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hvala!</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            max-width: 500px;
            margin: 0 auto;
            padding: 0 40px;
            display: flex;
            flex-direction: column;
            font-family: system-ui;
        }

        .center {
            text-align: center;
        }

        #ime-prezime-uper {
            text-transform: uppercase;
            font-weight: bold;
        }

        #bodovi {
            display: grid;
            width: 430px;
            align-self: center;
            grid-template-columns: 1fr auto;
        }
    </style>
</head>

<body>

    <?php
    include "../admin_files/conn.php";
    $idijeviPredmetaZaRacunanje = array(1, 2, 14, 20, 16);
    $jmbg = $_POST["jmbg"];
    if (isset($_POST["ime"])) {
        $res = $mydb->query("SELECT id FROM ucenik where jmbg='$jmbg'");
        $row = $res->fetch_assoc();
        
            $unosUcenika =
                "INSERT INTO ucenik
            (jmbg)
        VALUES
        ( 
            '{$_POST["jmbg"]}'
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

    <p class="center">
        Poštovani učeniče,
        <br>
        Ako si tačno unio sve podatke, tvoji bodovi izgledaju ovako:

    </p>

    <p id="ime-prezime-uper">
        <?php
        echo "{$_POST["ime"]} {$_POST["prezime"]}";
        ?>
    </p>
    <div id="bodovi">
        <p class="name">
            Opšti uspjeh
        </p>
        <p class="bod">
            <?php
            echo $opstiUpseh;
            ?>
        </p>
        <p class="name">
            Predmeti značajni za struku*
        </p>
        <p class="bod">
            <?php
            echo $predmeti;
            ?>
        </p>
        <p class="name">
            <b>
                UKUPNO

            </b>
        </p>
        <p class="bod">
            <?php
            echo $predmeti + $opstiUpseh;
            ?>
        </p>
    </div>
    <p class="center">
        Hvala ti što si koristio naš sajt. <br>
        Očekujemo te na upisu!
    </p>
    <small>
        * OBJAŠNJENJE: Broj bodova je izračunat premo predmetima potrebim na <b>elektrotehčiku školu</b>. Za ostale škole, npr. gimnazija, medicinska... ovaj broj bodova ne važi, jer se gledaju drugi predmeti.
    </small>
</body>

</html>
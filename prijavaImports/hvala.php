<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hvala!</title>
</head>

<body>
    <?php
    include "../admin_files/conn.php";


    $jmbg = $_POST["jmbg"];
    $res = $mydb->query("SELECT id FROM ucenik where jmbg='$jmbg'");
    $row = $res->fetch_assoc();


    if ($row == null) {
        $unosUcenika =
            "INSERT INTO ucenik
            (ime, prezime, telefon, mail, jmbg, datum_rodjenja, mesto_rodjenja, adresa)
        VALUES
        (
            '{$_POST["ime"]}', 
            '{$_POST["prezime"]}', 
            '{$_POST["telefon"]}', 
            '{$_POST["mail"]}', 
            '{$_POST["jmbg"]}', 
            '{$_POST["datum_rodjenja"]}', 
            '{$_POST["mestoR"]}',
            '{$_POST["adresa"]}'
            );";
        $mydb->query($unosUcenika);
    } else {
        $unosUcenika =
            "UPDATE ucenik
            SET
                ime ='{$_POST["ime"]}',
                prezime ='{$_POST["ime"]}',
                telefon ='{$_POST["telefon"]}',
                datum_rodjenja ='{$_POST["datum_rodjenja"]}',
                mesto_rodjenja ='{$_POST["mestoR"]}',
                adresa ='{$_POST["adresa"]}'
            WHERE jmbg='$jmbg';";
    }
    $ucenikID = "SELECT ID FROM ucenik WHERE jmbg='$jmbg'";
    $ucenikID = ($mydb->query($ucenikID))->fetch_assoc();
    $ucenikID = $ucenikID["ID"];
    $unosUcenika =
        "UPDATE ucenik
        SET
            jezik_od_3= '{$_POST["j3"]}',
            jezik_od_6= '{$_POST["j6"]}',
            veronauka= '{$_POST["j6"]}',
            osnovna_skola= '{$_POST["os"]}',
            djelovodni_broj= '{$_POST["dbroj"]}',
            datum_izdavanja= '{$_POST["datum-izdavanja"]}',
            mesto_izdavanja= '{$_POST["mesto-izdavanja"]}'
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
            adresa_oca= '{$_POST["adresa-oca"]}'
        WHERE jmbg='{$jmbg}';";

    $mydb->query($unosUcenika);


    $unosUcenika =
        "UPDATE ucenik
    SET
        smer1= '{$_POST["smer-0"]}',
        smer2= '{$_POST["smer-1"]}'
    WHERE jmbg='{$jmbg}';";


    $mydb->query($unosUcenika);








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

    for ($class = 6; $class <= 9; $class++) {
        $res = $mydb->query(sviPred($class));
        if ($res->num_rows > 0) {
            while ($subject = $res->fetch_assoc()) {
                $idPredmeta = $subject["ID_predmeta"];
                if (isset($_POST["$idPredmeta-$class"])) {
                    $jmbg = $_POST["jmbg"];


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
                            
                                 WHERE ucenik=$ucenikID AND predmet=$idPredmeta AND razred=$class
                                 
                                
                                ";
                    $mydb->query($unesiOcenu);
                }
            }
        }
    }
    ?>
</body>

</html>
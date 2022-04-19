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
$unosUcenika=
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
    );
";


$mydb->query($unosUcenika);

$jmbg=$_POST["jmbg"];

$unosUcenika=
"UPDATE ucenik
SET
jezik_od_3= '{$_POST["j3"]}',
jezik_od_6= '{$_POST["j6"]}',
osnovna_skola= '{$_POST["os"]}',
djelovodni_broj= '{$_POST["dbroj"]}',
datum_izdavanja= '{$_POST["datum-izdavanja"]}',
mesto_izdavanja= '{$_POST["mesto-izdavanja"]}'
 WHERE jmbg='{$jmbg}';
";

$mydb->query($unosUcenika);

?>
</body>
</html>
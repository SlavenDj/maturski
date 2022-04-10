<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style2.css">
    <title>Document</title>
</head>

<body>
    <form action="hvala.php">
        <?php
        include "imports/conn.php";


        $res = $mydb->query("SELECT naziv FROM smer");
        if ($res->num_rows > 0) {
            echo "<table><th>Naziv smera</th>";
            while ($row = $res->fetch_assoc())
                echo "<tr><td>" . $row["naziv"] . "</td> <td> " .  btns($row["id"]) . "</td></tr>";
            echo "</table>";
            return;
        }
        echo "Nema rezultata <br>";

        $res = $mydb->query("SELECT naziv FROM smer");
        if ($res->num_rows > 0) {
            echo "<table><th>Naziv smera</th>";
            while ($row = $res->fetch_assoc())
                echo "<tr><td>" . $row["naziv"] . "</td> <td> " .  btns($row["id"]) . "</td></tr>";
            echo "</table>";
            return;
        }
        echo "Nema rezultata <br>";
        ?>
        <div id="vuk">
            <p>Da li si vukovac?</p>
            <input type="radio" name="vukovac" id="vukovac-da" value="1">
            <label for="vukovac-da">Jesam</label>
            <br>
            <input type="radio" name="vukovac" id="vukovac-ne" value="0">
            <label for="vukovac-ne">Nisam</label>
            <br><br>

        </div>

        <div id="podaci-ucenika">

            <label for="ime">Ime:</label><br>
            <input type="text" id="ime" name="ime"><br><br>

            <label for="prezime">Prezime:</label><br>
            <input type="text" id="prezime" name="prezime"><br><br>

            <label for="telefon">Telefon:</label><br>
            <input type="tel" id="telefon" name="telefon"><br><br>

            <label for="mail">E-mail:</label><br>
            <input type="email" id="mail" name="mail"><br><br>

            <label for="JMBG">JMBG:</label><br>
            <input type="text" id="JMBG" name="JMBG" size="13" maxlength="13"><br><br>

            <label for="dr">Datum rošenja:</label><br>
            <input type="date" id="dr" name="dr"><br><br>

            <label for="mestoR">Mesto rošenja:</label><br>
            <input type="text" id="mestoR" name="mestoR"><br><br>

            <label for="adresa">Adresa prebivališta:</label><br>
            <input type="text" id="adresa" name="adresa"><br><br>

        </div>

        <div id="jezik-ver">

            <p>Strani jezici i veronauka</p>


            <label for="j3">Jezik od 3.:</label><br>
            <input type="text" id="j3" name="j3"><br><br>


            <label for="j6">Jezik od 6.:</label><br>
            <input type="text" id="j6" name="j6"><br><br>
        </div>


        <div id="sved-9">

            <p>Podaci sa svedočansta 9 razreda</p>


            <label for="os">Naziv osnovne škole:</label><br>
            <input type="text" id="os" name="os"><br><br>


            <label for="dbroj">Djelovodni broj</label><br>
            <input type="text" id="dbroj" name="dbroj"><br><br>
            <small>
                On se nalazi u gornje dijelu svjedočanstva. <b>

                    Prikaži
                </b>
            </small>


            <label for="datum-izdavanja">Datum izdavanja:</label><br>
            <input type="date" id="datum-izdavanja" name="datum-izdavanja"><br><br>

            <label for="mesto-izdavanja">Mjesto izdavanja:</label><br>
            <input type="text" id="mesto-izdavanja" name="mesto-izdavanja"><br><br>

        </div>

        <div id="Majka">

            <p>
                Podaci o Majci
            </p>

            <label for="ime-majke">Ime Majke:</label><br>
            <input type="text" id="ime-majke" name="ime-majke"><br><br>

            <label for="prezime-majke">Prezime Majke:</label><br>
            <input type="text" id="prezime-majke" name="prezime-majke"><br><br>

            <label for="telefon-majke">Broj telefona Majke:</label><br>
            <input type="text" id="telefon-majke" name="telefon-majke"><br><br>

            <label for="zanimanje-majke">Zanimanje Majke:</label><br>
            <input type="text" id="zanimanje-majke" name="zanimanje-majke"><br><br>

            <label for="adresa-majke">Adresa prebivališta Majke:</label><br>
            <input type="text" id="adresa-majke" name="adresa-majke"><br><br>
        </div>
    </form>
</body>

</html>
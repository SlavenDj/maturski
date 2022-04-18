<?php
include "prijavaImports/head.php";

$naslovi = array("Smer koji želiš da upišeš", "Alternativni smer");
?>
<div>
    <?php
    for ($i = 0; $i < 2; $i++)
        prikaziSmer($mydb, $sviSmerovi, $naslovi[$i], $i, "Nema unesenih smerova u bazi");
    ?>
    <button type='button'>Dalje</button>
</div>
<div id="vuk">
    <p>Da li si vukovac?</p>
    <input type="radio" name="vukovac" id="vukovac-da" value="1">
    <label for="vukovac-da">Jesam</label>
    <br>
    <input type="radio" name="vukovac" id="vukovac-ne" value="0">
    <label for="vukovac-ne">Nisam</label>
    <br><br>
    <button type='button'>Dalje</button>
</div>

<div id="podaci-ucenika">

    <label for="ime">Ime:</label><br>
    <input type="text" id="ime" name="ime"><br><br>

    <label for="prezime">Prezime:</label><br>
    <input type="text" id="prezime" name="prezime"><br><br>

    <label for="telefon">Telefon:</label><br>
    <input type="tel" id="telefon" name="telefon" placeholder="###/###-###" pattern="[0-9]{3}/[0-9]{3}-[0-9]{3}"><br>
    <small>Npr. 066/887-516</small>
    <br>
    <br>

    <label for="mail">E-mail:</label><br>
    <input type="email" id="mail" name="mail"><br><br>

    <label for="jmbg">JMBG:</label><br>
    <input type="text" id="jmbg" name="jmbg" minlength="13" maxlength="13"><br><br>

    <label for="datum-rodjenja">Datum rođenja:</label><br>
    <input type="date" id="datum-rodjenja" name="datum_rodjenja"><br><br>

    <label for="mestoR">Mesto rođenja:</label><br>
    <input type="text" id="mestoR" name="mestoR"><br><br>

    <label for="adresa">Adresa prebivališta:</label><br>
    <input type="text" id="adresa" name="adresa"><br><br>
    <button type='button'>Nazad</button>
    <button type='button'>Dalje</button>

</div>

<div id="jezik-ver">

    <p>Strani jezici i veronauka</p>


    <label for="j3">Jezik od 3.:</label><br>
    <input type="text" id="j3" name="j3"><br><br>


    <label for="j6">Jezik od 6.:</label><br>
    <input type="text" id="j6" name="j6"><br><br>

    <button type='button'>Nazad</button>
    <button type='button'>Dalje</button>

</div>

<div id="svedocansto-9">

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


    <button type='button'>Nazad</button>
    <button type='button'>Dalje</button>
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

    <button type='button'>Nazad</button>
    <button type='button'>Dalje</button>
</div>

<div id="otac">

    <p>
        Podaci o ocu
    </p>

    <label for="ime-oca">Ime oca:</label><br>
    <input type="text" id="ime-oca" name="ime-oca"><br><br>

    <label for="prezime-oca">Prezime oca:</label><br>
    <input type="text" id="prezime-oca" name="prezime-oca"><br><br>

    <label for="telefon-oca">Broj telefona oca:</label><br>
    <input type="text" id="telefon-oca" name="telefon-oca"><br><br>

    <label for="zanimanje-oca">Zanimanje oca:</label><br>
    <input type="text" id="zanimanje-oca" name="zanimanje-oca"><br><br>

    <label for="adresa-oca">Adresa prebivališta oca:</label><br>
    <input type="text" id="adresa-oca" name="adresa-oca"><br><br>

    <button type='button'>Nazad</button>
    <button type='button'>Dalje</button>
</div>

<p>
    Ocene
</p>
<?php

for ($raz = 6; $raz < 10; $raz++)
    insertingGrades($mydb, $raz);

$mydb->close();
?>

<button>Prijavi se</button>
</form>
</body>

</html>
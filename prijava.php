<?php
include "prijavaImports/head.php";

$naslovi = array("Smer koji želiš da upišeš", "Alternativni smer");
?>
<div id="smer">
    <?php
    for ($i = 0; $i < 2; $i++)
        prikaziSmer($mydb, $sviSmerovi, $naslovi[$i], $i, "Nema unesenih smerova u bazi");
    ?>
    <button type='button' class='next'>Dalje</button>
</div>
<div id="vuk">
    <p>Da li si vukovac?</p>
    <input type="radio" name="vukovac" id="vukovac-da" value="1">
    <label for="vukovac-da">Jesam</label>

    <input type="radio" name="vukovac" id="vukovac-ne" value="0">
    <label for="vukovac-ne">Nisam</label>
    <button type='button' class='back'>Nazad</button>
    <button type='button' class='next'>Dalje</button>
</div>

<div id="podaci-ucenika">

    <label for="ime">Ime:</label>
    <input value="Slaven" type="text" id="ime" name="ime">

    <label for="prezime">Prezime:</label>
    <input value="Đervida" type="text" id="prezime" name="prezime">

    <label for="telefon">Telefon:</label>
    <input value="066/123-456" type="tel" id="telefon" name="telefon" placeholder="###/###-###" pattern="[0-9]{3}/[0-9]{3}-[0-9]{3}">
    <small>Npr. 066/123-456</small>
    <br>


    <label for="mail">E-mail:</label>
    <input value="slavendjervida@gmail.com" type="email" id="mail" name="mail">

    <label for="jmbg">JMBG:</label>
    <input value="3112020160017" type="text" id="jmbg" name="jmbg" minlength="13" maxlength="13">

    <label for="datum-rodjenja">Datum rođenja:</label>
    <input value="2002-12-31" type="date" id="datum-rodjenja" name="datum_rodjenja">

    <label for="mestoR">Mesto rođenja:</label>
    <input value="Prijedor" type="text" id="mestoR" name="mestoR">

    <label for="adresa">Adresa prebivališta:</label>
    <input type="text" id="adresa" name="adresa">
    <button type='button' class='back'>Nazad</button>
    <button type='button' class='next'>Dalje</button>

</div>

<div id="jezik-ver">

    <p>Strani jezici i veronauka</p>


    <label for="j3">Jezik od 3.:</label>
    <select id="j3" name="j3">
        <option value="">Koji jezik si počeo učiti u 3. razredu</option>
        <option value="engleski jezik">Engleski jezik</option>
        <option value="nemacki jezik">Njemački jezik</option>
    </select>


    <label for="j6">Jezik od 6.:</label>
    <select id="j6" name="j6">
        <option value="">Koji jezik si počeo učiti u 6. razredu</option>
        <option value="engleski jezik">Engleski jezik</option>
        <option value="nemacki jezik">Njemački jezik</option>
    </select>

    <label for="veronauka">Veronauka ili etika/kultura religije</label>
    <select name="veronauka" id="veronauka">
        <option value="">Izaberi koji predemt želiš da izučavaš? Veronauku ili etiku</option>
        <option value="pravoslavna">Pravoslavna veronauka</option>
        <option value="rimokatolicka">Rimokatolička veronauka</option>
        <option value="islamska">Islamaska veronauka</option>
        <option value="etika i kultura religije">etika i kultura religije</option>
    </select>
    <button type='button' class='back'>Nazad</button>
    <button type='button' class='next'>Dalje</button>

</div>

<div id="svedocansto-9">

    <p>Podaci sa svedočansta 9 razreda</p>


    <label for="os">Naziv osnovne škole:</label>
    <input value="Vuk" type="text" id="os" name="os">


    <label for="dbroj">Djelovodni broj</label>
    <input value="1234" type="text" id="dbroj" name="dbroj">
    <small>
        On se nalazi u gornje dijelu svjedočanstva.
        <b>

            Prikaži
        </b>
    </small>


    <label for="datum-izdavanja">Datum izdavanja:</label>
    <input value="2018-06-01" type="date" id="datum-izdavanja" name="datum-izdavanja">

    <label for="mesto-izdavanja">Mjesto izdavanja:</label>
    <input value="Prijedor" type="text" id="mesto-izdavanja" name="mesto-izdavanja">


    <button type='button' class='back'>Nazad</button>
    <button type='button' class='next'>Dalje</button>
</div>

<div id="Majka">

    <p>
        Podaci o Majci
    </p>

    <label for="ime-majke">Ime Majke:</label>
    <input type="text" id="ime-majke" name="ime-majke">

    <label for="prezime-majke">Prezime Majke:</label>
    <input type="text" id="prezime-majke" name="prezime-majke">

    <label for="telefon-majke">Broj telefona Majke:</label>
    <input type="tel" id="telefon-majke" name="telefon-majke">

    <label for="zanimanje-majke">Zanimanje Majke:</label>
    <input type="text" id="zanimanje-majke" name="zanimanje-majke">

    <label for="adresa-majke">Adresa prebivališta Majke:</label>
    <input type="text" id="adresa-majke" name="adresa-majke">

    <button type='button' class='back'>Nazad</button>
    <button type='button' class='next'>Dalje</button>
</div>

<div id="otac">

    <p>
        Podaci o ocu
    </p>

    <label for="ime-oca">Ime oca:</label>
    <input type="text" id="ime-oca" name="ime-oca">

    <label for="prezime-oca">Prezime oca:</label>
    <input type="text" id="prezime-oca" name="prezime-oca">

    <label for="telefon-oca">Broj telefona oca:</label>
    <input type="tel" id="telefon-oca" name="telefon-oca">

    <label for="zanimanje-oca">Zanimanje oca:</label>
    <input type="text" id="zanimanje-oca" name="zanimanje-oca">

    <label for="adresa-oca">Adresa prebivališta oca:</label>
    <input type="text" id="adresa-oca" name="adresa-oca">

    <button type='button' class='back'>Nazad</button>
    <button type='button' class='next'>Dalje</button>
</div>


<?php

for ($raz = 6; $raz < 10; $raz++)
    insertingGrades($mydb, $raz);

$mydb->close();
?>


<script src="prijava.js"></script>
</form>
</body>

</html>
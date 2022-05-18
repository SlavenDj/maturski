<?php
include "prijavaImports/head.php";
?>
<div id="uvod">
    <p>
        U koji razred se upisuješ
    </p>

    <div id="razredi">
        <?php
        for ($i = 1; $i < 5; $i++)
            echo "<input type='radio' data-razred='$i' class='razred' name='razred' value='$i'>"
        ?>
    </div>
</div>
<div id="smer">
    <?php
    prikaziSmer($mydb, $sviSmerovi, "Smer koji želiš da upišeš", 0, "Nema unesenih smerova u bazi");
    prikaziSmer($mydb, $sviSmerovi, "Alterinativni smer", 1, "Nema unesenih smerova u bazi");
    ?>
    <div class="buttons">
        <button type='button' class='back'>Nazad</button>
        <button type='button' class='next'>Dalje</button>
    </div>
</div>
<div id="vuk">
    <p>Da li si vukovac?</p>
    <section id="vuk-background">
        <div>
            <input type="radio" name="vukovac" id="vukovac-da" value="1">
            <label for="vukovac-da">Jesam</label>
        </div>
        <div>
            <input type="radio" name="vukovac" id="vukovac-ne" value="0">
            <label for="vukovac-ne">Nisam</label>
        </div>
    </section>
    <div class="buttons">
        <button type='button' class='back'>Nazad</button>
        <button type='button' class='next'>Dalje</button>
    </div>
</div>
<div id="podaci-ucenika">

    <label for="ime">Kako se zoveš:</label>
    <input type="text" id="ime" name="ime">

    <label for="prezime">Kako se prezivaš:</label>
    <input type="text" id="prezime" name="prezime">

    <label for="telefon">Koji je broj tvog telefona:</label>
    <input type="tel" inputmode="numeric" id="telefon" name="telefon" placeholder="### ###-###">


    <label for="mail">Tvoji e-mail:</label>
    <input type="email" id="mail" name="mail">

    <label for="jmbg">Koji je tvoj JMBG:</label>
    <input type="text" id="jmbg" name="jmbg" minlength="13" maxlength="13" inputmode="numeric">

    <label for="datum-rodjenja">Kad si rođen:
    </label>
    <input placeholder="dd-mm-yyyy" type="date" id="datum-rodjenja" name="datum_rodjenja">

    <label for="mesto_rodjenja">Gde si rođen (u kom mestu, u kojoj opštini):</label>
    <input type="text" id="mesto_rodjenja" name="mesto_rodjenja">

    <label for="adresa">Na kojoj adresi živiš:</label>
    <input type="text" id="adresa" name="adresa">

    <div class="buttons">
        <button type='button' class='back'>Nazad</button>
        <button type='button' class='next'>Dalje</button>
    </div>

</div>
<div id="jezik-ver">

    <p>Strani jezici i veronauka</p>

    <?php $jezici = array("engleski jezik", "nemacki jezik", "francuski jezik", "ruski jezik") ?>
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
    <label for="jezikPre">Jezik u prošlom razredu:</label>
    <select id="jezikPre" name="jezikPre">
        <option value="">Koji jezik si učio u prošlom razredu</option>
        <?php
        for ($i = 0; $i < 4; $i++) {
            echo "<option value='{$jezici[$i]}'";
            echo ">{$jezici[$i]}</option>";
        }
        ?>
    </select>
    <label for="zeljeniJezik6">Zeljeni jezik:</label>
    <select id="zeljeniJezik" name="zeljeniJezik">
        <option value="">Koji jezik želiš dalje izučavati</option>
        <?php
        for ($i = 0; $i < 2; $i++) {
            echo "<option value='{$jezici[$i]}'";
            echo ">{$jezici[$i]}</option>";
        }
        ?>
    </select>

    <label for="veronauka">Veronauka ili etika/kultura religije</label>
    <select name="veronauka" id="veronauka">
        <option value="">Izaberi koji predemt želiš da izučavaš? Veronauku ili etiku</option>
        <option value="pravoslavna">Pravoslavna veronauka</option>
        <option value="rimokatolicka">Rimokatolička veronauka</option>
        <option value="islamska">Islamaska veronauka</option>
        <option value="etika i kultura religije">etika i kultura religije</option>
    </select>
    <small>
        Veronauku imaš sve 4 godine ako nju izabereš.
        A ako izabereš etiku i kulture religije onda češ kulturu religije imati 1. i 2. razred a etiku do kraja.
    </small>
    <div class="buttons">
        <button type='button' class='back'>Nazad</button>
        <button type='button' class='next'>Dalje</button>
    </div>
</div>
<div id="svedocansto-9">
    <p>Podaci sa svedočansta 9 razreda</p>
    <label for="osnovna_skola">Naziv osnovne škole:</label>
    <input type="text" id="osnovna_skola" name="osnovna_skola" list="unesene-skole">

     <datalist id="unesene-skole">
        <?php 
        $res=$mydb->query("SELECT osnovna_skola FROM ucenik group by osnovna_skola");
        while($row=$res->fetch_array())
            echo "<option value='{$row["osnovna_skola"]}'>";
        
        ?>

     </datalist>

    <label for="djelovodni_broj">Djelovodni broj</label>
    <input type="text" id="djelovodni_broj" name="djelovodni_broj">
    <small>
        On se nalazi u gornje dijelu svjedočanstva.
        <b id="show-tip">
            Prikaži
        </b>
    </small>
    <div id="tip">
        <img src="imgs/tip.gif" alt="gde se nalazi delovodni broj" loading="lazy">
        <p>
            Dodirni/ kikni bilo gde da bi sakrio sliku.
        </p>
    </div>
    <label for="datum_izdavanja">Datum izdavanja:</label>
    <input type="date" id="datum_izdavanja" name="datum_izdavanja">

    <label for="mesto_izdavanja">Mjesto izdavanja:</label>
    <input type="text" id="mesto_izdavanja" name="mesto_izdavanja">
    <div class="buttons">
        <button type='button' class='back'>Nazad</button>
        <button type='button' class='next'>Dalje</button>
    </div>
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
    <input type="tel" inputmode="numeric" id="telefon-majke" name="telefon-majke" placeholder="### ###-###">

    <label for="zanimanje-majke">Zanimanje Majke:</label>
    <input type="text" id="zanimanje-majke" name="zanimanje-majke">

    <label for="adresa-majke">Adresa prebivališta Majke:</label>
    <input type="text" id="adresa-majke" name="adresa-majke">


    <div class="buttons">
        <button type='button' class='back'>Nazad</button>
        <button type='button' class='next'>Dalje</button>
    </div>
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
    <input type="tel" inputmode="numeric" id="telefon-oca" name="telefon-oca" placeholder="### ###-###">

    <label for="zanimanje-oca">Zanimanje oca:</label>
    <input type="text" id="zanimanje-oca" name="zanimanje-oca">

    <label for="adresa-oca">Adresa prebivališta oca:</label>
    <input type="text" id="adresa-oca" name="adresa-oca">


    <div class="buttons">
        <button type='button' class='back'>Nazad</button>
        <button type='button' class='next'>Dalje</button>
    </div>
</div>
<div id="staratelj">

    <p>
        Podaci o staratelju
    </p>

    <label for="ime-staratelja">Ime staratelja:</label>
    <input type="text" id="ime-staratelja" name="ime-staratelja">

    <label for="prezime-staratelja">Prezime staratelja:</label>
    <input type="text" id="prezime-staratelja" name="prezime-staratelja">

    <label for="telefon-staratelja">Broj telefona staratelja:</label>
    <input type="tel" inputmode="numeric" id="telefon-staratelja" name="telefon-staratelja" placeholder="### ###-###">

    <label for="zanimanje-staratelja">Zanimanje staratelja:</label>
    <input type="text" id="zanimanje-staratelja" name="zanimanje-staratelja">

    <label for="adresa-staratelja">Adresa prebivališta staratelja:</label>
    <input type="text" id="adresa-staratelja" name="adresa-staratelja">


    <div class="buttons">
        <button type='button' class='back'>Nazad</button>
        <button type='button' class='next'>Dalje</button>
    </div>
</div>
<?php
for ($raz = 6; $raz < 10; $raz++)
    insertingGrades($mydb, $raz);
$mydb->close();
?>
</form>
<div id="insertJMBG">
    <form action="ucenik.php" method="post" id="find-form"  onSubmit='return'>
        <label for="find-jmbg">Unesi svoji JMBG</label>
        <input type="text" id="find-jmbg" name="jmbg">
        <input type="number" id="razred-koji-upisuje" name='razredKojiUpisuje' hidden>
        <div class="buttons">
        <button type='button' class='back' id="back-find-jmbg">Nazad</button>
            <button id="pronadi-me" disabled>Pronađi me</button>
        </div>
    </form>
</div>
<script type="module" src="prijava.js"></script>
</body>

</html>
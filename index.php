<!DOCTYPE html>
<html lang='sr'>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/style.css">
    <title>Prijava</title>
    <link rel="shortcut icon" href="imgs/pen_client_favicon.svg" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>

<body class="prijava">
    <nav>
        <a href="https://elskolapd.com/" target="_blank" rel="noopener noreferrer">
            <img src="imgs/LOGO REDIZAJN HD.webp" alt="logo JU Elektretehničke škole Prijedor" id="logo-big">
        </a>
        <div id="buttons">
            <button id="smorio-se">
                Smorio sam se
            </button>
            <button type='button' id='back'>Nazad</button>
            <button type='button' id='next-button'>Dalje</button>
            <button id='prijavi-se-button'>Završi i prikaži bodove</button>
        </div>
    </nav>
    <form method="post" action="prijavaImports/hvala.php" id="main-form">
        <?php
        include "admin_files/conn.php";
        include "admin_files/funs.php";
        include "admin_files/querys.php"; ?>

        <div id="uvod">
            <p id='welcome'>
                Dobrodošao/la na kalkulator bodova za upis u elektrotehničku školu.
            </p>
            <p>
                Ovaj sajt je urađen u sklopu maturskog rada u školskoj 2021/2022. godini.
            </p>
            <p>
                Autor sajta: Slaven Đervida, IV-1
            </p>
            <h3>
                Odaberi razred koji upisuješ.
            </h3>

            <div id="razredi">
                <?php
                for ($i = 1; $i < 5; $i++)
                    echo "<input type='radio' data-razred='$i' class='razred' name='razred' value='$i'>"
                ?>
            </div>
        </div>

        <div id="tvoj-jmbg">
            <label for="jmbg">
                <h3>
                    Da bismo započeli, potreban nam je tvoj JMBG
                </h3>
            </label>
            <input type="text" id="jmbg" name="jmbg" minlength="13" maxlength="13" inputmode="numeric">

        </div>

        <div id="vuk" class='yes_no'>
            <h3 id='vuk-title'>Da li si vukovac, tj. da li si od 6. do 9. razreda imao/la sve petice?</h3>
            <section class="white-bg">
                <div>
                    <input type="radio" name="vukovac" id="vukovac-da" value="1">
                    <label for="vukovac-da">Jesam vukovac</label>
                </div>
                <div>
                    <input type="radio" name="vukovac" id="vukovac-ne" value="0">
                    <label for="vukovac-ne">Nisam vukovac</label>
                </div>
            </section>

        </div>

        <?php
        for ($raz = 6; $raz < 10; $raz++)
            insertingGrades($mydb, $raz);
        ?>

        <div id='zelis-li-dalje' class='yes_no'>
            <h3>
                Samo na korak si od toga da se prijaviš za upis u našu školu.
            </h3>
            <p>
                <br>Možemo li te zamoliti za još nekoliko podataka, kako bismo ubrzali postupak upisa kada dođeš u školu?

            </p>
            <section class='white-bg'>
                <div>
                    <input type="radio" id="nastavlja" name="sledeci-korac" value="1">
                    <label for="nastavlja">Dovršiću prijavu za upis</label>
                </div>
                <div>

                    <input type="radio" name="ne-nastavlja" name="sledeci-korac" id="ne-nastavlja" value="0">
                    <label for="ne-nastavlja">Prikaži mi samo koliko bodova imam

                    </label>
                </div>
            </section>

        </div>
        <div id="smer">
            <?php
            prikaziSmer($mydb, $sviSmerovi, "Koji smJer želiš da upišeš?", 0, "Nema unesenih smerova u bazi");
            prikaziSmer($mydb, $sviSmerovi, "Ako se slučajno desi da ne \"upadneš\" u gornji smJer, da li bi možda želio da se upišeš u neki drugi smjer u našoj školi?", 1, "Nema unesenih smerova u bazi");
            ?>

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

            <label for="datum-rodjenja">Kad si rođen:
            </label>
            <input placeholder="dd-mm-yyyy" type="date" id="datum-rodjenja" name="datum_rodjenja">

            <label for="mesto_rodjenja">Gdje si rođen (u kom mjestu, opštini, entitetu i državi):</label>
            <input type="text" id="mesto_rodjenja" name="mesto_rodjenja" placeholder="Npr: Prijedor, Prijedor, RS, BiH">

            <label for="adresa">Na kojoj adresi živiš:</label>
            <input type="text" id="adresa" name="adresa" placeholder="Npr: Nikole Tesle 78, Prijedor">

        </div>
        <div id="jezik-ver">

            <h3>Strani jezici i vjeronauka</h3>

            <?php
            $jezici = array("engleski jezik", "njemački jezik", "francuski jezik", "ruski jezik") ?>
            <label for="jezik_od_3">Prvi strani jezik</label>
            <select id="jezik_od_3" name="jezik_od_3">
                <option value="">Onaj koji učiš od 3. razreda osnovne škole</option>
                <?php
                for ($i = 0; $i < 4; $i++) {
                    echo "<option value='{$jezici[$i]}'";

                    echo ">{$jezici[$i]}</option>";
                }

                ?>
            </select>

            <label for="jezik_od_6">Drugi strani jezik:</label>
            <select id="jezik_od_6" name="jezik_od_6">
                <option value="">Onaj koji učiš od 6. razreda osnovne škole</option>
                <?php
                for ($i = 0; $i < 4; $i++) {
                    echo "<option value='{$jezici[$i]}'";

                    echo ">{$jezici[$i]}</option>";
                }

                ?>
            </select>
            <!-- 
                 ! KLIMAVO 
                -->
            <label hidden for="jezikPre">Jezik u prošlom razredu:</label>
            <select id="jezikPre" name="jezikPre" hidden>
                <option value="">Koji jezik si učio u prošlom razredu</option>
                <?php
                for ($i = 0; $i < 4; $i++) {
                    echo "<option value='{$jezici[$i]}'";
                    echo ">{$jezici[$i]}</option>";
                }
                ?>
            </select>
            <label for="zeljeniJezik6">Odabir jezika:</label>
            <select id="zeljeniJezik" name="zeljeniJezik">
                <option value="">Koji jezik želiš da učiš u srednjoj školi?</option>
                <?php
                for ($i = 0; $i < 2; $i++) {
                    echo "<option value='{$jezici[$i]}'";
                    echo ">{$jezici[$i]}</option>";
                }
                ?>
            </select>
            <br><br>
            <label for="veronauka">Odaberi željeni predmet</label>
            <p>
                U srednjoj školi možeš da nastaviš da učiš vjeronauku koju si imao/la u osnovnoj školi, a možeš da ga zamijeniš novim predmetom koji se zove Kultura religija, koji ćeš imati u 1. i 2. razredu, a u 3. i 4. ga zamjenjuje etika.
                Imaj u vidu da, šta god da odabereš, to učiš naredne 3 ili 4 godine u zavisnosti od smjera kojeg upišeš.
            </p>
            <select name="veronauka" id="veronauka">
                <option value="">Izaberi koji predemt želiš da izučavaš? Veronauku ili etiku</option>
                <option value="pravoslavna">Pravoslavna veronauka</option>
                <option value="rimokatolicka">Rimokatolička veronauka</option>
                <option value="islamska">Islamaska veronauka</option>
                <option value="etika i kultura religije">etika i kultura religije</option>
            </select>

        </div>
        <div id="svedocansto-9">
            <h3>Podaci sa svjedočanstva 9. razreda</h3>
            <label for="osnovna_skola">Naziv osnovne škole:</label>
            <input type="text" id="osnovna_skola" name="osnovna_skola" list="unesene-skole">

            <datalist id="unesene-skole">
                <?php
                $res = $mydb->query("SELECT osnovna_skola FROM ucenik group by osnovna_skola");
                while ($row = $res->fetch_array())
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
                    Dodirni/ klikni bilo gdje da bi sakrio sliku.
                </p>
            </div>
            <label for="datum_izdavanja">Datum izdavanja:</label>
            <input type="date" id="datum_izdavanja" name="datum_izdavanja">

            <label for="mesto_izdavanja">Mjesto izdavanja:</label>
            <input type="text" id="mesto_izdavanja" name="mesto_izdavanja">
            <small>
                Datum i mjesto izdavanja se nalaze u dnu svjedočanstva
            </small>
        </div>
        <div id="Majka">

            <h3>
                Podaci o tvojoj majci
            </h3>

            <label for="ime-majke">Ime majke:</label>
            <input type="text" id="ime-majke" name="ime-majke">

            <label for="prezime-majke">Prezime majke:</label>
            <input type="text" id="prezime-majke" name="prezime-majke">

            <label for="telefon-majke">Broj telefona majke:</label>
            <input type="tel" inputmode="numeric" id="telefon-majke" name="telefon-majke" placeholder="### ###-###">

            <label for="zanimanje-majke">Zanimanje majke:</label>
            <input type="text" id="zanimanje-majke" name="zanimanje-majke">

            <label for="adresa-majke">Na kojoj adresi tvoja majka živi:</label>
            <input type="text" id="adresa-majke" name="adresa-majke">

        </div>
        <div id="otac">

            <h3>
                Podaci o tvom ocu
            </h3>

            <label for="ime-oca">Ime oca:</label>
            <input type="text" id="ime-oca" name="ime-oca">

            <label for="prezime-oca">Prezime oca:</label>
            <input type="text" id="prezime-oca" name="prezime-oca">

            <label for="telefon-oca">Broj telefona oca:</label>
            <input type="tel" inputmode="numeric" id="telefon-oca" name="telefon-oca" placeholder="### ###-###">

            <label for="zanimanje-oca">Zanimanje oca:</label>
            <input type="text" id="zanimanje-oca" name="zanimanje-oca">

            <label for="adresa-oca">Na kojoj adresi tvoj oca živi:</label>
            <input type="text" id="adresa-oca" name="adresa-oca">

        </div>
        <div id="staratelj">

            <h3>
                Podaci o tvom staratelju
            </h3>

            <p>
                Neka djeca ne žive sa ocem ili majkom i imaju staratelja. <br>
                Ako se ovo ne odnosi na tebe, samo pritisni <a id='prijavi-se-link'>završi i prikaži bodove</a>. <br>
                Ovaj dio popunjavaju samo oni učenici koji žive sa starateljima.
            </p>

            <label for="ime-staratelja">Ime staratelja:</label>
            <input type="text" id="ime-staratelja" name="ime-staratelja">

            <label for="prezime-staratelja">Prezime staratelja:</label>
            <input type="text" id="prezime-staratelja" name="prezime-staratelja">

            <label for="telefon-staratelja">Broj telefona staratelja:</label>
            <input type="tel" inputmode="numeric" id="telefon-staratelja" name="telefon-staratelja" placeholder="### ###-###">

            <label for="zanimanje-staratelja">Zanimanje staratelja:</label>
            <input type="text" id="zanimanje-staratelja" name="zanimanje-staratelja">

            <label for="adresa-staratelja">Na kojoj adresi tvoj staratelj živi:</label>
            <input type="text" id="adresa-staratelja" name="adresa-staratelja">

        </div>

    </form>
    <div id="insertJMBG">
        <form action="ucenik.php" method="post" id="find-form" onSubmit='return'>
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
    <div id="progress-bar"></div>
</body>

</html>
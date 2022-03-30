<div id="Predmeti">
    <h2>
        Predmeti u 6. razredu
    </h2>
    <?php
    include "upiti_za_dodavanje_i_brisanje_predmeta_6.php";
    include "funs.php";
    include "querys.php";
    printInTable($mydb, $q3);
    ?>
    <form method="POST">
        <?php selectMenu($mydb, $q2, "dodaj_ovaj_predmet_6") ?>
        <input type="number" id="redni_broj_6" name="redni_broj_6" required>
        <button>dodaj</button>
    </form>
    <form method="POST">
        <?php selectMenu($mydb, $q3, 'izbrisi_ovaj_predmet_6') ?>
        <button>Ukloni</button>
    </form>
</div>
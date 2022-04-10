<div id="Predmeti">
    <h2>
        Predmeti u 6. razredu
    </h2>
    <?php

    printInTable($mydb, sviPred(6));
    ?>
    <form method="POST">
        <?php selectMenu($mydb, $sviPred, "dodaj_ovaj_predmet_6") ?>
        <input type="number" id="redni_broj_6" name="redni_broj_6" required>
        <button>dodaj</button>
    </form>
    <form method="POST">
        <?php selectMenu($mydb, sviPred(6), 'izbrisi_ovaj_predmet_6') ?>
        <button>Ukloni</button>
    </form>
</div>
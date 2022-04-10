<div id="Predmeti">
    <h2>
        Predmeti u 9. razredu
    </h2>
    <?php

    printInTable($mydb, sviPred(9));
    ?>
    <form method="POST">
        <?php selectMenu($mydb, $sviPred, "dodaj_ovaj_predmet_9") ?>
        <input type="number" id="redni_broj_9" name="redni_broj_9" required>
        <button>dodaj</button>
    </form>
    <form method="POST">
        <?php selectMenu($mydb, sviPred(9), 'izbrisi_ovaj_predmet_9') ?>
        <button>Ukloni</button>
    </form>
</div>
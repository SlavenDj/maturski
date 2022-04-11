<div class="Predmeti">
    <h2>
        Predmeti u 7. razredu
    </h2>
    <?php

    printInTable($mydb, sviPred(7));
    ?>
    <form method="POST">
        <?php selectMenu($mydb, $sviPred, "dodaj_ovaj_predmet_7") ?>
        <input type="number" id="redni_broj_7" name="redni_broj_7" required>
        <button>dodaj</button>
    </form>
    <form method="POST">
        <?php selectMenu($mydb, sviPred(7), 'izbrisi_ovaj_predmet_7') ?>
        <button>Ukloni</button>
    </form>
</div>
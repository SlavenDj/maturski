<div class="Predmeti">
    <h2>
        Predmeti u 8. razredu
    </h2>
    <?php

    printInTable($mydb, sviPred(8));
    ?>
    <form method="POST">
        <?php selectMenu($mydb, $sviPred, "dodaj_ovaj_predmet_8") ?>
        <input type="number" id="redni_broj_8" name="redni_broj_8" required>
        <button>dodaj</button>
    </form>
    <form method="POST">
        <?php selectMenu($mydb, sviPred(8), 'izbrisi_ovaj_predmet_8') ?>
        <button>Ukloni</button>
    </form>
</div>
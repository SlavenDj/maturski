<div id="Predmeti">
    <h2>
        Predmeti u 6. razredu
    </h2>
    <?php
    include "upiti_za_dodavanje_i_brisanje_predmeta.php";
    
    function sviPred($x)
    {
        return "SELECT veza_razred_predmet.id,
            naziv
            FROM   `veza_razred_predmet`
            INNER JOIN `predmeti`
                    ON predmeti.id = veza_razred_predmet.predmet
                    AND razred = $x 
            ORDER  BY redni_broj";
    }


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
<div class="Predmeti">
    <h2>
        Svi predmeti
    </h2>
    <?php
    printInTable($mydb, "predmeti" ,$sviPred, "Naziv predmeta", "Ukloni", "Preimenuj");
    ?>
    <form method="POST" class="obrazac_dodavanja">
        <input type="text" name="naziv_predmeta" id="naziv_predmeta" placeholder="Redni broj predmeta na svedočanstvu">
        <button>Dodaj</button>
    </form>
    <form method="POST">
        <?php
        selectMenu($mydb, $sviPred, 'izbrisi_predmet');
        ?>
        
    </form>
</div>
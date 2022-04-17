<div class="Predmeti">
    <h2>
        Svi predmeti
    </h2>
    <?php
    //brisanje predmeta
    if (isset($_POST["izbrisi_predmet"]))
        $mydb->query("DELETE FROM predmeti WHERE ID=" . (int)$_POST["izbrisi_predmet"]);

    //dodavanje predmeta    
    if (isset($_POST["naziv_predmeta"]))
        if ($mydb->query("INSERT INTO `predmeti` (`Naziv`) VALUES ('" . $_POST["naziv_predmeta"] . "');") !== TRUE)
            echo "Error: " . $mydb->error;

    printInTable($mydb, "predmeti" ,$sviPred, "Ukloni", "Preimenuj");

   
    ?>
    <form method="POST" class="obrazac_dodavanja">
        <input type="text" name="naziv_predmeta" id="naziv_predmeta" placeholder="Redni broj predmeta na svedočanstvu">
        <button>Dodaj</button>
    </form>
    <form method="POST">
        <?php
        selectMenu($mydb, $sviPred, 'izbrisi_predmet');
        ?>
        <button>Ukloni</button>
    </form>
</div>
<div id="Predmeti">
    <h2>
        Predmeti
    </h2>
    <?php include "upiti_za_prikazivanje_dodavanje_i_brisanje_predmeta.php" ;
   
    ?>
    <form method="POST" class="obrazac_dodavanja">
        <input type="text" name="naziv_predmeta" id="naziv_predmeta">
        <button>Dodaj</button>
    </form>
    <form method="POST">
        <?php
        echo "<select name='izbrisi_ovaj_predmet'>";
        echo "<option value=" . 000 . "> --- </option>";
        $svi_predmeti = $mydb->query($sviPred);
        if ($svi_predmeti->num_rows > 0) {

            while ($predmet = $svi_predmeti->fetch_assoc()) {
                echo "<option value=" . $predmet["id"] . ">" . $predmet["naziv"] . "</option>";
            }
        }
        echo "</select>";
        ?>
        <button>Ukloni</button>
    </form>
</div>
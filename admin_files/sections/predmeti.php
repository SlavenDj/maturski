<div class="Predmeti">
    <h2>
        Svi predmeti
    </h2>
    <?php printInTable($mydb, "predmeti", $sviPred, "Naziv predmeta", "Ukloni", "Preimenuj") ?>
    <form method="POST" class="obrazac_dodavanja">
        <input type="text" name="naziv_predmeta" id="naziv_predmeta" placeholder="Novi predmet">
        <button>Dodaj novi predmet</button>
    </form>
</div>
<?php
include "admin_files/head.php";
include 'admin_files/sections/predmeti.php';
predmetiU(6);
predmetiU(7);
predmetiU(8);
predmetiU(9);
include 'admin_files/sections/smerovi.php';
?>
<button type="button" id="findBtn">Pronađi učenika</button>
<script>
    document.querySelectorAll("#findBtn").addEventListener("click", ()=>{
        let jmbg=prompt("Unesi JMBG učenika kojeg tražite");
    })
</script>
<?php
include 'admin_files/footer.php';

// <?php echo ($dbvalue['tag_1']==1 ? 'checked' : '');?>
<!-- https://stackoverflow.com/questions/16239663/php-checkbox-set-to-check-based-on-database-value -->
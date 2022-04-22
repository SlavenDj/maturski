<?php
include "admin_files/head.php";
include 'admin_files/sections/predmeti.php';
predmetiU(6);
predmetiU(7);
predmetiU(8);
predmetiU(9);
include 'admin_files/sections/smerovi.php';
?>

<form  action="ucenik.php" method="post"> 
    <label for="jmbg">Unesi JMBG učenika kojeg tražite</label>
<input type="text" name="jmbg" id="jmbg" placeholder="JMBG učenika">
    <button id="findBtn">Pronađi učenika</button>
    <script>
        // document.querySelector("#findBtn").addEventListener("click", () => {
        //         let jmbg = prompt("Unesi JMBG učenika kojeg tražite");
        //     })

            </script>
            </form>
    <?php
    include 'admin_files/footer.php';

    // <?php echo ($dbvalue['tag_1']==1 ? 'checked' : '');
    ?>
    <!-- https://stackoverflow.com/questions/16239663/php-checkbox-set-to-check-based-on-database-value -->
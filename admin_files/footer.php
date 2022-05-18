<form id="change" method="POST">
    <input type="text" id="query" name="query" hidden>
</form>
<script src="../admin_files/main.js"></script>
<!-- <script src="../prijava.js" type="module"></script> -->


<script>
    const jmbgFiledForFinding = document.querySelector("#find-jmbg")
const btnFindMe = document.querySelector("#pronadi-me");
jmbgFiledForFinding.addEventListener("input", () => {
    // if (jmbgFiledForFinding.value.length === 13) {
    let xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            let message = this.responseText

            if (message === "false") {
                btnFindMe.innerText = "Nema takvog JMBG kod nas";
                btnFindMe.toggleAttribute("disabled", true)
                // btnFindMe.classList.toggle("not-ok-jmbg", true);
                btnFindMe.classList.toggle("ok-jmbg", false);

                document.getElementById("find-form").toggleAttribute("onSubmit='return'", false)

            }
            else {
                btnFindMe.innerText = message;
                btnFindMe.toggleAttribute("disabled", false)

                // btnFindMe.classList.toggle("not-ok-jmbg", false);
                btnFindMe.classList.toggle("ok-jmbg", true);

                document.getElementById("find-form").toggleAttribute("onSubmit='return'", true)

            }

        }
    };
    xmlhttp.open("GET", "../searchJMBG.php?q=" + jmbgFiledForFinding.value, true);
    xmlhttp.send();
    // }
})
</script>
</body>
</html>

<?php $mydb->close(); ?>
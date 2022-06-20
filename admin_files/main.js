let input = document.getElementById("new-order-nuber")

const edit = e => {
    let id = Number(e.target.dataset["id"]);
    let table = e.target.dataset["table"];
    if (e.target.textContent === "Preimenuj") {
        let ans = prompt(`Koji je novi naziv?`)
        input.value = `UPDATE \`${table}\` SET naziv = '${ans}' WHERE id=${id}`;
        if (ans != null)
            document.querySelector("#change").submit();
        return "hi";
    }
    let ans = prompt(`Koji je novi redni broj predmet na svedočanstvu? (trenutni je: ${e.target.dataset["redniBroj"]})`)
    input.value = `UPDATE \`${table}\` SET Redni_broj = '${ans}' WHERE id=${id}`;
    if (ans != null) {
        document.querySelector("#change").submit();
        return;
    }
}

const remove = e => {
    let id = Number(e.target.dataset["id"]);
    let table = e.target.dataset["table"];

    input.value = `DELETE FROM \`${table}\` WHERE id=${id}`;
    if (confirm("Da li ste sigurni da želite obrisati predmet?"))
        document.querySelector("#change").submit();
}

document.querySelectorAll(".delete").forEach((btn) => btn.addEventListener("click", remove))
document.querySelectorAll(".edit").forEach((btn) => btn.addEventListener("click", edit))


const jmbgFiledForFinding = document.querySelector("#find-jmbg")
        const btnFindMe = document.querySelector("#pronadi-me");
        jmbgFiledForFinding.addEventListener("input", () => {

            let xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    let message = this.responseText

                    if (message === "false") {
                        btnFindMe.innerText = "Nema takvog JMBG kod nas";
                        btnFindMe.toggleAttribute("disabled", true)

                        btnFindMe.classList.toggle("ok-jmbg", false);

                        document.getElementById("find-form").toggleAttribute("onSubmit='return'", false)

                    } else {
                        btnFindMe.innerText = message;
                        btnFindMe.toggleAttribute("disabled", false)


                        btnFindMe.classList.toggle("ok-jmbg", true);

                        document.getElementById("find-form").toggleAttribute("onSubmit='return'", true)

                    }

                }
            };
            xmlhttp.open("GET", "../searchJMBG.php?q=" + jmbgFiledForFinding.value, true);
            xmlhttp.send();

        })

        document.getElementById("dodaj-admina").addEventListener("click", () => {
            document.getElementById("new-admin-username").value = prompt("Korisničko ime novog admina");

            document.getElementById("new-admin-password").value = prompt("Šifra novog admina");
        })


        document.getElementById("promeni-pass").addEventListener("click", (e) => {
                let tryAgain = true;
                while (tryAgain) {
                    document.getElementById("new-pwrd-1").value = prompt("Unesi novu šifru");
                    tryAgain = false;
                }
            }

        )
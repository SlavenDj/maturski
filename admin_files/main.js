let input = document.getElementById("query")

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
    let ans = prompt(`Koji je novi redni broj predmet na svedočanstvu?`)
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
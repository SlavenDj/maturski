function hideElement(element) {
    const obrazac = document.querySelector(`#${element}`);
    obrazac.style.display = "none";
}
function showElement(element) {
    const obrazac = document.querySelector(`#${element}`);
    obrazac.style.display = "flex";
}

function showTip() {
    document.querySelector("#tip").style.display = "grid";
    document.querySelectorAll(".buttons").forEach(btns => btns.style.display = "none")
}
function hideTip() {
    document.querySelector("#tip").style.display = "none";
    document.querySelectorAll(".buttons").forEach(btns => btns.style.display = "flex")

}
function showJMBGInputsection() {
    document.getElementById("insertJMBG").style.display = "flex";
}
const
    MAX_DAYS_IN_MONTH = 31,
    LAST_MONTH = 12;
function IsjmbgValidator(jmbg) {

    const
        dd = Number(`${jmbg[0]}${jmbg[1]}`),
        mm = Number(`${jmbg[2]}${jmbg[3]}`),
        k = Number(`${jmbg[12]}`)
    let suma = 0, multipler = 7;
    for (let i = 0; i < jmbg.length - 1; i++) {
        suma += multipler-- * Number(jmbg[i]);
        if (multipler == 1) multipler = 7;
    }

    let m = suma % 11;
    if (
        dd <= MAX_DAYS_IN_MONTH
        &&
        mm <= LAST_MONTH
        &&
        (m == k || k == 11 - m)
    )
        return true;
    return false;
}
function isClassCheked() {
    const classes = document.querySelectorAll(".razred");
    let res = false;
    classes.forEach(checkbox => {
        if (checkbox.checked === true)
            res = true;
    })
    return res;
}

function onEscapeBlur(e) {
    if (e.key === "Escape")
        document.activeElement.blur();
}

function edgeCases(section) {
    if (section === "podaci-ucenika" &&
        IsjmbgValidator(document.querySelector("#jmbg").value) === false) {
        alert("Nije validan JMBG.")
        return false;
    }
    if (!isClassCheked()) {
        alert("Moraš izabrati razred.")
        return false;

    }
    if (section === "uvod" &&
        document.querySelector("[data-razred='1']").checked === false) {
        showJMBGInputsection();

        return false;
    }
}
export { hideElement, showElement, showTip, hideTip, showJMBGInputsection, IsjmbgValidator, onEscapeBlur, edgeCases }
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
    document.getElementById("insertJMBG").style.display="flex";
}
function IsjmbgValidator(jmbg) {
    const
        dd = Number(`${jmbg[0]}${jmbg[1]}`),
        mm = Number(`${jmbg[2]}${jmbg[3]}`),
        ggg = Number(`${jmbg[4]}${jmbg[5]}${jmbg[6]}`),
        rr = Number(`${jmbg[7]}${jmbg[8]}`),
        bbb = Number(`${jmbg[9]}${jmbg[10]}${jmbg[11]}`),
        k = Number(`${jmbg[12]}`)


    return true;
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
        IsjmbgValidator(document.querySelector("#jmbg").value) === false){
            alert("Moraš izabrati razred.")
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
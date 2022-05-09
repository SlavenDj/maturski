import * as fun from "./functions.js";
//fun.IsjmbgValidator

// const sections = [
//     "uvod",
//     "smer",
//     "vuk",
//     "podaci-ucenika",
//     "jezik-ver",
//     "svedocansto-9",
//     "Majka",
//     "otac",
//     "ocene-6",
//     "ocene-7",
//     "ocene-8",
//     "ocene-9"
// ]
const sections=Array.from(document.querySelectorAll("#main-form > *")).map(e=>e.id)

let currentSection = 0;
addEventListener("load", () => {
    fun.showElement(sections[currentSection]);
})

let test={
    ime: "Slaven",
    prezime: "Đervida",
    mail: "slavendjervida@gmail.com",
    brtel: "066 887-516",
    adresa: "Gradina bb",
    rodenjdan: "2002-12-31",
    mestorodjenja: "Prijedor, Prijedor, RS, BiH",
    jmbg: "3112002017016",
    imeMajke: "Anđelka",
    prezimeMajke: "Đervida",
    zanimanjeMajke: "Programer",
    telMajke: "066 059-176",
    adresaMajke: "Gradina bb",
    imeo: "Konj",
    prezo: "Konj",
    zano: "Konj",
    telo: "Konj",
    adresao: "...",

}



addEventListener("keydown", e => {
    fun.onEscapeBlur(e)
    if (document.activeElement.tagName !== "BODY")
        return;
    if (fun.edgeCases(sections[currentSection]) === false) return;
    if (e.key == "ArrowLeft" && currentSection) {
        fun.hideElement(sections[currentSection])
        currentSection--;
        fun.showElement(sections[currentSection]);
    }
    if (e.key == "ArrowRight" && currentSection + 1 < sections.length) {
        fun.hideElement(sections[currentSection])
        currentSection++;
        fun.showElement(sections[currentSection]);
    }

})

const btnsForNext = document.querySelectorAll(".next");
btnsForNext.forEach((btn) => {
    btn.addEventListener("click", () => {
        if (fun.edgeCases(sections[currentSection]) === false) return;
        fun.hideElement(sections[currentSection])
        currentSection++;
        fun.showElement(sections[currentSection]);
    })
})
const btnsForBack = document.querySelectorAll(".back");
btnsForBack.forEach((btn) => {
    
    btn.addEventListener("click", () => {
        if (fun.edgeCases(sections[currentSection]) === false) return;
        fun.hideElement(sections[currentSection])
        currentSection--;
        fun.showElement(sections[currentSection]);
    })
})

const tipBtn = document.querySelector("#show-tip");
tipBtn.addEventListener("click", fun.showTip)
document.querySelector("#tip").addEventListener("click", fun.hideTip);

const checkBoxes_smer = document.querySelectorAll("input[name^='smer-']");
checkBoxes_smer.forEach(checkBox => {
    checkBox.parentElement.parentElement.addEventListener("click", e => {
        const currentCheckbox = e.target.parentElement.querySelector("input[name^='smer-']")
        currentCheckbox.checked = true;
    })
});



const yes_no_vukovac = document.querySelectorAll("#vuk-background div")
yes_no_vukovac[0].addEventListener("click", e => {
    const marks5 = document.querySelectorAll("[data-ocena='5']");
    marks5.forEach(mark => {
        mark.checked = true;
    })
})

yes_no_vukovac[1].addEventListener("click", e => {
    const marks5 = document.querySelectorAll("[data-ocena='5']");
    marks5.forEach(mark => {
        mark.checked = false;
    })
})



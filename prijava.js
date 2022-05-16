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
const sections = Array.from(document.querySelectorAll("#main-form > *")).map(e => e.id)

let currentSection = 0;
addEventListener("load", () => {
    fun.showElement(sections[currentSection]);
})

let test = {
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
    if (e.key == "ArrowLeft" && currentSection && fun.edgeCases(sections[currentSection])) {
        fun.hideElement(sections[currentSection])
        currentSection--;
        fun.showElement(sections[currentSection]);
    }
    if (e.key == "ArrowRight" && currentSection + 1 < sections.length
        && fun.edgeCases(sections[currentSection])) {
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


const jmbgFiledForFinding = document.querySelector("#find-jmbg")
const btnFindMe = document.querySelector("#pronadi-me");
jmbgFiledForFinding.addEventListener("input", () => {
    if (jmbgFiledForFinding.value.length === 13) {
        let xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                let message = this.responseText

                if (message === "false") {
                    btnFindMe.innerText = "Nema takvog JMBG kod nas";
                    btnFindMe.toggleAttribute("disabled", true)

                }
                else{
                    btnFindMe.innerText = message;
                    btnFindMe.toggleAttribute("disabled", false)
                }

            }
        };
        xmlhttp.open("GET", "searchJMBG.php?q=" + jmbgFiledForFinding.value, true);
        xmlhttp.send();
    }
})

document.querySelector('[data-razred="1"]').addEventListener("click",

    () => {
        if (fun.edgeCases(sections[currentSection]) === false) return;
        fun.hideElement(sections[currentSection])
        currentSection++;
        fun.showElement(sections[currentSection]);
    }
)

document.querySelector('[data-razred="2"]').addEventListener("click", () => {
    document.getElementById("insertJMBG").style.display = "flex";
    fun.hideElement(sections[currentSection]);

}

)
document.querySelector('[data-razred="3"]').addEventListener("click", () => {
    document.getElementById("insertJMBG").style.display = "flex";
    fun.hideElement(sections[currentSection]);

}

)
document.querySelector('[data-razred="4"]').addEventListener("click", () => {
    document.getElementById("insertJMBG").style.display = "flex";
    fun.hideElement(sections[currentSection]);

}

)
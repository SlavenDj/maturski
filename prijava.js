import * as fun from "./functions.js";

const sections = Array.from(document.querySelectorAll("#main-form > *")).map(
    (section) => section.id
  ),
  jmbgFiledForFinding = document.getElementById("find-jmbg"),
  btnFindMe = document.getElementById("pronadi-me"),
  findForm = document.getElementById("find-form"),
  nextPage = () =>
    (currentSection = fun.swapSections(sections, currentSection, fun.NEXT())),
  previousPage = () =>
    (currentSection = fun.swapSections(
      sections,
      currentSection,
      fun.PREVIOUS()
    ));
let currentSection = 0;

fun.showElement(sections[currentSection]);

document
  .getElementById("next-button")
  .addEventListener("click", () => nextPage());

document.getElementById("back").addEventListener("click", () => previousPage());

document.getElementById("show-tip").addEventListener("click", fun.showTip);
document.getElementById("tip").addEventListener("click", fun.hideTip);

document.getElementById("vukovac-da").addEventListener("click", () => {
  currentSection = fun.swapSections(sections, currentSection, fun.NEXT(5));
});
["vukovac-ne", "nastavlja"].forEach((element) => {
  document.getElementById(element).addEventListener("click", () => {
    nextPage();
  });
});

document.getElementById("back-find-jmbg").addEventListener("click", () => {
  fun.showElement(sections[currentSection]);
  fun.hideElement("insertJMBG");
});

document.getElementById("ne-nastavlja").addEventListener("click", () => {
  document.getElementById("main-form").submit();
});
document.getElementById("prijavi-se-link").addEventListener("click", () => {
  document.getElementById("main-form").submit();
});
document.getElementById("prijavi-se-button").addEventListener("click", () => {
  document.getElementById("main-form").submit();
});

function onReadyStateChangeCallBack() {
  if (this.readyState == 4 && this.status == 200) {
    let message = this.responseText;
    if (message === "false") {
      btnFindMe.innerText = "Nema takvog JMBG kod nas";
      btnFindMe.toggleAttribute("disabled", true);
      btnFindMe.classList.toggle("ok-jmbg", false);
      findForm.toggleAttribute("onSubmit='return'", false);
      return;
    }
    btnFindMe.innerText = message;
    btnFindMe.toggleAttribute("disabled", false);
    btnFindMe.classList.toggle("ok-jmbg", true);
    findForm.toggleAttribute("onSubmit='return'", true);
  }
}

jmbgFiledForFinding.addEventListener("input", () => {
  let xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = onReadyStateChangeCallBack;
  xmlhttp.open("GET", "searchJMBG.php?q=" + jmbgFiledForFinding.value, true);
  xmlhttp.send();
});

document.querySelector('[data-razred="1"]').addEventListener("click", () => {
  currentSection = fun.swapSections(sections, currentSection, fun.NEXT());
});
function razredUpisa(x) {
  document.getElementById("razred-koji-upisuje").value = x;
}
// todo: needs cleaning
for (let razred = 2; razred <= 4; razred++) {
  document
    .querySelector(`[data-razred="${razred}"]`)
    .addEventListener("click", () => {
      fun.showElement("insertJMBG");
      fun.hideElement(sections[currentSection]);
      razredUpisa(razred);
    });
}

function Test() {
  let test = {
    ime: "Slaven",
    prezime: "Đervida",
    brtel: "066 887-516",
    mail: "slavendjervida@gmail.com",
    jmbg: "3112002160017",
    rodenjdan: "2002-12-31",
    mestorodjenja: "Prijedor, Prijedor, RS, BiH",
    adresa: "Gradina bb",
    imeMajke: "Anđelka",
    prezimeMajke: "Đervida",
    zanimanjeMajke: "Programer",
    telMajke: "066 059-176",
    adresaMajke: "Gradina bb",
    imeo: "Predragr",
    prezo: "Đervida",
    zano: "Električar",
    telo: "065 659-005",
    adresao: "Gradina BB",
  };

  let ids = [
    "ime",
    "prezime",
    "telefon",
    "mail",
    "jmbg",
    "datum-rodjenja",
    "mesto_rodjenja",
    "adresa",
  ];
}

addEventListener("keydown", (e) => {
  if (e.key === "Enter") {
    return false;
  }
  if (e.key === "Escape") {
    document.activeElement.blur();
    return;
  }
  if (document.activeElement.tagName !== "BODY") return;
  if (e.key == "ArrowLeft") previousPage();
  if (e.key == "ArrowRight") nextPage();
});

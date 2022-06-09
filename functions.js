const NEXT = (value = 1) => value;
const PREVIOUS = (value = -1) => value;
const MAX_DAYS_IN_MONTH = 31,
  LAST_MONTH = 12,
  messages = {
    jmbgNotFound: "Nije validan JMBG.",
    classNotSelected: "Moraš izabrati razred.",
    mansQustionForVuk:
      "Da li si vukovac, tj. da li si od 6. do 9. razreda imao sve petice?",
    womansQustionForVuk:
      "Da li si vukovac, tj. da li si od 6. do 9. razreda imala sve petice?",
  };
let gender = "man";
function hideElement(element) {
  document.getElementById(element).style.display = "none";
}
function showElement(element) {
  document.getElementById(element).style.display = "flex";
}
// todo: needs cleaning
function showTip() {
  document.getElementById("tip").style.display = "grid";
  document
    .querySelectorAll("#buttons")
    .forEach((btns) => (btns.style.display = "none"));
}
function hideTip() {
  document.getElementById("tip").style.display = "none";
  document
    .querySelectorAll("#buttons")
    .forEach((btns) => (btns.style.display = "flex"));
}

function IsjmbgValidator(jmbg) {
  const day = +`${jmbg[0]}${jmbg[1]}`,
    month = +`${jmbg[2]}${jmbg[3]}`,
    year = +`2${jmbg[4]}${jmbg[5]}${jmbg[6]}`,
    genderNumber = `${jmbg[9]}${jmbg[10]}${jmbg[11]}`,
    indicatior = +`${jmbg[12]}`;

  let suma = 0,
    multipler = 7;
  for (let i = 0; i < jmbg.length - 1; i++) {
    suma += multipler-- * Number(jmbg[i]);
    if (multipler == 1) multipler = 7;
  }

  let model = suma % 11;
  if (
    day <= MAX_DAYS_IN_MONTH &&
    month <= LAST_MONTH &&
    (model == indicatior || indicatior == 11 - model)
  ) {
    console.log(genderNumber);
    gender = genderNumber > 499 ? "woman" : "man";
    document.getElementById("vuk-title").innerText =
      gender === "man"
        ? messages.mansQustionForVuk
        : messages.womansQustionForVuk;
    document.getElementById("datum-rodjenja").value = `${year}-${month}-${day}`;
    document
      .querySelectorAll(".ocene-title")
      .forEach(
        (title) =>
          (title.innerText =
            gender === "man"
              ? `Označi koje si ocjene imao iz pojedinih predmeta u ${title.dataset["razred"]}. razredu.`
              : `Označi koje si ocjene imala iz pojedinih predmeta u ${title.dataset["razred"]}. razredu.`)
      );
    document.getElementById("kad-si-roden-a").innerText =
      gender === "man" ? "Kad si rođen:" : "Kad si rođena:";
    document.getElementById("gde-si-rodjen-a").innerText =
      gender === "man"
        ? "Gdje si rođen (u kom mjestu, opštini, entitetu i državi):"
        : "Gdje si rođena (u kom mjestu, opštini, entitetu i državi):";
    document.getElementById("detalji-za-izborni").innerText =
      gender === "man"
        ? "U srednjoj školi možeš da nastaviš da učiš vjeronauku koju si imao u osnovnoj školi, a možeš da ga zamijeniš novim predmetom koji se zove Kultura religija, koji ćeš imati u 1. i 2. razredu, a u 3. i 4. ga zamjenjuje etika. Imaj u vidu da, šta god da odabereš, to učiš naredne 3 ili 4 godine u zavisnosti od smjera kojeg upišeš."
        : "U srednjoj školi možeš da nastaviš da učiš vjeronauku koju si imala u osnovnoj školi, a možeš da ga zamijeniš novim predmetom koji se zove Kultura religija, koji ćeš imati u 1. i 2. razredu, a u 3. i 4. ga zamjenjuje etika. Imaj u vidu da, šta god da odabereš, to učiš naredne 3 ili 4 godine u zavisnosti od smjera kojeg upišeš.";

    document.getElementById("smer-1-title").innerText =
      gender === "man"
        ? 'Ako se slučajno desi da ne "upadneš" u gornji smjer, da li bi možda želio da se upišeš u neki drugi smjer u našoj školi?'
        : 'Ako se slučajno desi da ne "upadneš" u gornji smjer, da li bi možda željela da se upišeš u neki drugi smjer u našoj školi?';

    return true;
  }

  return false;
}
function isClassCheked() {
  const classes = document.querySelectorAll(".razred");
  let res = false;
  classes.forEach((checkbox) => {
    if (checkbox.checked === true) res = true;
  });
  return res;
}
// todo: needs fixing/reformating
function edgeCases(sections, currentSection, step) {
  if (!(0 <= currentSection + step && currentSection + step < sections.length))
    return false;
  if (!isClassCheked()) {
    alert(messages.classNotSelected);
    return false;
  }
  const section = sections[currentSection],
    nextSection = sections[currentSection + step];
  if (
    section === "tvoj-jmbg" &&
    IsjmbgValidator(document.getElementById("jmbg").value) === false
  ) {
    alert(messages.jmbgNotFound);
    return false;
  }
  if (
    section === "uvod" &&
    document.querySelector("[data-razred='1']").checked === false
  ) {
    showElement("insertJMBG");
    return false;
  }
  hideElement("smorio-se");
  showElement("back");
  showElement("next-button");
  hideElement("prijavi-se-button");
  if (
    ["jezik-ver", "svedocansto-9", "Majka", "otac"].indexOf(nextSection) > -1
  ) {
    showElement("smorio-se");
  }

  if (nextSection === "staratelj") {
    hideElement("next-button");
    showElement("prijavi-se-button");
  }

  if (nextSection === "uvod") {
    hideElement("back");
  }
  for (let i = 6; i <= 9; i++) {
    console.log(
      section,
      document.querySelectorAll(`#ocene-${i} input[type=radio]:checked`).length,
      document.querySelectorAll(`#ocene-${i} .ocena-5`).length
    );
    if (
      section === `ocene-${i}` &&
      document.querySelectorAll(`#ocene-${i} input[type=radio]:checked`)
        .length !== document.querySelectorAll(`#ocene-${i} .ocena-5`).length
    ) {
      alert("Moraš označini sve ocjene");
      return false;
    }
  }

  return true;
}

function updateProgressBar(sections, currentSection) {
  document.getElementById("progress-bar").style.width = `${
    (currentSection / sections.length) * 100
  }%`;
}

function swapSections(sections, currentSection, step) {
  if (edgeCases(sections, currentSection, step) === false)
    return currentSection;
  hideElement(sections[currentSection]);
  currentSection += step;
  showElement(sections[currentSection]);
  updateProgressBar(sections, currentSection);
  return currentSection;
}

export {
  hideElement,
  showElement,
  showTip,
  hideTip,
  NEXT,
  PREVIOUS,
  swapSections,
};

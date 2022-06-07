const NEXT = (value = 1) => value;
const PREVIOUS = (value = -1) => value;
const MAX_DAYS_IN_MONTH = 31,
  LAST_MONTH = 12,
  messages = {
    jmbgNotFound: "Nije validan JMBG.",
    classNotSelected: "Moraš izabrati razred.",
  };

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
    .querySelectorAll(".buttons")
    .forEach((btns) => (btns.style.display = "none"));
}
function hideTip() {
  document.getElementById("tip").style.display = "none";
  document
    .querySelectorAll(".buttons")
    .forEach((btns) => (btns.style.display = "flex"));
}

function IsjmbgValidator(jmbg) {
  const day = +`${jmbg[0]}${jmbg[1]}`,
    month = +`${jmbg[2]}${jmbg[3]}`,
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
  )
    return true;
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
  if (!(0 < currentSection + step && currentSection + step < sections.length))
    return false;
  if (!isClassCheked()) {
    alert(messages.classNotSelected);
    return false;
  }
  const section = sections[currentSection];
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

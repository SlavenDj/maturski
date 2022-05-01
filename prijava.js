const sections = [
    "smer",
    "vuk",
    "podaci-ucenika",
    "jezik-ver",
    "svedocansto-9",
    "Majka",
    "otac",
    "ocene-6",
    "ocene-7",
    "ocene-8",
    "ocene-9"
]
let currentSection = 0;
addEventListener("load", () => {
    show(sections[currentSection]);
})
function hide(e) {
    const obrazac = document.querySelector(`#${e}`);
    obrazac.style.display = "none";
}
function show(e) {
    const obrazac = document.querySelector(`#${e}`);
    obrazac.style.display = "flex";
}

const btnsForNext = document.querySelectorAll(".next");
btnsForNext.forEach((btn) => {
    btn.addEventListener("click", () => {
        hide(sections[currentSection])
        currentSection++;
        show(sections[currentSection]);
    })
})

addEventListener("keydown", e=>{
    if(e.key==="Escape")
    document.activeElement.blur();
    
    if(document.activeElement.tagName !== "BODY")
    return;
    if(e.key=="ArrowLeft" && currentSection){
        hide(sections[currentSection])
        currentSection--;
        show(sections[currentSection]);
    }
    if(e.key=="ArrowRight" && currentSection+1 < sections.length){
        hide(sections[currentSection])
        currentSection++;
        show(sections[currentSection]);
    }
    
})

const btnsForBack = document.querySelectorAll(".back");
btnsForBack.forEach((btn) => {
    btn.addEventListener("click", () => {
        hide(sections[currentSection])
        currentSection--;
        show(sections[currentSection]);
    })
})

const checkBoxes_smer = document.querySelectorAll("input[name^='smer-']");
checkBoxes_smer.forEach(checkBox => {
    checkBox.parentElement.parentElement.addEventListener("click", e => {
        //e.preventDefault();
        const currentCheckbox = e.target.parentElement.querySelector("input[name^='smer-']")
        currentCheckbox.checked = true;


    })


});
function showTip() {
    document.querySelector("#tip").style.display = "grid";
}
function hideTip() {
    document.querySelector("#tip").style.display = "none";
}
const tipBtn = document.querySelector("#show-tip");
tipBtn.addEventListener("click", showTip)

document.querySelector("#tip").addEventListener("click", hideTip);
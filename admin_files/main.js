function showForm(e){
    console.log("remove")
}
function showFormMod(e){
    console.log("rename", e.target)
}
const rmBtns= document.querySelectorAll(".delete");
const modBtns= document.querySelectorAll(".edit");


rmBtns.forEach((btn)=>{
    btn.addEventListener("click", showForm);
})
modBtns.forEach((btn)=>{
    btn.addEventListener("click", (e)=>{
        console.log(e.target.dataset["id"])
        

    });
})
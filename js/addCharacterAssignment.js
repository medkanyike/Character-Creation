const characterbttns = document.getElementsByClassName("character_bttn")
const alreadyAdded = document.getElementById("alreadyAdded");
const notSelected = document.getElementById("notSelected");
const toUpload = [];
const alreadySelected = [];
const remaining_characters = document.getElementById("remaining_characters");
const uploadbttn = document.getElementById("add_assignment");
const sample_dateTime = document.getElementById("sample_dateTime");
const character_ids = document.getElementById("character_ids");
// window.onload = () =>{
//     sample_dateTime.innerText = new Date now(1995, 11, 17, 13, 24);
// }
for (let i = 0; i < characterbttns.length; i++) {
    const element = characterbttns[i];
    element.addEventListener("click",(element)=>{
        alreadySelected.push(element.target.name);
        toUpload.push(element.target.id)

        alreadyAdded.innerHTML = alreadySelected;
        const character = document.getElementById(element.target.id)
        character.classList.add("removeFromDisplay");
        remaining_characters.innerHTML = 8 - alreadySelected.length
        character_ids.value = toUpload;

        if(remaining_characters.innerHTML == 0){
            notSelected.classList.add("removeFromDisplay");
            console.log(alreadySelected)
            console.log(toUpload);
        }
    });
    
}

uploadbttn.addEventListener('click',(e)=>{
    e.preventDefault();
    const sDateTime = document.querySelector("#startdateTime").value;
    const eDateTime = document.querySelector("#enddateTime").value;
    const assignment_name = document.querySelector("#assignment_id").value;
    const teacher_id = document.getElementById("teacher_id").value;
    let actualstartDateTime = Date.now(sDateTime)
    let actualendDateTime = Date.now(eDateTime);
    
    //create a form and add data to it 
    var aform = new FormData();
    aform.append("startdateTime",actualstartDateTime);
    aform.append("enddateTime",actualendDateTime)
    aform.append("character_ids",character_ids.value);
    aform.append("assignment_name",assignment_name)
    aform.append("teacher_id",teacher_id);


    //empty the input field
    sDateTime.value = "";
    eDateTime.value = "";
    assignment_name.value = "";
    
  
    // for (var value of aform.values()) {
    //   console.log(value);
    // }
    // for (var key of aform.keys()) {
    //   console.log(key);
    // }
    //submit the form
    var request = new XMLHttpRequest();
    request.open("POST", "./processes/addassignment.php");
    request.send(aform);
   
})
const characterbttns = document.getElementsByClassName("character_bttn")
const alreadyAdded = document.getElementById("alreadyAdded");
const notSelected = document.getElementById("notSelected");
var toUpload = [];
var alreadySelected = [];
const remaining_characters = document.getElementById("remaining_characters");
const uploadbttn = document.getElementById("add_assignment");
const sample_dateTime = document.getElementById("sample_dateTime");
// const character_ids = document.getElementById("character_ids");
// window.onload = () =>{
//     sample_dateTime.innerText = new Date now(1995, 11, 17, 13, 24);
// }
for (let i = 0; i < characterbttns.length; i++) {
    const element = characterbttns[i];
    element.addEventListener("click",(element)=>{
        alreadySelected.push(element.target.name.toString());
        toUpload.push(element.target.id)

        alreadyAdded.innerHTML = alreadySelected;
        const character = document.getElementById(element.target.id)
        character.classList.add("removeFromDisplay");
        remaining_characters.innerHTML = 8 - alreadySelected.length
        character_ids.value = toUpload;

        if(remaining_characters.innerHTML == 0){
            notSelected.classList.add("removeFromDisplay");
            // console.log(alreadySelected)
            // console.log(toUpload);
        }
    });
    
}

uploadbttn.addEventListener('click',(e)=>{
    e.preventDefault();
    const sDateTime = document.getElementById("start_dateTime");
    const eDateTime = document.getElementById("end_dateTime");
    const assignment_n = document.querySelector("#assignment_id");
    const teacher_id = document.getElementById("teacher_id").value;
    let actualstartDateTime = sDateTime.value;
    let actualendDateTime = eDateTime.value;
    let assignment_name = assignment_n.value;


    ///check if some input fields are still empty 
    if(actualendDateTime== "" || actualstartDateTime == "" || assignment_name== ""){
      var error = document.getElementById("error_assignment");
      error.innerHTML = 
      `
      <h5>Some fields where submitted while empty</h5>
      `
    }else{
      //now submit the form //create a form and add data to it 
    var aform = new FormData();
    aform.append("startdateTime",actualstartDateTime);
    aform.append("enddateTime",actualendDateTime)
    aform.append("character_names", alreadySelected);
    aform.append("assignment_name",assignment_name)
    aform.append("teacher_id",teacher_id);
    
    //now submit 
    var request = new XMLHttpRequest();
    request.open("POST", "./processes/addassignment.php");
    request.send(aform);
    }

   
///display again the character for the next submission of the assignment
    for (let i = 0; i < characterbttns.length; i++) {
      characterbttns[i].classList.remove("removeFromDisplay");
    }

    //empty the input field
    sDateTime.value = "";
    eDateTime.value = "";
    assignment_n.value = "";
    alreadySelected.length = 0;
    remaining_characters.innerHTML = 8
    alreadyAdded.innerHTML = ""; 
    
    

    
   
})
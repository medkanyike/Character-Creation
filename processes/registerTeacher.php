<?php
include 'connection.php';

$firstname = chop($_POST['firstname']);
$lastname = $_POST['lastname'];
$email = $_POST['email'];

//first generate the usercode 
/*the usercode is generated depending on a random 
number and set of characters from both the teacherz firstname and lastname */

$firstname_first_character = substr($firstname, 0, 1);
$lastname_first_character = substr($lastname, 0, 1);
$lastname_second_character = substr($lastname, 1, 1);

function insertIntoTable(){
    global $connection,$firstname_first_character, $lastname_first_character,$lastname_second_character;
    $code =  $firstname_first_character . $lastname_first_character . rand(100, 500) . $lastname_second_character;
    //if the usercode is already taken then regenerate another usercode
    $sql = "SELECT * FROM users WHERE usercode = '$code';";
    $result = mysqli_query($connection, $sql);
    if(mysqli_num_rows($result)>0){
        //call the same function to generate a different value
    }else{
        //just add the teacher
        //the usercode to the teacher via email
    }

}



$sql = "SELECT * FROM users WHERE usercode = '$code';";
$result = mysqli_query($connection,$sql);


?>
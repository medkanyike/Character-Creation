<?php
include 'connection.php';

$firstname = chop($_POST['firstname']);
$lastname = chop($_POST['lastname']);
$email = chop($_POST['email']);
if(empty($firstname)||empty($email)||empty($lastname))
{
    header('location:.\../adminPage.php?error="emptyFields"');
}else{
    //first generate the usercode 
    /*the usercode is generated depending on a random 
    number and set of characters from both the teacherz firstname and lastname */

    $firstname_first_character = substr($firstname, 0, 1);
    $lastname_first_character = strtoupper(substr($lastname, 0, 1));
    $lastname_second_character = substr($lastname, 1, 1);

    function insertIntoTable(){
        global $connection,$firstname_first_character, $lastname_first_character,$lastname_second_character;
        global $firstname,$lastname,$email;
        $usercode =  $firstname_first_character . $lastname_first_character . rand(100, 500) . $lastname_second_character;
        //if the usercode is already taken then regenerate another usercode
        $sql = "SELECT * FROM users WHERE usercode = '$usercode';";
        $result = mysqli_query($connection, $sql);
        if(mysqli_num_rows($result)>0){
            //call the same function to generate a different value
            insertIntoTable();
           
        }else{
            //just add the teacher
            //the usercode to the teacher via email
            $to      = $email;
            $subject = 'Teacher Character creation usercode';
            $message = 'Use this usercoder'.$usercode. ' for logining in';
            $headers = 'From: kinderCharacter@gmail.com' . "\n" ;

            mail($to, $subject, $message, $headers);
            $sql = "INSERT INTO users(username, firstname, lastname, usercode, passwrd, email) 
            VALUES ('$usercode','$firstname','$lastname','$usercode','$usercode','$email');";
            mysqli_query($connection,$sql);
            header("Location:.\../adminPage.php?error='Sucessfully added'");
        }

    }
    insertIntoTable();
}
?>
<?php
include "connection.php";

if(isset($_POST['register'])){

    $firstName = $_POST['firstname'];
    $lastName = $_POST['lastname'];
    $contact = $_POST['contact'];
    $usercode = "pup";

     $sql = "INSERT INTO pupils(firstname,lastname,contact,usercode)
      VALUES
      ('$firstName','$lastName','$contact','$usercode');";
      mysqli_query($connection,$sql);
      header("Location.\../teacherPage.php?error=no");
}else{
    echo 'go back ';
}
?>
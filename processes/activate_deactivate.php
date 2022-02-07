<?php
include './connection.php';

$usercode = $_POST['usercode'];
if(isset($_POST['Deactivate'])){
    
    //change the user status in the file to deactivated as well as in the database 
    //update the files
    $contents = file_get_contents(".\../textfiles/pupils.txt");
    $line = "$usercode activated .\../textfiles/assignments/$usercode.txt";
    $contents = str_replace($line, "$usercode deactivated .\../textfiles/assignments/$usercode.txt", $contents);
    file_put_contents(".\../textfiles/pupils.txt", $contents);
    //also update the database
    $sql = "UPDATE pupils SET status='deactivated' WHERE usercode = '$usercode';";
    mysqli_query($connection,$sql);
    header("Location:.\../ViewPupils.php");

}elseif (isset($_POST['Activate'])) {
    //change the user status in the file to deactivated as well as in the database 
    //update the files
    $contents = file_get_contents(".\../textfiles/pupils.txt");
    $line = "$usercode deactivated .\../textfiles/assignments/$usercode.txt";
    $contents = str_replace($line, "$usercode activated .\../textfiles/assignments/$usercode.txt", $contents);
    file_put_contents(".\../textfiles/pupils.txt", $contents);
    //also remove the usercode from the request list
    $contents1 = file_get_contents(".\../c/activation/requests.txt");
    $line = "$usercode";
    $contents = str_replace($line,"",$contents);
    file_put_contents(".\../c/activation/requests.txt", $contents);

    //also update the database
    $sql = "UPDATE pupils SET status='activated' WHERE usercode = '$usercode';";
    mysqli_query($connection, $sql);
    header("Location:.\../ViewPupils.php");
}


















?>
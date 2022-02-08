<?php
include './connection.php';

$usercode = $_POST['usercode'];
if(isset($_POST['Deactivate'])){
    
    //change the user status in the file to deactivated as well as in the database 
    //update the files
    $contents = file_get_contents(".\../textfiles/pupils.txt");
    $line = "$usercode activated .\../textfiles/assignments/$usercode.txt .\../textfiles/attempts/$usercode.txt";
    $contents = str_replace($line, "$usercode deactivated .\../textfiles/assignments/$usercode.txt .\../textfiles/attempts/$usercode.txt", $contents);
    file_put_contents(".\../textfiles/pupils.txt", $contents);
    //also update the database
    $sql = "UPDATE pupils SET status='deactivated' WHERE usercode = '$usercode';";
    mysqli_query($connection,$sql);
    header("Location:.\../ViewPupils.php");

}elseif (isset($_POST['Activate'])) {
    //change the user status in the file to deactivated as well as in the database 
    //update the files
    $contents0 = file_get_contents(".\../textfiles/pupils.txt");
    $line0 = "$usercode deactivated .\../textfiles/assignments/$usercode.txt .\../textfiles/assignments/$usercode.txt";
    $contents0 = str_replace($line0, "$usercode activated .\../textfiles/assignments/$usercode.txt .\../textfiles/assignments/$usercode.txt", $contents0);
    file_put_contents(".\../textfiles/pupils.txt", $contents0);
    //also remove the usercode from the request list
    $contents1 = file_get_contents(".\../c/activation/requests.txt");
    $line1 = "$usercode";
    $contents1 = str_replace($line1,"",$contents1);
    file_put_contents(".\../c/activation/requests.txt", $contents1);

    //also update the database
    $sql = "UPDATE pupils SET status='activated' WHERE usercode = '$usercode';";
    mysqli_query($connection, $sql);
    header("Location:.\../ViewPupils.php");
}


















?>
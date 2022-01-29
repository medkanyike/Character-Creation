<?php
include 'connection.php';
if (isset($_POST['change_bttn'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $usercode = $_POST['usercode'];
    if(empty($username)||empty($password)){
        header("Location:Location:.\../teacherPage.php?error='emptyFields'");
    }else
    {
        $sql = "UPDATE users SET username='$username', passwrd='$password' WHERE usercode = '$usercode';";
        mysqli_query($connection,$sql);
        session_start();
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
        header('Location:.\../teacherPage.php?error="changed"');
    }
}else{
    header("Location:.\../index.php " );
}



?>
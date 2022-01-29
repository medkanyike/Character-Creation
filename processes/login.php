<?php
include 'connection.php';

if(isset($_POST['login_bttn'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    if(empty($password)|| empty($username)){
        header("Location:.\../index.php?error='emptyFields'");
    }else{
        $sql = "SELECT * FROM users WHERE username = '$username' AND passwrd= '$password';";
        $result = mysqli_query($connection,$sql);
        if(mysqli_fetch_array($result)>0){
            if($username == 'admin'){ 
                session_start();
                $_SESSION['username'] = $username;
                $_SESSION['password'] = $password;
                header("Location:.\../adminPage.php");
            }else{
                session_start();
                $_SESSION['username'] = $username;
                $_SESSION['password'] = $password;
                header("Location:.\../teacherPage.php");
            }
        }else{
            header("Location:.\../index.php?error='passwordNotMatching'");
        }
    }

}else{
    header("Location:.\../index.php?rror='loginPage'");
}

?>
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
                ///since this is a teacher check the request file and upload all the requests for activation
                $usercode_requests = file('.\../c/activation/requests.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
                //change every pupil status to requested
                foreach ($usercode_requests as $req_num => $usercode_request) {
                    ///update the status to requested
                    $sql = "UPDATE pupils SET status='requested' WHERE usercode = '$usercode_request';";
                    mysqli_query($connection,$sql);
                }

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
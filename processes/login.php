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

                ///upload the student assignments to database for easy access and commenting
                //this should be done for every pupil
                ///select all the pupil and check wether has the file of attempts
                $sql3 = "SELECT * FROM pupils";
                $result3 = mysqli_query($connection,$sql3);
                if(mysqli_num_rows($result3)>0){
                    while($row = mysqli_fetch_assoc($result3)){
                        $usercode = $row['usercode'];
                        $ext = ".txt";
                        $filename = ".\../textfiles/attempts/$usercode$ext";
                        if(file_exists($filename)){
                            ///fetch all the lines as well as the contents
                            $contents = file_get_contents($filename);
                            $lines = explode("\n", $contents);
                            foreach ($lines as $line) {
                                $values = explode(" ", $line);
                                $a_id = $values[0] ;
                                $date = $values[1];
                                $score = $values[2];
                                $time = $values[3];
                                $comment = $values[4];
                                if(!empty($a_id)||!empty($date)||!empty($time)){
                                    ///the assignment_id should be inserted once for every pupil
                                    $sql5 = "SELECT * FROM attempts WHERE usercode ='$usercode' AND assignment_id = '$a_id';";
                                    $result5 = mysqli_query($connection, $sql5);
                                    if (mysqli_num_rows($result5) <= 0) {
                                        $sql4 = "INSERT INTO attempts(usercode,assignment_id,dateWorkdone,score,totaltime,comment) 
                               VALUES('$usercode','$a_id','$date','$score','$time','$comment');";
                                        mysqli_query($connection, $sql4);
                                    }
                                }

                            }
                            

                        }
                        
                    }
                }
                ///ends here
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
<?php
include 'connection.php';



if(isset($_POST['add_comment'])&& !empty($_POST['comment'])){
    ///get the details about the attempt
    $attempt_id = $_POST['attempt_id'];
    $comment = $_POST['comment'];
    $sql = "SELECT * FROM attempts WHERE id = '$attempt_id';";
    $result = mysqli_query($connection,$sql);
    while($row = mysqli_fetch_assoc($result)){
        $usercode = $row['usercode'];
        $a_id = $row['assignment_id'];
        $date = $row['dateWorkdone'];
        $time = $row['totaltime'];
        $score = $row['score'];
        $formated_score = sprintf("%.2f",$score);
        
        ///71 1644157730 100.00 17 - 
        ///add the comment to the pupils file and later to the databsse
        $ext = '.txt';
        $contents = file_get_contents(".\../textfiles/attempts/$usercode$ext");
        $line = "$a_id $date $formated_score $time - ,";
        $contents = str_replace($line, "$a_id $date $formated_score $time $comment ,", $contents);
        file_put_contents(".\../textfiles/attempts/$usercode$ext", $contents);
        
        ///update the database as well
        $sql5 = "UPDATE attempts SET comment = '$comment' WHERE id = '$attempt_id';";
        mysqli_query($connection, $sql5);
    }
    
    ///go to the comment page
    header("Location:.\../performance.php?added");
}else{
    header("Location:.\../teacherPage.php");
}
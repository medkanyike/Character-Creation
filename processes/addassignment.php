<?php
include 'connection.php';


$endDateTime = $_POST['enddateTime'];
$startDateTime = $_POST['startdateTime'];
$character_names = explode(',', $_POST['character_names']);
$assignment_name = $_POST['assignment_name'];
$teacher_id = $_POST['teacher_id'];

if(empty($endDateTime)||empty($startDateTime)||empty($assignment_name)){
    header("Location:.\../teacherPage.php?error='emptyFields'");
}else{
//first create the assignment
if($connection == TRUE){
    $sql = "INSERT INTO assignments(assignment_name,teacher_id,startTime,endTime)
     VALUES('$assignment_name','$teacher_id','$startDateTime','$endDateTime');";
    mysqli_query($connection,$sql);
    $last_assignment_id = mysqli_insert_id($connection);

    foreach ($character_names as $character_name) {
        $sql1 = "INSERT INTO character_assignment(assignment_id,character_name)
    VALUES ('$last_assignment_id','$character_name');";
        mysqli_query($connection, $sql1);
    }

    //add the assignment to each pupils text files
    $sql = "SELECT usercode FROM pupils";
    $result = mysqli_query($connection,$sql);
    if(mysqli_num_rows($result)>0){
        while($row = mysqli_fetch_assoc($result)){
                //fetch the pupil file
                $ext = ".txt";
                $filename = $row['usercode'] . $ext;
                $file1 = ".\../textfiles/assignments/" . $filename;
                $current1 = file_get_contents($file1);
                //add assignment details
                $current1 .= $last_assignment_id . "\t";
                // for fetching the right format for time
                $sql4 = "SELECT * FROM assignments WHERE assignment_id = '$last_assignment_id';";
                $result4 = mysqli_query($connection,$sql4);
                while($row = mysqli_fetch_assoc($result4)){
                    $current1 .= $row['startTime'] . "\t";
                    $current1 .= $row['endTime'] . "\t";
                }
               


                foreach ($character_names as $character_name) {
                        $current1 .= $character_name . "\t";
                }
                ///after adding the characters add the -- for the remaining characters
                for ($i=0; $i < 8 - count($character_names); $i++) {
                    $current1 .= '-' . "\t";
                }
                $current1 .= "\n";
                file_put_contents($file1, $current1);
                fclose($file1);
        }
    }
   
}else{
    echo 'Connection not valid';
}

}
?>
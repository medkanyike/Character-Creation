<?php
include 'connection.php';


$endDateTime = $_POST['actualendDateTime'];
$startDateTime = $_POST['actualstartDateTime'];
$characterids = explode(',', $_POST['character_ids']);
$assignment_name = $_POST['assignment_name'];
$teacher_id = $_POST['teacher_id'];

//first create the assignment
if($connection == TRUE){
    $sql = "INSERT INTO assignments(assignment_name,teacher_id)
     VALUES('$assignment_name','$teacher_id');";
    mysqli_query($connection,$sql);
    $last_assignment_id = mysqli_insert_id($connection);

///possible error here
    for ($i=1; $i < sizeof($characterids); $i++) {
        $character_id = $characterids[$i];
         $sql = "INSERT INTO character_assignment(assignment_id,character_id)
         VALUES ('$last_assignment_id',$character_id);";
         mysqli_query($connection,$sql);
   
         
    }
    
    // while ($a <= count($characterids)) {
    //     //insert each character into the table with respect to the assign
    //     $characterid = $characterids[$a];
    //     $sql = "INSERT INTO character_assignment(assignment_id,character_id)
    //      VALUES ('$last_assignment_id',$characterid) ;";
    //      mysqli_query($connection,$sql);
    //     $a++;
    // }

}else{
    echo 'Connection not valid';
}


?>
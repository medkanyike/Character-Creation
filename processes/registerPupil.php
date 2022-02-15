<?php
include 'connection.php';
$firstname = chop($_POST['firstname']);
$lastname = chop($_POST['lastname']);
$contact = chop($_POST['contact']);

if(isset($_POST['register_bttn'])){
    if(empty($firstname)||empty($lastname)||empty($contact)){
        header("Location:.\../registerPupil.php?error='emptyFields'");
    }else{
        //generate a unique usercode for each student
        $firstname_first_character = substr($firstname, 0, 1);
        $lastname_first_character = strtoupper(substr($lastname, 0, 1));
        $lastname_second_character = substr($lastname, 1, 1);

        function addPupil()
        {
            global $connection, $firstname_first_character, $lastname_first_character, $lastname_second_character;
            global $firstname, $lastname, $email, $contact;
            $usercode =  $firstname_first_character . $lastname_first_character . rand(700,2000) . $lastname_second_character;
            //if the usercode is already taken then regenerate another usercode
            $sql = "SELECT * FROM pupils WHERE usercode = '$usercode';";
            $result = mysqli_query($connection, $sql);
            if (mysqli_num_rows($result) > 0) {
                //call the same function to generate a different value
                addPupil();
            } else {
                $sql = "INSERT INTO pupils(firstname, lastname, contact ,usercode) 
                VALUES ('$firstname','$lastname','$contact','$usercode');";
                //add pupil usercode to the pupils files that contains all the usercodes
                mysqli_query($connection,$sql);
                $file = '.\../textfiles/pupils.txt';
                $ext = ".txt";
                // Open the file to get existing content
                $current = file_get_contents($file);
                // Append a new person to the file
                $current .= "$usercode activated .\../textfiles/assignments/$usercode.txt .\../textfiles/attempts/$usercode.txt \n";
               
                file_put_contents($file, $current);
                fclose($file);
                // Write the contents back to the file

                //-------//Create text fies for each pupil containing the previous assignments
                //later every assignment that will be  uploadded will be append to each pupil textfiles

                $ext = ".txt";
                $filename = $usercode . $ext;
                $file1 = ".\../textfiles/assignments/".$filename;
                $current1 = file_get_contents($file1);
                //fetch all assignments in the database and add the to the pupil's assignments
                $sql = "SELECT * FROM assignments";
                $result1 = mysqli_query($connection,$sql);
                ///depending on each id fetch the characters for the assignment
                if(mysqli_num_rows($result1) > 0){
                    $current1 = file_get_contents($file1);
                    //assignment id, name ,date and time start and end time , characters
                    
                    while($row = mysqli_fetch_assoc($result1)){
                        //fetch all the characters that belong to this assignment
                        $a_id = $row['assignment_id'];
                        $current1 .= $a_id . "\t";
                        $current1 .= $row['startTime'] . "\t";
                        $current1 .= $row['endTime'] . "\t";
                        // file_put_contents($file1, $current1);

                        ///more details about the assignment to be accessed from here
                        $sql = "SELECT character_name FROM character_assignment WHERE assignment_id = '$a_id';";
                        $result = mysqli_query($connection,$sql);
                        while($row = mysqli_fetch_assoc($result)){
                            $character = $row['character_name'];
                            $current1 .= $character . "\t";
                            // file_put_contents($file1, $current1);
                        }
                        for ($i = 0; $i < 8 - mysqli_num_rows($result); $i++) {
                            $current1 .= '-' . "\t";
                        }
                        //end the line with ,
                        $current1 .= "\n";
                       

                    }
                    file_put_contents($file1, $current1);
                }//if no the file will be updated later since its first created 

                //after adding the available assignments close the files
                fclose($file1);
               

                header("Location:.\../ViewPupils.php?error='added'");
            }
        }
        addPupil();
    }
}else{
    header("Location:.\../teacherPage.php");
}


?>
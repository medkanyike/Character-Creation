<?php
include 'header.php';
?>
<div id="middle_section">
    
        add assignment
        <div id="form_header">
            <p>Eight(8) characters should not be exceeded per assignment</p>
            Remaining with <span id="remaining_characters"></span>
        </div>
        <div id="alreadyAdded">
        </div>
        <div id="assignment_name">

            start DateTime:
            <p><input type="datetime-local" name="startdateTime" id="startdateTime" required="required"></p>
            End Datetime:
            <p>
                <input type="datetime-local" name="enddateTime" id="enddateTime" required="required">
                <input type="text" name="character_ids" id="character_ids" hidden>
            </p>
            <input type="text" name="assignment_name" id="assignment_id" placeholder="Enter assignment name" required="required">
        </div>
        <p>
            <input type="number" name="teacher_id" id="teacher_id" value='1' hidden>
            <input type="button" value="Upload Assignment" id="add_assignment">
        </p>
  
    <div id="notSelected">
        <?php
        include './processes/connection.php';
        $sql = "SELECT * FROM characters;";
        $result = mysqli_query($connection, $sql);
        $num = mysqli_num_rows($result);
        while ($row = mysqli_fetch_assoc($result)) {

            echo "<button class='character_bttn' name=" . $row['name'] . " id=" . $row['character_id'] . ">";
            echo $row['name'];
            echo "</button>";
        }
        ?>
    </div>
    <div id="added_assignments">
        <?php
        ///already added assignments
        // $sql = "SELECT * FROM assignments;";
        // $results = mysqli_query($connection,$sql);
        // if(mysqli_num_rows($result)){
        //     while($row = mysqli_fetch_assco){
                
        //     }
        // }
        ?>
    </div>
</div>
    <script src="./js/addCharacterAssignment.js"></script>
</body>

</html>
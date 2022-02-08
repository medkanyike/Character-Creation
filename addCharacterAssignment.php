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
        <div id="error_assignment"></div>
        start DateTime:
        <p><input type="datetime-local" name="end_dateTime" id="start_dateTime" required="required"></p>
        End Datetime:
        <p>
            <input type="datetime-local" name="end_dateTime" id="end_dateTime" required="required">
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
        $sql01 = "SELECT * FROM assignments ORDER BY assignment_id DESC";
        $result01 = mysqli_query($connection, $sql01);

        if (mysqli_num_rows($result01) > 0) {
            while ($row01 = mysqli_fetch_assoc($result01)) {
                $assignment_id = $row01['assignment_id'];
                $assignment_name = $row01['assignment_name'];

                echo
                '<p>
                ' . $assignment_id . ':
                ' . $assignment_name . '
                </p>';
                //fetch the characters for each assignment
                $sql02 = "SELECT character_name FROM character_assignment WHERE assignment_id = '$assignment_id';";
                $result02 = mysqli_query($connection, $sql02);
                //echo mysqli_num_rows($result02);
                while ($row02 = mysqli_fetch_assoc($result02)) {
                    echo $row02['character_name'];
                    echo ',';
                }
                echo '<br>';
                //count pupils that have so far attempted the assignment
                $sql03 = "SELECT * FROM attempts WHERE assignment_id = '$assignment_id';";
                $result03 = mysqli_query($connection, $sql03);
                echo 'Attempted by:';
                echo mysqli_num_rows($result03);
            }
        }
        ?>
    </div>
</div>
<script src="./js/addCharacterAssignment.js"></script>
</body>

</html>
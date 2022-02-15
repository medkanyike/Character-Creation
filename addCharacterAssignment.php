<?php
include 'header.php';
?>
<div id="main_container">
    <?php
    include 'sideBar.php';
    ?>
    <div id="middle_section">
        <div id="middle_section1">
            <div id="add__assignment">Add assignment </div>
            <div id="form_header">
                <p id="instructions">Eight(8) characters should not be exceeded per assignment</p>
                <div id="alreadyAdded"></div>

            </div>
            <div id="assignment_toAdd">
                <span>Remaining with</span>
                <p id="remaining_characters">
                </p>
                <div id="error_assignment"></div>
                start DateTime:
                <p><input type="datetime-local" name="end_dateTime" id="start_dateTime" required="required"></p>
                <br>
                End Datetime:
                <p>
                    <input type="datetime-local" name="end_dateTime" id="end_dateTime" required="required">
                    <input type="text" name="character_ids" id="character_ids" hidden>
                </p>
                <input type="text" name="assignment_name" id="assignment_id" placeholder="Enter assignment name" required="required">
            </div>
            <p id="upload_bttn_section">
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
                <h3>already added assignment</h3>
                <form action="" method="post">
                    <input type="text" name="search_assignment_id" id="" placeholder="search by id">
                    <input type="submit" name="search_bbtn" value="Search">
                </form>
                <?php
                ///already added assignments
                if(isset($_POST['search_bbtn']) && !empty($_POST['search_bbtn'])){
                    ///search for the specific assignment
                    $search_assignment_id = $_POST['search_assignment_id'];
                    $sql01 = "SELECT * FROM assignments  WHERE assignment_id = '$search_assignment_id';";
                    $result01 = mysqli_query($connection, $sql01);

                    if (mysqli_num_rows($result01) > 0) {
                        while ($row01 = mysqli_fetch_assoc($result01)) {
                            $assignment_id = $row01['assignment_id'];
                            $assignment_name = $row01['assignment_name'];

                            echo

                            '
                            <div class="assignment">
                            <p>
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
                            echo '</br>';
                            echo '</div>';
                        }
                    }

                }else{
                    $sql01 = "SELECT * FROM assignments ORDER BY assignment_id DESC";
                    $result01 = mysqli_query($connection, $sql01);

                    if (mysqli_num_rows($result01) > 0) {
                        while ($row01 = mysqli_fetch_assoc($result01)) {
                            $assignment_id = $row01['assignment_id'];
                            $assignment_name = $row01['assignment_name'];

                            echo
                            
                            '
                            <div class="assignment">
                            <p>
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
                            echo'</br>';
                            echo '</div>';
                        }
                    }
                }
                ?>
                
            </div>
        </div>
    </div>
</div>
<script src="./js/addCharacterAssignment.js"></script>
</body>

</html>
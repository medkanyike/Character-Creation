<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/assigment.css">
</head>

<body>
    <form action="" method="post">
        add assignment
        <div id="form_header">
            <p>Eight(8) characters should not be exceeded per assignment</p>
            Remaining with <span id="remaining_characters"></span>
        </div>
        <div id="alreadyAdded">
        </div>
        <div id="assignment_name">


            <p id="sample_dateTime">
                Sample dateTime : 2022, 11, 17, 13, 24<br>
                <i>2022-year 11-month 17-date 13-hours 24-minutes</i>
            </p>

            start DateTime:
            <p><input type="datetime" name="startdateTime" id="startdateTime" required="required"></p>
            End Datetime:
            <p>
                <input type="datetime" name="enddateTime" id="enddateTime" required="required">
                <input type="text" name="character_ids" id="character_ids" hidden>
            </p>
            <input type="text" name="assignment_name" id="assignment_id" placeholder="Enter assignment name" required="required">
        </div>
        <p>
            <input type="number" name="teacher_id" id="teacher_id" value='1' hidden>
            <input type="submit" value="Upload Assignment" id="add_assignment">
        </p>
    </form>
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
    <script src="./js/addCharacterAssignment.js"></script>
</body>

</html>
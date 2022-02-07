<?php
include 'header.php';
?>

<div id="middle_section">
    <?php
    include './processes/connection.php';

    $sql = "SELECT * FROM users WHERE username != 'admin';";
    $result = mysqli_query($connection,$sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $usercode = $row['usercode'];
            $usercode = $row['usercode'];
            $firstname = $row['firstname'];
            $lastname = $row['lastname'];

            echo " $usercode    $firstname  $lastname  ";
            echo "<br>";
        }
    } else {
        echo 'No pupils registered yet';
    }
    ?>
</div>
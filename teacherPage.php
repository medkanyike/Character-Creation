<?php
include 'header.php'
?>
<div id="main_middle_section">
    <?php
    if (isset($_SESSION['username'])) {
        //if the username and password are still similar to the usercode
        //the teacher should be able to edit the password as well as the username
        if ($_SESSION['username'] == $_SESSION['password']) {
            //allow the teacher to change the password or username
            echo
            '
                <label>Change you username and password from here </label>
                 <form action="./processes/changePasswordEmail.php" method="post">
                    <label> Current username</label><br>
                    <input type="text" name="username" id="" placeholder=' . $_SESSION['username'] . '><br>
                    <label> Current password</label><br>
                    <input type="text" name="password" id="" placeholder=' . $_SESSION['username'] . '><br>
                    <input type="text" name="usercode" id="" value='. $_SESSION['username'].' hidden>
                    <br>
                    <input type="submit" value="Change" name="change_bttn">
                  </form>
                ';
        }
        include "addCharacterAssignment.php";
    } else {
        header("Location:./index.php");
    }

    ?>
</div>
<?php
include 'header.php';

?>
<div id="middle_section">
    <form action="./processes/registerPupil.php" method="post">
        <input type="text" name="firstname" id="" placeholder="student firstname" required=required><br>
        <input type="text" name="lastname" id="" placeholder="student lastname" required=required><br>
        <input type="text" name="contact" id="" placeholder="contact" required=required><br>
        <input type="submit" value="Register" name="register_bttn">
    </form>
</div>
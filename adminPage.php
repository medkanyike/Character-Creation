<?php
include 'header.php';
?>

<body>
    <div id="main_container">
        <?php
        include 'sideBar.php';
        ?>
        <div id="middle_section">
            <?php
            if (isset($_SESSION['username'])) {
                echo
                '
                <div id="registerTeacher">
                <label>Register teacher </label>
                <form action="./processes/registerTeacher.php" method="post">
                <input type="text" name="firstname" id="" placeholder="teacher firstname"><br>
                <input type="text" name="lastname" id="" placeholder=" teacher lastname"><br>
                <input type="email" name="email" id="" placeholder="teacher email"><br>
                <input type="submit" value="Register Teacher">
                </form>
                </div>
            ';
            } else {
                header("Location:./index.php");
            }

            ?>
        </div>

</body>
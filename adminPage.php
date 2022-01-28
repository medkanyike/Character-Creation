<?php
include 'header.php';
?>

<body>
    <div id="main_middle_section">
        <?php
        if (isset($_SESSION['username'])) {
            //if the username and password are still similar to the usercode
            //the teacher should be able to edit the password as well as the username
            $username = $_SESSION['username'];
            $password = $_SESSION['password'];
            if ($password == $username) {
                //allow the teacher to change the password or username
                echo
                '
                 <form action="" method="post">
                    <input type="firstname" name="" id="" >
                    <input type="lastname" name="" id="">
                    <input type="email" name="" id="">
                    <input type="submit" value="Register Teacher">
                  </form>
                ';
            }
        } else {
            header("Location:./index.php");
        }

        ?>
    </div>
   
</body>

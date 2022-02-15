<?php
include 'header.php';
include './processes/connection.php'
?>
<div id="main_container">
    <?php
    include 'sideBar.php';
    ?>
    <div id="middle_section">
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
                    <input type="text" name="usercode" id="" value=' . $_SESSION['username'] . ' hidden>
                    <br>
                    <input type="submit" value="Change" name="change_bttn">
                  </form>
                ';
            }
            // include "addCharacterAssignment.php";
            // include "registerPupil.php";
        } else {
            header("Location:./index.php");
        }

        ?>
        <div>
            <canvas id="myChart1"></canvas>
        </div>
        <?php
        ////add data to display
        $sql_1 = "SELECT * FROM pupils;";
        $result_1 = mysqli_query($connection, $sql_1);
        $numbers = mysqli_num_rows($result_1);
        ///assignments
        $sql_2 = "SELECT * FROM assignments;";
        $result_2 = mysqli_query($connection, $sql_2);
        $assignments = mysqli_num_rows($result_2);
        ///attempted assignments
        $sql_3 = "SELECT * FROM attempts;";
        $result_3 = mysqli_query($connection, $sql_3);
        $attempts = mysqli_num_rows($result_3);
        ////already commented
        $sql_4 = "SELECT * FROM attempts WHERE comment != '-';";
        $result_4 = mysqli_query($connection, $sql_4);
        $comments = mysqli_num_rows($result_4);

        echo '<input type="text" name="number_attempts" id="number_attempts" value= ' . $attempts . ' hidden>';
        echo '<input type="text" name="number_comments" id="number_comments" value= ' . $comments . ' hidden>';

        echo '<input type="text" name="number_pupils" id="number_pupils" value= ' . $numbers . ' hidden>';
        echo '<input type="text" name="number_assignments" id="number_assignments" value= ' . $assignments . ' hidden>';

        ?>
    </div>
</div>
<script>
    var number_pupils = document.getElementById("number_pupils").value;
    var number_comments = document.getElementById("number_comments").value;
    var number_attempts = document.getElementById("number_attempts").value;
    var number_assignments = document.getElementById("number_assignments").value;
    var xValues = ["Pupils", "Assignments", "attempts", "Commented"];
    var yValues = [number_pupils, number_assignments, number_attempts, number_comments];
    var barColors = ["red", "green", "blue", "orange"];


    new Chart("myChart1", {
        type: "bar",
        data: {
            labels: xValues,
            datasets: [{
                backgroundColor: barColors,
                data: yValues
            }]
        },
        options: {
            plugins: {
                title: {
                    display: true,
                    text: "Summarized records"
                },
                legend: {
                    labels: {
                        filter: (legendItem, data) => (typeof legendItem.text !== 'undefined')
                    }
                },

            },
            scales: {
                y: {
                    title: {
                        display: true,
                        text: 'Number'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'section'
                    }
                }
            }

        }
    });
</script>
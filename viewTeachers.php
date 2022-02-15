<?php
include 'header.php';
?>

<div id="main_container">
    <?php
    include 'sideBar.php';
    ?>
    <div id="middle_section">
        <?php
        include './processes/connection.php';

        $sql = "SELECT * FROM users WHERE username != 'admin';";
        $result = mysqli_query($connection, $sql);
        echo '
        <table id="teachersTable" class="display">
                <thead>
                    <tr>
                        <th>usercode</th>
                        <th>firstname</th>
                        <th>lastname</th>
                        <th>email</th>
                    </tr>
                </thead>
                <tbody>';
        if (mysqli_num_rows($result) > 0) {

            while ($row = mysqli_fetch_assoc($result)) {;
                $usercode = $row['usercode'];
                $firstname = $row['firstname'];
                $lastname = $row['lastname'];
                $email = $row['email'];
                echo '<tr>';
                echo " <td>$usercode  </td>  <td>$firstname</td>  <td>$lastname </td> <td>$email</td>";
                echo "</tr>";
            }
        } else {
            echo 'No pupils registered yet';
        }
        ?>
        </tbody>
        </table>
    </div>
    <script>
        $(document).ready(function() {
            $('#teachersTable').DataTable();
        });
    </script>
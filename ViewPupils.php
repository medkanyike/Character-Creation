<?php
include 'header.php';

?>
<div id="middle_section">
    <?php
    include './processes/connection.php';
    $sql = "SELECT * FROM pupils";
    $result = mysqli_query($connection, $sql);
    echo
    '
     <table>
        <thead>
            <tr>
                <td>Pupil usercode</td>
                <td>firstname</td>
                <td>lastname</td>
                <td>Status</td>
                <td>Actions</td>
            </tr>
        </thead>
        <tbody>
    ';
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $usercode = $row['usercode'];
            $firstname = $row['firstname'];
            $lastname = $row['lastname'];
            $status = $row["status"];
            echo "
             <tr>
                <td>
                $usercode   
                </td>
                <td>
                 $firstname
                </td> 
                <td>
                 $lastname 
                 </td>
                 <td>
                 $status
                 </td>";
                 echo "
                 <td>
                 ";
                 $status;
                 if ($status == 'requested'){
                     echo 
                     '
                    <form action="./processes/activate_deactivate.php" method="post">
                    <input type="text" name="usercode" id="" value='.$usercode.' hidden>
                    <input type="submit" value="Activate" name="Activate">
                    </form>
                     ';
                 }elseif ($status == 'activated'){
                     echo
                    '
                        <form action="./processes/activate_deactivate.php" method="post">
                        <input type="text" name="usercode" id="" value=' . $usercode . ' hidden>
                        <input type="submit" value="Deactivate" name="Deactivate">
                        </form>
                        ';
                 }
                 echo"
                 </td>
                
            </tr>
             ";
        }
    } else {
        echo 'No pupils registered yet';
    }
    echo '</tbody>';
    ?>
   
    </table>
</div>

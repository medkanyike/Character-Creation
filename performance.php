<?php
include 'header.php';
include './processes/connection.php';
?>

<body>
    <div id="middle_section">
        <!-- display pupil performance for commenting   -->
        <?php
        $sql = "SELECT * FROM attempts usercode;";
        $result = mysqli_query($connection, $sql);
        echo
        '
        <table>
            <thead>
                <tr>
                    <td>Assignemt id</td>
                    <td>Characters</td>
                    <td>Usercode</td>
                    <td>Done On</td>
                    <td>Score</td>
                    <td>TimeTaken</td>
                    <td>Comments</td>
                    <td>Actions</td>
                </tr>
            </thead>
            <tbody>
        ';
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $a_id = $row['assignment_id'];
                echo
                "
                <tr>
                   <td>".$row['assignment_id']."</td>
                   ";
                echo "<td>";
                $sql5 = "SELECT character_name FROM character_assignment WHERE assignment_id = '$a_id';";
                $result5 = mysqli_query($connection,$sql5);
                while ($row5 = mysqli_fetch_assoc($result5)){
                    echo $row5['character_name'];
                    echo ",";
                }
                echo "</td>";
                echo "
                    <td>".$row['usercode']."</td>
                    <td>".date('Y-m-d H:i:s', $row['dateWorkdone'])."</td>
                    <td>".$row['score']."</td>
                    <td>".$row['totaltime']."</td>
                    <form action='./processes/addcomment.php' method='POST'>";
               echo "<td>";
                        if ($row['comment'] == "-") {
                            echo '
                                <input type="text" name="comment" placeholder="Comment"/>
                                <input type="text" name="attempt_id" value='.$row["id"].' hidden />
                                ';
                        }else{
                            echo
                    $row['comment'];
                        }
                    
                echo "</td>
                    <td>";
                    if($row['comment'] == "-"){
                        echo'
                        <input type="submit" value="Add Comment" name="add_comment"/>
                        ';
                    }
                   
                echo "</td>
                    </form>
                <tr>
                ";
               
                echo '<br>';
            }
        }
        ?>
        </tbody>
        </table>
    </div>

</body>
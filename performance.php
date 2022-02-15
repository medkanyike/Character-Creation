<?php
include 'header.php';
include './processes/connection.php';
?>

<body>
    <div id="main_container">
        <?php
        include 'sideBar.php';
        ?>
        <div id="middle_section1">
            <!-- display pupil performance for commenting   -->
            <?php
            $sql = "SELECT * FROM attempts usercode;";
            $result = mysqli_query($connection, $sql);
            echo
            '
            <table id="assignmentTable" class="display">
                <thead>
                    <tr>
                        <th>assignment id</th>
                        <th>Characters</th>
                        <th>Usercode</th>
                        <th>Done On</th>
                        <th>Score</th>
                        <th>TimeTaken(s)</th>
                        <th>Comments</th>
                        <th>Actions</th>
                        <th>Charts</th>
                    </tr>
                </thead>
                <tbody>
            ';
            if (mysqli_num_rows($result) > 0) {
                 while ($row = mysqli_fetch_assoc($result)) {
                    $a_id = $row['assignment_id'];
                    echo '<input type="text" value="' . $row['assignment_id'] . '" class="a_ids' . $row['usercode'] . '" hidden>';
                    echo '<input type="text" value="' . $row['score'] . '" class="scores' . $row['usercode'] . '" hidden>';
                        echo '
                        </tr>
                        <td>'. $row['assignment_id'] . '</td>
                        <td>';
                        $sql5 = "SELECT character_name FROM character_assignment WHERE assignment_id = '$a_id';";
                        $result5 = mysqli_query($connection, $sql5);
                        while ($row5 = mysqli_fetch_assoc($result5)) {
                            echo $row5['character_name'];
                            echo ",";
                        }
                        echo
                        '</td>
                        <td>'.$row['usercode'] . '</td>
                        <td>' . date('Y-m-d H:i:s', $row['dateWorkdone']) . '</td>
                        <td>' . $row['score'] . '</td>
                        <td>' . $row['totaltime'] . '</td>
                        <form action="./processes/addcomment.php" method="POST">
                        <td>';
                        if ($row['comment'] == "-") {
                            echo '
                                        <input type="text" name="comment" placeholder="Comment"/>
                                        <input type="text" name="attempt_id" value=' . $row["id"] . ' hidden />
                                        ';
                        } else {
                            echo
                            $row['comment'];
                        }
                        echo'</td>
                        <td>';
                         if ($row['comment'] == "-") {
                            echo '
                                <input type="submit" value="Add Comment" name="add_comment"/>
                                </form>
                                ';
                        }
                        echo '
                        </td>
                        <td>
                        <img src="chart.jpg"  width="20" height="20" alt="' . $row['usercode'] . '" class="chartImages")">
                        </td>
                        </tr>
                        ';
                }
             }
            ?>
            </tbody>
            </table>
            <div>
                <canvas id="myChart" style="width:50%;max-width:350px;max-height: 350px; border-radius:20px;"></canvas>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#assignmentTable').DataTable();
        });
        var chatBttns = document.getElementsByClassName("chartImages");

        for (let i = 0; i < chatBttns.length; i++) {
            const element = chatBttns[i];
            element.addEventListener('click', (e) => {
                var yValues = new Array();
                var xValues = new Array()
                var a_idName = "a_ids" + e.target.alt;
                var scoreClass = "scores" + e.target.alt;
                var assignment_ids = document.getElementsByClassName(a_idName);
                for (let i = 0; i < assignment_ids.length; i++) {
                    const assignment_id = assignment_ids[i].value;
                    xValues.push(assignment_id);
                }
                var scores = document.getElementsByClassName(scoreClass);
                for (let i = 0; i < scores.length; i++) {
                    const score = scores[i].value;
                    yValues.push(score);
                }

                // console.log(yValues);
                // console.log(xValues)
                var barColors = ["red", "green", "blue", "orange", "green","purple",'yellow'];

                let chartStatus = Chart.getChart("myChart"); // <canvas> id
                if (chartStatus != undefined) {
                    chartStatus.destroy();
                }

                new Chart("myChart", {
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
                                text: "Summary about assignments"
                            },
                            legend: {
                                labels: {
                                    filter: (legendItem, data) => (typeof legendItem.text !== 'undefined')
                                }
                            }
                        },
                        scales: {
                            x: {
                                title: {
                                    display: true,
                                    text: 'Assignment id'
                                }
                            },
                            y: {
                                title: {
                                    display: true,
                                    text: 'Score'
                                }
                            }
                        }
                    }
                });

            })

        }
    </script>
    </body>
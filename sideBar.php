  <div class="sideBar">
      <header>MENU</header>
      <ul>
          <?php
            if ($_SESSION['username'] == 'admin') {
                echo
                '
                    <li><a href="adminPage.php"><i class="fas fa-link"></i>Register Teacher</a></li>
                    <li><a href="viewTeachers.php"><i class="fas fa-link"></i>Registered teachers</a></li>
           
                   
                  ';
            } else {
                echo
                '         <li><a href="teacherPage.php"><i class="fas fa-link"></i>Home</a></li>
                    <li><a href="addCharacterAssignment.php"><i class="fas fa-link"></i>Assignment</a></li>
                    <li><a href="RegisterPupil.php"><i class="fas fa-link"></i>Register Pupil</a></li>
                    <li><a href="ViewPupils.php"><i class="fas fa-link"></i>View Pupils</a></li>
                    <li><a href="performance.php"><i class="fas fa-link"></i>Grade</a></li>
                  ';
            }
            ?>

      </ul>
  </div>
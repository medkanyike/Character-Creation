  <?php

    session_start()
    ?>


  <!DOCTYPE html>
  <html lang="en">

  <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Teachers'Page</title>
      <script src="https://kit.fontawesome.com/53e02c7f46.js" crossorigin="anonymous"></script>
      <link rel="stylesheet" href="./css/teachersPage.css">
      <link rel="stylesheet" href="./css/header.css">
      <link rel="stylesheet" href="./css/assigment.css">
  </head>

  <body>
      <div class="container">
          <img src="https://icons8.com/icon/82749/menu" alt="">
          <h1>Teachers' Page</h1>
          <form action="./processes/logout.php" method="post">
            <input type="submit" id="logout_button" value="LogOut">
          </form>
      </div>
      <input type="checkbox" id="check">
      <label for="check">
          <i class="fas fa-bars" id="btn"></i>
          <i class="fas fa-times" id="cancel"></i>
      </label>

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
                    '
                    <li><a href="addCharacterAssignment.php"><i class="fas fa-link"></i>Assignment</a></li>
                    <li><a href="RegisterPupil.php"><i class="fas fa-link"></i>Register Pupil</a></li>
                    <li><a href="ViewPupils.php"><i class="fas fa-link"></i>View Pupils</a></li>
                    <li><a href="Grade.php"><i class="fas fa-link"></i>Grade</a></li>
                  ';
                }
                ?>

          </ul>
      </div>
  </body>
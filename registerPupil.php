<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <p>Fill up the registration form with correct values.</p>
  <form action="processes/pupilRegistration.php" method="post">

        <input type="text" name="firstname" placeholder="Enter pupils firstname"required><br>

        <input type="text" name="lastname" placeholder="Enter pupils lastname"required><br>

        <input type="number" name="contact" placeholder="Enter pupils phonenumber"required><br>

        <input type="text" name="usercode" placeholder="usercode">
        <button name = "register" type="submit">
          Register</button>
  </form>
</body>
</html>
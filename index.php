<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="./processes/login.php" method="post">
        <input type="text" name="username" id="">
        <input type="password" name="password" id="">
        <input type="submit" value="Login" name="login_bttn">
    </form>
    <a href="addCharacterAssignment.php"> add </a>
    <?php
       $firstname = 'kanyike ';
       $lastname = 'muhammed';
  
       echo '<br>';
       $firstname_first_character = substr($firstname,0,1);
       $lastname_first_character = substr($lastname,0,1);
       $lastname_second_character = substr($lastname,1,1);
       $code =  $firstname_first_character.$lastname_first_character.rand(100,500).$lastname_second_character;
       echo strtoupper($code) ;

     ?>
</body>

</html>
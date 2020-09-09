<?php
  if (!isset($_SESSION)) {
    session_start();
  }
  require_once '../connect.php';
  
  if (isset($_POST['submit'])) {
    $login = trim($_POST['login']);
    $password = trim($_POST['password']);
    
    $checkLogin = mysqli_query($connect, "SELECT * FROM `users` WHERE `login` = '$login'");
    if (mysqli_num_rows($checkLogin) == 0) {
      echo 'Неправильный логин или пароль';
    } else {
      $checkPassword = mysqli_query($connect, "SELECT password FROM `users` WHERE `login` = '$login'");
      if ( password_verify($password, mysqli_fetch_assoc($checkPassword)['password']) ) {
        $user = mysqli_fetch_assoc($checkLogin);
        $_SESSION['user'] = [
          "id" => $user['id'],
          "login" => $user['login'],
          "admin" => $user['admin']
        ];
    
        header('Location: ../admin');
      } else {
        echo 'Неправильный логин или пароль';
      }
    }
  }
  ?>


<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>ModernMine-admin</title>
    <link rel="stylesheet" href="styles/admin.min.css">
  </head>

  <body>
    <form action="" method="post">
      <label for="login">Логин</label>
      <input id="login" type="text" name="login">
      
      <label for="password">Пароль</label>
      <input id="password" type="password" name="password">
      
      <label for="submit">Войти</label>
      <input id="submit" type="submit" name="submit" value="Войти">
    </form>
  </body>
</html>


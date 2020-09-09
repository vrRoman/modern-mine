<?php
  if (!isset($_SESSION)) {
    session_start();
  }
  if (!isset($_SESSION['user']) && !$_SESSION['user']['admin']) {
    header('Location: ./login.php');
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
    <a class="add-link" href="add-resourcepack">Добавить ресурспак</a>
    <a class="add-link" href="add-mod">Добавить мод</a>
  </body>
</html>

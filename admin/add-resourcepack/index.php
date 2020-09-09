<?php
if (!isset($_SESSION)) {
  session_start();
}
if (!isset($_SESSION['user']) && !$_SESSION['user']['admin']) {
  header('Location: ../login.php');
}
?>

<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>ModernMine-admin</title>
    <link rel="stylesheet" href="../styles/admin.min.css">
  </head>

  <body>
    <div id="add-resourcepack-form" class="add-resourcepack-form"> Добавить ресурспак
      <form action="../add.php" method="post">
        <label for="head">Название</label>
        <input id="head" type="text" name="head">

        <label for="preview-text">Короткий текст(около 120 символов, макс. 355)</label>
        <textarea id="preview-text" cols="30" rows="10" name="preview-text"></textarea>

        <label for="text">Полный текст</label>
        <textarea id="text" cols="30" rows="10" name="text"></textarea>

        <div class="checkboxes">
          <p><input type="checkbox" name="tags[]" value="pvp">ПВП</p>
          <p><input type="checkbox" name="tags[]" value="bw">БВ</p>
          <p><input type="checkbox" name="tags[]" value="fps-boost">ФПС Буст</p>
          <p><input type="checkbox" name="tags[]" value="beautiful">Красивые</p>

          <p><input type="checkbox" name="versions[]" value="1.7.10">1.7.10</p>
          <p><input type="checkbox" name="versions[]" value="1.8.9">1.8.9</p>
          <p><input type="checkbox" name="versions[]" value="1.12.2">1.12.2</p>
          <p><input type="checkbox" name="versions[]" value="1.14.4">1.14.4</p>
          <p><input type="checkbox" name="versions[]" value="1.15.2">1.15.2</p>
          <p><input type="checkbox" name="versions[]" value="1.16.1">1.16.1</p>
        </div>
        <div class="resolution">
          <label for="resolution">Разрешение(просто цифры)</label>
          <input id="resolution" type="text" name="resolution">
        </div>

        <label for="img-link">Ссылка на картинку</label>
        <input id="img-link" type="text" name="img-link">

        <label for="download-link">Ссылка на файл для скачивания</label>
        <input id="download-link" type="text" name="download-link">

        <input type="hidden" value="hiddenInput-rp" name="hiddenInput-rp">
        <label for="submit">Подтвердить</label>
        <input id="submit" type="submit" name="add-resourcepack" value="Подтвердить">
      </form>
    </div>

  </body>
</html>

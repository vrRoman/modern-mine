<?php
  require_once '../connect.php';
  if (isset($_POST['add-resourcepack']) && isset($_POST['hiddenInput-rp'])) {
    echo '<p><a href="../admin/add-resourcepack" style="font-size: 200%">Назад</a></p>';
    $head = $_POST['head'];
    $text = $_POST['text'];
    $preview_text = $_POST['preview-text'];
    $img = $_POST['img-link'];
    $download_link = $_POST['download-link'];
    $versions = $_POST['versions'];
    $tags = $_POST['tags'];
    $resolution = $_POST['resolution'];
    $views = rand(50, 150);
    $real_views = 0;
    
    if (!$head) die('Не заполнил название');
    if (!$preview_text) die('Не заполнил текст для показа');
    if (!$img) die('Нет картинки');
    if (!$download_link) die('Нет ссылки для скачивания');
    if (!$versions) {
      die('Не выбрал версии');
    } else {
      $versions = json_encode($versions);
    }
    if (!$tags) {
      die('Не выбрал теги');
    } else {
      $tags = json_encode($tags);
    }
    if (!$resolution) die('Нет разрешения');
  
    if (!$text) $text = '';

    $date = date("Y-m-d");
    $query = "INSERT INTO `resourcepacks`
      (`id`, `head`, `text`, `preview_text`, `img`, `download_link`, `versions`, `tags`, `resolution`, `views`, `real_views`, `date`) VALUES
      (NULL, '$head', '$text', '$preview_text', '$img', '$download_link', '$versions', '$tags', '$resolution', '$views', '$real_views', '$date')";
    
    if (!mysqli_query($connect, $query)) {
      die('Запрос не удался. Напиши мне в вк, если все данные правильные');
    } else {
      header('Location: ../admin/add-resourcepack/');
    }
  }



  if (isset($_POST['add-mod']) && isset($_POST['hiddenInput-mod'])) {
    echo '<p><a href="../admin/add-mod" style="font-size: 200%">Назад</a></p>';
    $head = $_POST['head'];
    $text = $_POST['text'];
    $preview_text = $_POST['preview-text'];
    $img = $_POST['img-link'];
    $download_link = $_POST['download-link'];
    $versions = $_POST['versions'];
    $views = rand(50, 150);
    $real_views = 0;

    if (!$head) die('Не заполнил название');
    if (!$preview_text) die('Не заполнил текст для показа');
    if (!$img) die('Нет картинки');
    if (!$download_link) die('Нет ссылки для скачивания');
    if (!$versions) {
      die('Не выбрал версии');
    } else {
      $versions = json_encode($versions);
    }

    if (!$text) $text = '';

    $date = date("Y-m-d");
    $query = "INSERT INTO `mods`
        (`id`, `head`, `text`, `preview_text`, `img`, `download_link`, `versions`, `views`, `real_views`, `date`) VALUES
        (NULL, '$head', '$text', '$preview_text', '$img', '$download_link', '$versions', '$views', '$real_views', '$date')";

    if (!mysqli_query($connect, $query)) {
      print_r(mysqli_error($connect));
      die('<br>Запрос не удался. Напиши мне в вк, если все данные правильные');
    } else {
      header('Location: ../admin/add-mod');
    }
  }
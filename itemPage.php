<?php
session_start();
require_once 'connect.php';

if (stristr($_SERVER['REQUEST_URI'], 'resourcepacks')) {
  $itemType = 'resourcepacks';
} elseif (stristr($_SERVER['REQUEST_URI'], 'mods')) {
  $itemType = 'mods';
} else {
  header('Location: index.html');
}

if (isset($_GET['id'])) {
  $item = mysqli_fetch_assoc(mysqli_query($connect,
    "SELECT * FROM `$itemType` WHERE `id` = $_GET[id]"));
}

if (!$item) {
  require 'not-found.html';
  exit();
}

if (!isset($_SESSION[$itemType.'_viewed']) || !in_array($_GET['id'], $_SESSION[$itemType.'_viewed'])) {
  mysqli_query($connect, "UPDATE `$itemType`
    SET `views` = `views` + 1, `real_views` = `real_views` + 1 WHERE `id` = $_GET[id]");
  $_SESSION[$itemType."_viewed"][] = $_GET['id'];
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title><?php
    echo $item['head']
  ?></title>
  <link rel="stylesheet" href="../styles/itemPage.min.css">
  <link rel="shortcut icon" href="../img/cube.svg" type="image/svg">
</head>

<body>
<header class="header header_transparent">
  <a class="header__logo" href="../">
    <img src="../img/logo.svg" alt="logo">
  </a>

  <div class="header__nav">
    <ul>
        <li>
            <a href="../">
                Главная
            </a>
        </li>
      <li class="header__active-link"><a href="../resourcepacks">
          Ресурспаки
        </a></li>
      <li><a href="../mods">
          Моды
        </a></li>
    </ul>
  </div>
  <div class="header__burger" onclick="document.querySelector('.mobile-nav').style.visibility = 'visible'">
    <span></span>
    <span></span>
    <span></span>
  </div>
</header>
<div class="mobile-nav">
  <ul>
      <li>
          <a href="../">
              Главная
          </a>
      </li>
    <li><a href="../resourcepacks">
        Ресурспаки
      </a></li>
    <li><a href="../mods">
        Моды
      </a></li>
  </ul>
  <div class="mobile-nav__close" onclick="document.querySelector('.mobile-nav').style.visibility='hidden'"></div>
</div>



<main>
  <div class="item container">
    <h2 class="item__title"><?php echo $item['head'];
      if (isset($item['resolution'])) echo " [$item[resolution]x]" ?></h2>
    <img class="item__img" src="<?php echo $item['img'] ?>" alt="img">
    <p class="item__short-text"><?php echo $item['preview_text'] ?></p>
    <p class="item__add-text"><?php echo $item['text'] ?></p>
    <div class="item__add-info">
      <p class="item__versions"><?php echo implode(', ', json_decode($item['versions'])) ?></p>
      <div class="item__rating"></div>
      <p class="item__views"><?php echo "$item[views] ";
        if ($item['views'] % 10 == 1) echo 'просмотр';
        elseif ($item['views'] % 10 < 5 && $item['views'] % 10 != 0) echo 'просмотра';
        else echo 'просмотров';
        ?></p>
    </div>
    <button class="item__button button"><a href="<?php echo $item['download_link'] ?>">Скачать</a></button>
  </div>
</main>




<a href="#" class="up-btn up-btn_disabled">
  <div class="up-btn__arrow"></div>
</a>


<footer class="footer">
  <div class="footer__section">
    <h3 class="section__head">Контакты</h3>
    <p class="section__info">awdadaa/aodja</p>
    <p class="section__info">awdvagd/djvh</p>
  </div>
  <div class="footer__section footer__section_center">
    <h3 class="section__head">Мы в ВК:</h3>
    <p class="section__info"><a href="#">vk.com/123123</a></p>
  </div>
  <div class="footer__section">
    <p class="section__info"><a href="../resourcepacks">Ресурспаки</a></p>
    <p class="section__info"><a href="../mods">Моды</a></p>
  </div>
</footer>

<script src="../js/header.js"></script>
<script src="../js/up-btn.js"></script>
<script src="../js/Render.js"></script>
<script>
  Render.rating(document.querySelector('.item__rating'), <?php echo $item['rating']?>,
    '../img/star.svg', '../img/active-star.svg', true)
</script>

</body>
</html>
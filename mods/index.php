<?php
if (isset($_GET['id'])) {
  require '../itemPage.php';
  exit();
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>ModernMine</title>
  <link rel="stylesheet" href="styles/mods.min.css">
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
      <li><a href="../resourcepacks">
          Ресурспаки
        </a></li>
      <li class="header__active-link"><a href="">
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
  <h1 class="title">Моды</h1>
  <div class="form">
    <div class="show-form">
      Показать<br>сортировку
      <div class="show-form__arrow switch-form__arrow"></div>
    </div>
    <div class="close-form">
      Скрыть<br>сортировку
      <div class="close-form__arrow switch-form__arrow"></div>
    </div>

    <form action="" method="get">
      <div class="form__search">
        <label for="search">Поиск</label>
        <input id="search" name="search" type="search" placeholder="Название мода">
      </div>

      <div class="form__sorting">
        <label for="order">Сортировка по:</label>
        <div class="sorting__arrow"></div>
        <select name="order" id="order">
          <option value="rating">Рейтингу</option>
          <option value="views">Просмотрам</option>
          <option value="date">Дате</option>
        </select>
      </div>


      <div class="form__versions">
        <span>Версии:</span>
        <label class="any" for="any-version">Любая</label>
        <input id="any-version" type="checkbox" value="any" name="versions[]">

        <label for="seventh-version">1.7.10</label>
        <input class="versions-inputs" id="seventh-version" type="checkbox" value="1.7.10" name="versions[]">
        <label for="eighth-version">1.8.9</label>
        <input class="versions-inputs" id="eighth-version" type="checkbox" value="1.8.9" name="versions[]">
        <label for="twelfth-version">1.12.2</label>
        <input class="versions-inputs" id="twelfth-version" type="checkbox" value="1.12.2" name="versions[]">
        <label for="fourteenth-version">1.14.4</label>
        <input class="versions-inputs" id="fourteenth-version" type="checkbox" value="1.14.4" name="versions[]">
        <label for="fifteenth-version">1.15.2</label>
        <input class="versions-inputs" id="fifteenth-version" type="checkbox" value="1.15.2" name="versions[]">
        <label for="sixteenth-version">1.16.1</label>
        <input class="versions-inputs" id="sixteenth-version" type="checkbox" value="1.16.1" name="versions[]">
      </div>


      <input class="form__submit button" type="submit" value="Поиск">
    </form>

    <div class="close-form">
      Скрыть<br>сортировку
      <div class="close-form__arrow switch-form__arrow"></div>
    </div>
  </div>


  <div class="items"></div>


  <div class="pages"></div>
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
    <p class="section__info"><a href="">Моды</a></p>
  </div>
</footer>

<script src="../js/Render.js"></script>
<script src="../js/header.js"></script>
<script src="../js/up-btn.js"></script>
<script src="../js/smooth-anchors.js"></script>
<script src="../js/inputsSwitch.js"></script>
<script>
  inputsSwitch(document.getElementById('any-version'), document.querySelectorAll('.versions-inputs'));
</script>

<script>
  let showForm = document.querySelector('.show-form')
    , closeFormElems = document.querySelectorAll('.close-form')
    , form = document.querySelector('form')
  showForm.onclick = () => {
    showForm.style.display = 'none'
    closeFormElems.forEach(elem => elem.style.display = 'block')
    form.style.maxHeight = '1070px'
  }
  closeFormElems.forEach(elem => {
    elem.onclick = () => {
      closeFormElems.forEach(elem => elem.style.display = 'none')
      showForm.style.display = 'block'
      form.style.maxHeight = '0'
    }
  })

  window.onresize = () => {
    if (document.documentElement.clientWidth > 500) {
      form.style.maxHeight = 'unset'
      showForm.style.display = 'none'
      closeFormElems.forEach(elem => elem.style.display = 'none')
    } else {
      closeFormElems.forEach(elem => elem.style.display = 'none')
      showForm.style.display = 'block'
      form.style.maxHeight = '0'
    }
  }
</script>
</body>
</html>
<?php
require_once '../connect.php';
$itemsOnPage = 4;

if (isset($_GET['page'])){
  $first_item = (floor($_GET['page']) - 1) * $itemsOnPage;
  $page = floor($_GET['page']);
} else {
  $first_item = 0;
  $page = 1;
}

if (isset($_GET['order'])) {
  $order = $_GET['order'];
} else {
  $order = 'rating';
}

if (isset($_GET['versions'])) {
  $versions = $_GET['versions'];
  if (in_array('any', $versions)) {
    $versions = 'any';
  }
} else {
  $versions = 'any';
}

$query = "SELECT * FROM `mods`";


if (isset($_GET['search'])) {
  if (trim($_GET['search'])) {
    $search = explode(" ", $_GET['search']);
    $wordCount = count($search);

    foreach ($search as $key => $word) {
      if ($wordCount == 1) {
        $query .= " WHERE `head` LIKE '%$word%'";
      } elseif ($key == 0) {
        $query .= " WHERE (`head` LIKE '%$word%'";
      } elseif ($key == $wordCount - 1) {
        $query .= " OR `head` LIKE '%$word%')";
      } else {
        $query .= " OR `head` LIKE '%$word%'";
      }
    }
  }
}


if ($versions != 'any') {
  $versionsCount = count($versions);

  if (!trim($_GET['search'])) {
    foreach ($versions as $key => $version) {
      if ($key == 0) {
        $query .= " WHERE `versions` LIKE '%$version%'";
      } else {
        $query .= " OR `versions` LIKE '%$version%'";
      }
    }
  } else {
    foreach ($versions as $key => $version) {
      if ($versionsCount == 1) {
        $query .= " AND `versions` LIKE '%$version%'";
      } elseif ($key == 0) {
        $query .= " AND (`versions` LIKE '%$version%'";
      } elseif ($key == $versionsCount - 1) {
        $query .= " OR `versions` LIKE '%$version%')";
      } else {
        $query .= " OR `versions` LIKE '%$version%'";
      }
    }
  }
}

if ($order == 'rating') {
  $query .= " ORDER BY rating DESC, views DESC";
} elseif ($order == 'views') {
  $query .= " ORDER BY views DESC, rating DESC";
} elseif ($order == 'date') {
  $query .= " ORDER BY date DESC, views DESC";
}


$resultsCount = count(mysqli_fetch_all( mysqli_query($connect, $query) ));
if ($resultsCount < $first_item + 1 || $page == 0) $first_item = (intdiv($resultsCount, $itemsOnPage) * $itemsOnPage) - $itemsOnPage;

$query .= " LIMIT $first_item, $itemsOnPage";
$queryResult = mysqli_query($connect, $query);

if (!$queryResult) {
  echo '<script>Render.noMatches(document.querySelector(".items"))</script>';
  die();
}

$allItems = mysqli_fetch_all($queryResult);

foreach ($allItems as $item) {
  echo "<script>
      Render.itemPreview(document.querySelector('.items'),
        '$item[1]', '$item[3]', '$item[4]', $item[6], $item[7], {
          rating: $item[9],
          imgUrlNotActive: '../img/star.svg',
          imgUrlActive: '../img/active-star.svg'
        }, $item[0], 'items__item')
    </script>";
}

$whereToStartRenderNums = intdiv($page, 4) + 1;
$getIsset = false;
if (isset($_GET)) $getIsset = true;

echo "<script>
    Render.pageNums(document.querySelector('.pages'), $whereToStartRenderNums, 4, "
  .(intdiv($resultsCount - 1, $itemsOnPage) + 1).")
  </script>";



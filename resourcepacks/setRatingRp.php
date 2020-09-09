<?php
  if (isset($_POST)) $data = json_decode($_POST['data'], true);

  require_once '../connect.php';
  if (isset($data['change'])) {
    $itemId = $data['itemId'];
    $currentRating = mysqli_fetch_assoc(mysqli_query($connect, "SELECT `rating` FROM `resourcepacks` WHERE `id` = '$itemId'"))['rating'];
    $numOfRatings = mysqli_fetch_assoc(mysqli_query($connect, "SELECT `num_of_ratings` FROM `resourcepacks` WHERE `id` = '$itemId'"))['num_of_ratings'];

    if ($data['change']) {
      $oldUserRating = $data['oldUserRating'];
      $newUserRating = $data['newUserRating'];

      $newItemRating = round( (($currentRating * $numOfRatings - $oldUserRating) + $newUserRating) / $numOfRatings, 2 );

      $query = "UPDATE `resourcepacks` SET `rating` = '$newItemRating' WHERE `id` = '$itemId'";
      mysqli_query($connect, $query);
    } else {
      $rating = $data['rating'];
      $newItemRating = round((($currentRating * $numOfRatings) + $rating) / ($numOfRatings + 1), 2);

      $query = "UPDATE `resourcepacks` 
        SET `rating` = '$newItemRating', `num_of_ratings` = '".strval($numOfRatings + 1)."' WHERE `id` = '$itemId'";
      mysqli_query($connect, $query);
    }
  }
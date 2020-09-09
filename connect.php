<?php
  $connect = mysqli_connect('localhost', 'root', '0000', 'modernmine');
  if (!$connect) die('Error connect to DB');
  mysqli_query($connect, "SET NAMES UTF8");
  mysqli_query($connect, "SET CHARACTER SET UTF8");
  mysqli_query($connect, "SET character_set_client = UTF8");
  mysqli_query($connect, "SET character_set_connection = UTF8");
  mysqli_query($connect, "SET character_set_results = UTF8");

  
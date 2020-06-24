<?php

if (!isset($_SESSION['user'])) {
  $_SESSION['info'] = "Anda harus login terlebih dahulu untuk mengakses";
  header('Location: /dashboard/login.php');
}else {
  $username = $_SESSION['user'];
}

 ?>

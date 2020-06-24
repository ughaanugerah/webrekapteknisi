<?php
include '../function/db.php';

global $link;

if (isset($_POST['login'])) {

  $username =   $_POST['username'];
  $password =   $_POST['password'];
  $username = $link->real_escape_string($username);
  $password = $link->real_escape_string($password);


  $querycheck = ("SELECT * FROM user WHERE username = '$username' AND password = '$password'");
  $check = $link->query($querycheck);
  if ($check->num_rows == 1) {


    $_SESSION['user'] = $username;
    header('Location: index.php');

  }else {
    $_SESSION['info'] =  "GAGAL MASUk";

  }


}

?>

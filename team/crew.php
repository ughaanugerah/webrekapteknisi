<?php
include '../function/db.php';


if (isset( $_GET['sto'])) {
  $id_sto = $_GET['sto'];
  $query  = $_GET['query'];


  $output = "<ul class='list-unstyled'>";

  global $link;

  $querycrew  = ("SELECT nama_team FROM teknisi  WHERE id_sto = '$id_sto' AND nama_team LIKE '%$query%'");
  $resultcrew = $link->query($querycrew) or die($link->error);

  if ($resultcrew->num_rows > 0) {
    while (  $hasildatacrew  = $resultcrew->fetch_assoc()) {
      $output.= "<li class='list-group-item'>".$hasildatacrew['nama_team']."</li>";
    }
  }else {
    $output.= "<li  class='list-group-item'>Nama Tidak Ditemukan </li>";
  }
   $output.= "</ul>";

   echo $output;

  $link->close();
}



?>

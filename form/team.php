<?php

include '../function/db.php';


if (isset( $_GET['sto'])) {
  $namasto = $_GET['sto'];

  global $link;

  $querycrew  = ("SELECT teknisi.id, nama_team FROM teknisi JOIN list_sto ON list_sto.id_teknisi = teknisi.id  WHERE id_sto = '$namasto' ORDER BY nama_team");
  $resultcrew = $link->query($querycrew) or die($link->error);
  echo "<option value=''> Pilih CREW</option>";

  while (  $hasildatacrew  = $resultcrew->fetch_assoc()) {
    echo "<option value='".$hasildatacrew['id']."'>".$hasildatacrew['nama_team']."</option>";
  }
  $link->close();
}

if (isset( $_GET['crew'])) {
  $crew = $_GET['crew'];
  global $link;

  $querycrew  = ("SELECT teknisi1, teknisi2 FROM `teknisi` WHERE id= '$crew'");
  $resultcrew = $link->query($querycrew) or die($link->error);


  $hasildatacrew  = $resultcrew->fetch_assoc();
  $teknisi = array(
    'teknisi1' => $hasildatacrew['teknisi1'],
    'teknisi2' => $hasildatacrew['teknisi2']
  );
  $link->close();

  echo json_encode($teknisi);

}

?>

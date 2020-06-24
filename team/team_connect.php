<?php

global $link;

if (isset($_POST['submit_team'])) {
  $mitra        = trim($_POST['mitra']);
  $sto          = trim($_POST['sto']);
  $team         = trim($_POST['team']);
  $teknisi1     = trim($_POST['teknisi1']);
  $teknisi2     = trim($_POST['teknisi2']);

  $querycheckteam = ("SELECT nama_team FROM teknisi WHERE nama_team = '$team'");
  $checkteam = $link->query($querycheckteam) or die($link->error);

  if ($checkteam->num_rows == 0 ) {
    $queryteam =  $link->prepare("INSERT INTO teknisi (nama_team, teknisi1, teknisi2, id_mitra) VALUES (?, ?, ?, ?)");
    $queryteam->bind_param('sssi',$team, $teknisi1, $teknisi2, $mitra);
    $queryteam->execute() or die($link->error);

    $querysto = $link->prepare("INSERT INTO list_sto (id_teknisi, id_sto) VALUES ((SELECT id FROM teknisi WHERE nama_team = '$team'), ?)");
    $querysto->bind_param('i', $sto);
    $querysto->execute() or die($link->error);

    $info = "Team berhasil diinput!";


  }else {
    $info = "Nama team sudah digunakan, silahkan gunakan nama lain!";

  }
}

if (isset($_POST['submit_waktu'])) {
  $team         = $_POST['crew'];
  $time         = $_POST['jamhadir'];
  $date         = date('yy-m-d');


  $querycheckteam = ("SELECT id_teknisi FROM kehadiran WHERE date = '$date' AND id_teknisi = $team");
  $checkteam = $link->query($querycheckteam);

  if ($checkteam->num_rows == 0 ) {

    $querywaktu =  $link->prepare("INSERT INTO kehadiran (id_teknisi, date, time) VALUES (?, ?, ?)");
    $querywaktu->bind_param('iss',$team, $date, $time);
    $querywaktu->execute() or die($link->error);
  }else {
    echo "TEAM SUDAH TERINPUT";
  }
}

if (isset($_POST['edit_team'])) {
  $id_teknisi            = trim($_POST['crew']);
  $nama_teknisi          = trim($_POST['namabaru']);
  $teknisi1              = trim($_POST['teknisi1']);
  $teknisi2              = trim($_POST['teknisi2']);

  $querycheckteam = ("SELECT nama_team FROM teknisi WHERE id = '$id_teknisi'");
  $checkteam = $link->query($querycheckteam) or die($link->error);

  if ($checkteam->num_rows == 1 ) {
    $queryedit = $link->prepare("UPDATE teknisi  SET nama_team = ?, teknisi1 = ?, teknisi2 = ? WHERE id = ?");
    $queryedit->bind_param('sssi', $nama_teknisi, $teknisi1, $teknisi2, $id_teknisi);
    $queryedit->execute() or die($link->error);
  }else {
    echo " TEAM TIDAK DITEMUKAN";
  }
}

if (isset($_POST['submit_sto'])) {
  $id_team            = trim($_POST['teamsto']);
  $id_sto             = trim($_POST['addsto']);

  $querycheckteam = ("SELECT * FROM list_sto WHERE id_teknisi = '$id_team' AND id_sto = '$id_sto'");
  $checkteam = $link->query($querycheckteam) or die($link->error);

  if ($checkteam->num_rows == 0 ) {
    $queryliststo =  $link->prepare("INSERT INTO list_sto (id_teknisi, id_sto) VALUES (?, ?)");
    $queryliststo->bind_param('ii',$id_team, $id_sto);
    $queryliststo->execute();
  }else {
    echo "GAGAL! DATA SUDAH ADA";
  }

}


?>

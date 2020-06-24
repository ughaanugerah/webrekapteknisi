<?php
global $link;


$queryusername = ("SELECT id FROM user WHERE username = '$username' ");
$username = $link->query($queryusername)->fetch_assoc();

$username = $username['id'];

if (isset($_POST['submit_data'])) {

  $track_id       = trim($_POST['track_id']);
  $track_id       = 'MYIR-'.$track_id;
  $nomor_sc       = trim($_POST['nomor_sc']);
  $nomor_user     = trim($_POST['nomor_user']);
  $nama_customer  = trim($_POST['nama_customer']);
  $channel        = trim($_POST['channel']);
  $order_date     = trim($_POST['order_date']);
  $fu_date        = trim($_POST['fu_date']);
  $odp_pelanggan  = trim($_POST['odp_pelanggan']);
  $odp_alternatif = trim($_POST['odp_alternatif']);
  $koordinat      = trim($_POST['koordinat']);
  $barcode        = trim($_POST['barcode']);

  if (isset($_POST['kode'])) {
    $kode           = trim($_POST['kode']);
  }else {
    $kode = NULL;
  }


  $deskripsi      = trim($_POST['deskripsi']);

  if ($deskripsi == '') {
    $deskripsi = NULL;
  };

  $crew           = trim($_POST['crew']);

  if ($crew == '') {
    $crew = NULL;
  };

  $teknisi1       = trim($_POST['teknisi1']);
  $teknisi2       = trim($_POST['teknisi2']);
  $sto            = trim($_POST['sto']);

  $querycheck = ("SELECT * FROM customer WHERE track_id = '$track_id'");
  $resultcheck = $link->query($querycheck) or die($link->error);
  if ($resultcheck->num_rows > 0) {
    $queryteam = $link->prepare("UPDATE customer SET nama_customer = ?, nomor_sc = ?, id_channel = ?, order_date = ?, last_update = ?, odp_pelanggan = ?, odp_alternatif = ?, koordinat = ?, id_kendala = ?, id_teknisi = ?, barcode = ?, id_sto = ?, created_by = ?
      WHERE track_id = ?");
      $queryteam->bind_param('ssisssssiisiis', $nama_customer, $nomor_sc, $channel, $order_date, $fu_date , $odp_pelanggan, $odp_alternatif, $koordinat, $kode, $crew, $barcode, $sto, $username, $track_id);

      $querydistribusi = $link->prepare("INSERT INTO distribusi (id_customer, id_kendala, fu_date, deskripsi, id_team, id_sto, created_by)
      VALUES ((SELECT id FROM customer WHERE track_id = ?), ?, ?, ?, ?, ?, ?)");
      $querydistribusi->bind_param('sissiii', $track_id, $kode, $fu_date, $deskripsi, $crew, $sto, $username);

      $queryteam->execute() or die($link->error);
      $querydistribusi->execute() or die($link->error);


    }else {
      $queryteam = $link->prepare("INSERT INTO customer (nama_customer, nomor_sc, track_id, id_channel, order_date, last_update, odp_pelanggan, odp_alternatif, koordinat, id_kendala, id_teknisi, barcode, id_sto, created_by) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
      $queryteam->bind_param('sssisssssiisii', $nama_customer, $nomor_sc, $track_id, $channel, $order_date, $fu_date, $odp_pelanggan, $odp_alternatif, $koordinat, $kode, $crew, $barcode, $sto, $username);


      $querydistribusi = $link->prepare("INSERT INTO distribusi (id_customer, id_kendala, fu_date, deskripsi, id_team, id_sto, created_by) VALUES ((SELECT id FROM customer WHERE track_id = ?), ?, ?, ?, ?, ?, ?)");
      $querydistribusi->bind_param('sissiii', $track_id, $kode, $fu_date, $deskripsi, $crew,$sto, $username);

      $queryteam->execute();
      $querydistribusi->execute();




    }

  }
  ?>

<?php

include '../function/db.php';
session_start();

//import.php
global $link;

function checkdata($var)
{
  if (isset($var)) {
    return $var;
  }else {
    return "";
  }
}
$error = '';

$username = $_SESSION['user'];
$queryusername = ("SELECT id FROM user WHERE username = '$username' ");
$username = $link->query($queryusername)->fetch_assoc();
$tanggal_hariini         = date("Y-m-d", strtotime("now"));

$username = $username['id'];

$order_date = checkdata($_POST["order_date"]);
$track_id = checkdata($_POST["track_id"]);
$sto = checkdata($_POST["sto"]);
$address = checkdata($_POST["address"]);
$nama = checkdata($_POST["nama"]);
$kkontak = checkdata($_POST["kkontak"]);
$channel = checkdata($_POST["channel"]);
$sc = checkdata($_POST["sc"]);
$user = checkdata($_POST["user"]);


if(isset($_POST["track_id"]))
{

  echo "<table class='table table-striped table-bordered'>";
  echo "<tr> ";
  echo "<th> STATUS</th> ";
  echo "<th> ORDER DATE </th> ";
  echo "<th> TRACK ID </th> ";
  echo "<th> STO</th> ";
  echo "<th> ADDRESS</th> ";
  echo "<th> NAMA</th> ";
  echo "<th> K-KONTAK</th> ";
  echo "<th> CHANNEL</th> ";
  echo "<th> SC</th> ";
  echo "<th> USER</th> ";
  echo "</tr> ";

  for ($i=0; $i < count($track_id) ; $i++) {

    $date = str_replace('/', '-', $order_date[$i]);
    $newDate = date("Y/m/d", strtotime($date));

    $checker = $track_id[$i];
    $querycheck  = ("SELECT track_id FROM customer WHERE track_id = '$checker'");
    $check = $link->query($querycheck) or die($link->error);


    echo "<tr> ";
    if (substr($checker, 0, 4) == 'MYIR') {
      if ($check->num_rows != 1) {

        $querysto = ("SELECT id FROM sto WHERE nama_sto = '$sto[$i]' ");
        $id_sto = $link->query($querysto)->fetch_assoc();

        $querychannel = ("SELECT id FROM channel WHERE channel = '$channel[$i]' ");
        $id_channel = $link->query($querychannel)->fetch_assoc();



        if (!empty($id_sto['id']) ) {
          $id_sto = $id_sto['id'];

          if (!empty($id_channel['id']) ) {
            $id_channel = $id_channel['id'];

            $queryteam = $link->prepare("INSERT INTO customer (nama_customer, nomor_sc, track_id, order_date, created_by, id_sto, id_channel, last_update) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $queryteam->bind_param('ssssiiis', $nama[$i], $sc[$i], $track_id[$i], $newDate, $username, $id_sto, $id_channel, $tanggal_hariini );
            $queryteam->execute() or die($link->error);

            echo "<td  class='table-success'> Berhasil</td>";
          }else {
            $error = 'Data Channel Invalid';
          }

        }else {
          $error = 'Data STO Invalid';
        }


      }else {
        $error = 'Nomor Track ID sudah ada';
      }
    }else {
      $error = 'Nomor Track ID Tidak Valid';
    }
    if ($error != '') {
      echo "<td  class='table-danger'>$error</td>";
      $error = '';

    }
    echo "<td>".$order_date[$i]."</td>";
    echo "<td>".$checker."</td>";
    echo "<td>".$sto[$i]."</td>";
    echo "<td>".$address[$i]."</td>";
    echo "<td>".$nama[$i]."</td>";
    echo "<td>".$kkontak[$i]."</td>";
    echo "<td>".$channel[$i]."</td>";
    echo "<td>".$sc[$i]."</td>";
    echo "<td>".$user[$i]."</td>";
    echo "</tr> ";
  }
  echo "<table>";

}

?>

<?php

function GetIdTeam($id_sto)
{
  global $link;

  $queryidteam  = ("SELECT DISTINCT id_team FROM `distribusi` WHERE id_sto = $id_sto");
  $resultidteam = $link->query($queryidteam);
  $id_team = array();

  while ($hasildataidteam  = $resultidteam->fetch_assoc()) {
    $id_team[$hasildataidteam['id_team']] = $hasildataidteam;

  }
  return $id_team;
  $link->close();
}


function GetSto()
{
  global $link;

  $querysto  = ("SELECT * FROM sto");
  $resultsto = $link->query($querysto);
  $namasto = array();
  $idsto = array();

  while ($hasildatasto  = $resultsto->fetch_assoc()) {
    $namasto[$hasildatasto['nama_sto']] = $hasildatasto;
    $idsto[$hasildatasto['id']] = $hasildatasto;

  }
  return $namasto;
  return $idsto;
  $link->close();
}

function GetTeam()
{
  global $link;
  global $username;

  $queryteam  = ("SELECT teknisi.id, nama_team FROM teknisi JOIN list_mitra ON teknisi.id_mitra = list_mitra.id_mitra JOIN user ON list_mitra.id_user = user.id WHERE username = '$username' ORDER BY nama_team");
  $resultteam = $link->query($queryteam);
  $namateam = array();
  $idteam = array();

  while ($hasildatateam  = $resultteam->fetch_assoc()) {
    $namateam[$hasildatateam['nama_team']] = $hasildatateam;
    $idteam[$hasildatateam['id']] = $hasildatateam;

  }
  return $namateam;
  return $idteam;
  $link->close();
}

function GetChannel()
{
  global $link;

  $query  = ("SELECT * FROM channel");
  $result = $link->query($query);
  $channel  = array();
  $idchannel  = array();

  while ($hasildata  = $result->fetch_assoc()) {
    $channel[$hasildata['channel']] = $hasildata;
    $idchannel[$hasildata['id']] = $hasildata;

  }
  return $channel;
  return $idchannel;
  $link->close();
}

function GetKode()
{
  global $link;

  $query   = ("SELECT id, kode, nama_kendala FROM kendala ORDER BY kode DESC");
  $result  = $link->query($query);

  $kode    = array();
  $kendala = array();
  $id      = array();

  while ($hasildata  = $result->fetch_assoc()) {
    $kendala[$hasildata['nama_kendala']] = $hasildata;
    $kode[$hasildata['kode']] = $hasildata;
    $id[$hasildata['id']] = $hasildata;

  }
  return $kendala;
  return $kode;
  return $id;
  $link->close();
}

function GetMitra()
{
  global $link;
  global $username;


  $querymitra  = ("SELECT * FROM mitra JOIN list_mitra ON mitra.id = list_mitra.id_mitra JOIN user ON list_mitra.id_user = user.id WHERE username = '$username' ORDER BY nama_mitra");
  $namamitra = array();
  $idmitra = array();

  $resultmitra = $link->query($querymitra);

  while ($hasildatamitra  = $resultmitra->fetch_assoc()) {
    $namamitra[$hasildatamitra['nama_mitra']] = $hasildatamitra;
    $idmitra[$hasildatamitra['id']] = $hasildatamitra;

  }
  return $namamitra;
  return $idmitra;
  $link->close();
}


function GetKendala($kategori)
{
  global $link;

  $querykendala = ("SELECT * FROM kendala WHERE kategori_kendala = '$kategori' AND kode BETWEEN 0 AND 400 ORDER BY nama_kendala");
  $kendala = $link->query($querykendala);

  $namakendala = array();
  $idkendala = array();

  while ($hasilkendala  = $kendala->fetch_assoc()) {
    $namakendala[$hasilkendala['nama_kendala']] = $hasilkendala;
    $idkendala[$hasilkendala['id']] = $hasilkendala;

  }
  return $namakendala;
  return $idkendala;
  $link->close();
}

function GetDetail($param, $value)
{
  $query  = ("SELECT  * FROM distribusi
    JOIN customer ON distribusi.id_customer = customer.id
    JOIN kendala ON distribusi.id_kendala = kendala.id
    JOIN teknisi ON distribusi.id_team = teknisi.id
    JOIN sto ON distribusi.id_sto = sto.id
    WHERE $param='$value' ORDER BY distribusi.created_at DESC"
  );

  return $query;
}

function GetUser($param, $value)
{
  $query  = ("SELECT  * FROM customer
    JOIN channel ON customer.id_channel = channel.id
    JOIN kendala ON customer.id_kendala = kendala.id
    JOIN teknisi ON customer.id_teknisi = teknisi.id
    JOIN sto ON customer.id_sto = sto.id
    JOIN user ON customer.created_by = user.id
    WHERE $param='$value'"
  );

  return $query;
}

function CheckEmpty($value)
{
  if ($value == '') {
    echo " - ";
  }else {
    echo $value;
  }
}

?>

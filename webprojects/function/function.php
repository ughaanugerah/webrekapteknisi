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

  $querymitra  = ("SELECT * FROM mitra ORDER BY nama_mitra");
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


?>

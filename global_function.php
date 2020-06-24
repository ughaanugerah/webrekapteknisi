<?php
function PrintList($NamaTim,$i){
  global $link;

  if (isset($_GET['laporan'])) {
    if ($_GET['laporan'] == "hari_ini") {
      $today = date('yy-m-d');

      $queryteam = ("SELECT DISTINCT team FROM ant WHERE team LIKE '$NamaTim%' AND fu_date='$today' ");
      $queryps   = ("SELECT team FROM ant WHERE team LIKE '$NamaTim%' AND fu_date='$today' AND kategori='PS' ");
      $querykt   = ("SELECT COUNT(DISTINCT track_id) AS jumlah FROM ant WHERE NOT kategori='PS' AND kategori='Kendala Teknis' AND fu_date='$today' AND team LIKE '$NamaTim%'");
      $querykp   = ("SELECT COUNT(DISTINCT track_id) AS jumlah FROM ant WHERE NOT kategori='PS' AND kategori='Kendala Pelanggan' AND fu_date='$today' AND team LIKE '$NamaTim%'");


    } elseif ($_GET['laporan'] == "minggu_ini") {
      $pengurang    = date('N');
      $penambah     = 7 - $pengurang;
      $tanggalawal  = date('yy-m-d', strtotime("-$pengurang days"));
      $tanggalakhir = date('yy-m-d', strtotime("+$penambah days"));

      $queryteam = ("SELECT DISTINCT team FROM ant WHERE team LIKE '$NamaTim%' AND fu_date BETWEEN '$tanggalawal' AND '$tanggalakhir'");
      $queryps   = ("SELECT team FROM ant WHERE team LIKE '$NamaTim%' AND kategori='PS' AND fu_date BETWEEN '$tanggalawal' AND '$tanggalakhir' ");
      $querykt   = ("SELECT COUNT(DISTINCT track_id) AS jumlah FROM ant WHERE NOT kategori='PS' AND kategori='Kendala Teknis' AND fu_date BETWEEN '$tanggalawal' AND '$tanggalakhir' AND team LIKE '$NamaTim%'");
      $querykp   = ("SELECT COUNT(DISTINCT track_id) AS jumlah FROM ant WHERE NOT kategori='PS' AND kategori='Kendala Pelanggan' AND fu_date BETWEEN '$tanggalawal' AND '$tanggalakhir' AND team LIKE '$NamaTim%'");


    } elseif ($_GET['laporan'] == "bulan_ini") {
      $sday  = date('01-m-yy');
      $today = date('yy-m-d');

      $queryteam = ("SELECT DISTINCT team FROM ant WHERE team LIKE '$NamaTim%' AND fu_date BETWEEN '$sday' AND '$today'");
      $queryps   = ("SELECT team FROM ant WHERE team LIKE '$NamaTim%' AND kategori='PS' AND fu_date BETWEEN '$sday' AND '$today' ");
      $querykt   = ("SELECT COUNT(DISTINCT track_id) AS jumlah FROM ant WHERE NOT kategori='PS' AND kategori='Kendala Teknis' AND fu_date BETWEEN '$sday' AND '$today' AND team LIKE '$NamaTim%'");
      $querykp   = ("SELECT COUNT(DISTINCT track_id) AS jumlah FROM ant WHERE NOT kategori='PS' AND kategori='Kendala Pelanggan' AND fu_date BETWEEN '$sday' AND '$today' AND team LIKE '$NamaTim%'");

    }else {
      header("Location: /report.php?laporan=hari_ini");
      exit();
    }
  }else {
    header("Location: /report.php?laporan=hari_ini");
    exit();
  }


  $jumlahteam = $link->query($queryteam)->num_rows;
  $jumlahps   = $link->query($queryps)->num_rows;
  $jumlahkt   = $link->query($querykt)->fetch_array();
  $jumlahkp   = $link->query($querykp)->fetch_array();


  $totalkendala   = $jumlahkp['jumlah']+$jumlahkt['jumlah'];
  $totalwo = $totalkendala+$jumlahps;
  if ($totalwo == 0) {
    $pswo = 0;
  } else {
    $pswo = $jumlahps / $totalwo * 100;
  }

  if ($pswo > 90) {
    echo "<tr class='table-success'>";
  }elseif ($pswo > 80) {
    echo "<tr class='table-warning'>";
  }elseif ($pswo< 80) {
    echo "<tr class='table-danger'>";
  }

  echo "<td>$i</td>";
  echo "<td>".$NamaTim."</td>";
  echo "<td>".$jumlahteam."</td>";
  echo "<td>".$totalwo."</td>";
  echo "<td>".$jumlahps."</td>";
  echo "<td>".$jumlahkt['jumlah']."</td>";
  echo "<td>".$jumlahkp['jumlah']."</td>";
  echo "<td>".$totalkendala."</td>";
  echo "<td>".ceil($pswo)."%</td>";
  echo "</tr>";
};

function PrintTable($Nama_Area, $row){
echo "  <table class='table table-sm table-bordered table-hover'>";
echo "    <thead class='thead-dark'>";
echo "      <tr>";
echo "        <th scope='col' style='width: 10%'>AREA</th>";
echo "        <th scope='col' style='width: 5%'>NO</th>";
echo "        <th scope='col' style='width: 10%'>NAMA TIM</th>";
echo "        <th scope='col' style='width: 10%'>TOTAL TIM</th>";
echo "        <th scope='col' style='width: 10%'>TOTAL WO</th>";
echo "        <th scope='col' style='width: 10%'>PS</th>";
echo "        <th scope='col' style='width: 10%'>KENDALA TEKNIS</th>";
echo "        <th scope='col' style='width: 10%'>KENDALA PELANAGGAN</th>";
echo "        <th scope='col' style='width: 10%'>TOTAL KENDALA</th>";
echo "        <th scope='col' style='width: 10%'>%PS/WO</th>";
echo "      </tr>";
echo "    </thead>";
echo "    <tbody>";
echo "      <th scope='row' rowspan='".$row."'>".$Nama_Area."</th>";
}

function PrintTableClose()
{
echo "  </tbody>";
echo "</table>";
}

function PrintIndexTable($sto)
{
echo "  <table class='table table-sm table-bordered table-hover' id='$sto'>";
echo "    <thead class='thead-dark'>";
echo "      <tr>";
echo "        <th scope='col' style='padding-left: 20px; padding-right: 20px;'>AREA</th>";
echo "        <th scope='col'>NAMA TIM</th>";
echo "        <th scope='col'>JUMLAH HARI KERJA</th>";
echo "        <th scope='col'>TOTAL WO</th>";
echo "        <th scope='col' style='padding-left: 20px; padding-right: 20px;'>PS</th>";
echo "        <th scope='col'>KENDALA TEKNISI</th>";
echo "        <th scope='col'>KENDALA PELANGGAN</th>";
echo "        <th scope='col'>TOTAL KENDALA</th>";
echo "        <th scope='col'>%PS/WO</th>";
echo "        <th scope='col'>PRODUKTIVITAS</th>";
echo "      </tr>";
echo "    </thead>";
echo "    <tbody>";
}


 ?>

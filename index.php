<!DOCTYPE html>
<html lang="en" dir="ltr">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.16.0/dist/bootstrap-table.min.css">

<style media="screen">
body{
  text-align: center;
}
.table td, .table th{
  vertical-align: middle;
}

.table thead th{
  vertical-align: middle;
}
table{
    table-layout: fixed;
    word-wrap: break-word;
    margin: 20px 0;
}
</style>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Home</title>
</head>


<body>

  <?php
  include_once 'navbar.php';
  include 'function/function.php';
  include 'function/filter.php';
  ?>

  <div class="container">
    <h1 class="text-center">Report Performansi Teknisi</h1>
    <h5 class="text-center"><?php echo $periode ?></h5>
    <div class="row">
      <div class="col-2">
        <div class="dropdown">
          <button class="btn btn-secondary dropdown-toggle btn-block" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Hari Ini</button>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" id="hari" href="index.php?periode=hari">Hari Ini</a>
            <a class="dropdown-item" id="minggu" href="index.php?periode=minggu">Minggu Ini</a>
            <a class="dropdown-item" id="bulan" href="index.php?periode=bulan">Bulan Ini</a>
          </div>
        </div>

      </div>
    </div>
    <br>
    <div class="row">

      <?php

      $querywilayah = ("SELECT DISTINCT nama_wilayah FROM wilayah JOIN mitra ON mitra.id_wilayah = wilayah.id JOIN teknisi ON teknisi.id_mitra = mitra.id JOIN customer ON customer.id_teknisi = teknisi.id WHERE last_update BETWEEN '$rangeawal' AND '$rangeakhir'  ORDER BY nama_wilayah");
      $resultwilayah = $link->query($querywilayah) or die($link->error);
      while ($wilayah = $resultwilayah->fetch_assoc()) {
        $datawilayah = $wilayah['nama_wilayah'];
        ?>


        <table   data-toggle="table" class="table table-lg table-bordered table-hover ">
          <thead class='thead-dark' id="<?php echo $datawilayah ?>">
            <tr>
              <th colspan="10">AREA - <?php echo $datawilayah ; ?></th>
            </tr>
            <tr>
              <th scope='col'class="wrap-text" data-sortable="true" >NAMA TIM</th>
              <th scope='col'class="wrap-text" data-sortable="true" >TOTAL TIM</th>
              <th scope='col'class="wrap-text" data-sortable="true" >JUMLAH HARI KERJA</th>
              <th scope='col'class="wrap-text" data-sortable="true" >TOTAL WO</th>
              <th scope='col'class="wrap-text" data-sortable="true" >PS</th>
              <th scope='col'class="wrap-text" data-sortable="true" >KENDALA TEKNISI</th>
              <th scope='col'class="wrap-text" data-sortable="true" >KENDALA PELANGGAN</th>
              <th scope='col'class="wrap-text" data-sortable="true" >TOTAL KENDALA</th>
              <th scope='col'class="wrap-text"  data-sortable="true"  > %PS/WO</th>
              <th scope='col'class="wrap-text" data-sortable="true" >PRODUKTIVITAS</th>
            </tr>
          </thead>
          <tbody>
            <?php

            $querymitra = ("SELECT DISTINCT nama_mitra, mitra.id FROM mitra JOIN teknisi ON teknisi.id_mitra = mitra.id JOIN customer ON customer.id_teknisi = teknisi.id JOIN wilayah ON id_wilayah = wilayah.id  WHERE nama_wilayah = '$datawilayah' AND last_update BETWEEN '$rangeawal' AND '$rangeakhir'   ORDER BY nama_mitra");
            $resultmitra = $link->query($querymitra);
            $jumlahmitra = $resultmitra->num_rows;
            $jumlahmitra+=1;

            while ($mitra = $resultmitra->fetch_assoc()) {
              $idmitra = $mitra['id'];

              $queryps = ("SELECT * FROM customer JOIN teknisi ON customer.id_teknisi = teknisi.id JOIN kendala ON customer.id_kendala = kendala.id WHERE id_mitra = $idmitra AND kendala.kategori_kendala = 'PS' AND last_update BETWEEN '$rangeawal' AND '$rangeakhir' ");
              $ps = $link->query($queryps)->num_rows;

              $querykt = ("SELECT * FROM customer JOIN teknisi ON customer.id_teknisi = teknisi.id JOIN kendala ON customer.id_kendala = kendala.id WHERE id_mitra = $idmitra AND kendala.kategori_kendala = 'KENDALA TEKNISI' AND last_update BETWEEN '$rangeawal' AND '$rangeakhir' ");
              $kt = $link->query($querykt)->num_rows;

              $querykp = ("SELECT * FROM customer JOIN teknisi ON customer.id_teknisi = teknisi.id JOIN kendala ON customer.id_kendala = kendala.id WHERE id_mitra = $idmitra AND kendala.kategori_kendala = 'KENDALA PELANGGAN' AND last_update BETWEEN '$rangeawal' AND '$rangeakhir'");
              $kp = $link->query($querykp)->num_rows;


              $querykehadiran = ("SELECT * FROM kehadiran JOIN teknisi ON kehadiran.id_teknisi = teknisi.id WHERE id_mitra = $idmitra AND date BETWEEN '$rangeawal' AND '$rangeakhir'");
              $kehadiran = $link->query($querykehadiran)->num_rows;

              $querytotaltim = ("SELECT DISTINCT nama_team FROM teknisi JOIN customer ON customer.id_teknisi = teknisi.id WHERE id_mitra = $idmitra AND last_update BETWEEN '$rangeawal' AND '$rangeakhir'");
              $totaltim = $link->query($querytotaltim)->num_rows;


              if ($ps == 0 || $kehadiran == 0) {
                $produktivitas = 0;
              }else {
                $produktivitas = $ps/$kehadiran;
              }
              $totalkendala = $kp + $kt;
              $totalwo      = $ps + $totalkendala;
              if ($ps == 0) {
                $pswo = 0;
              }else {
                $pswo       = ($ps/$totalwo)*100;
              }


              if ($pswo > 90) {
                echo "<tr class='table-success'>";
              }elseif ($pswo >= 80) {
                echo "<tr class='table-warning'>";
              }else {
                echo "<tr class='table-danger'>";
              }
              ?>
                <td><?php echo $mitra['nama_mitra'] ?></td>
                <td><?php echo $totaltim ?></td>
                <td><?php echo $kehadiran ?></td>
                <td><?php echo $totalwo ?></td>
                <td><?php echo $ps ?></td>
                <td><?php echo $kt ?></td>
                <td><?php echo $kp ?></td>
                <td><?php echo $totalkendala ?></td>
                <td><?php echo sprintf("%.0f", $pswo)."%"?></td>
                <td><?php echo sprintf("%.1f", $produktivitas)?></td>
              </tr>

              <?php
            }

            ?>
          </tbody>
        </table>

        <?php
      }
      ?>

    </div>

  </div>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://unpkg.com/bootstrap-table@1.16.0/dist/bootstrap-table.min.js"></script>

  <script type="text/javascript">


    $.urlParam = function(name){
      var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
      return results[1] || 0;
    }
    var periode = $('#'+$.urlParam('periode'))
    $('#dropdownMenuButton').text(periode.text())

  $('thead').click(function(){
    var id = $(this).attr('id');
    $('#'+id+'body').fadeToggle();
  })
</script>

</body>
</html>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
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
</style>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Report Performansi Teknisi</title>
</head>


<body>

  <?php
  include_once '../navbar.php';
  include '../function/function.php';
  include_once '../function/filter.php';

  ?>

  <div class="container">
    <h1 class="text-center">Report Performansi Teknisi</h1>
    <div class="row">
      <div class="offset-10 col">
        <div class="dropdown">
          <button class="btn btn-secondary dropdown-toggle btn-block" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Hari Ini</button>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" id="hari" href="performansi.php?periode=hari">Hari Ini</a>
            <a class="dropdown-item" id="minggu" href="performansi.php?periode=minggu">Minggu Ini</a>
            <a class="dropdown-item" id="bulan" href="performansi.php?periode=bulan">Bulan Ini</a>
          </div>
        </div>
      </div>
    </div>
    <br>
    <div class="row">
      <table class="table table-striped table-bordered">
        <thead>
          <tr>
            <th scope="col">No</th>
            <th scope="col">Nama Mitra</th>
            <th scope="col">STO</th>
            <th scope="col">Total Tim</th>
            <th scope="col">Total WO</th>
            <th scope="col">PS</th>
            <th scope="col">Kendala Teknisi</th>
            <th scope="col">Kendala Pelanggan</th>
            <th scope="col">Total Kendala</th>
            <th scope="col">%PS/WO</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $querymitra  = ("SELECT * FROM mitra ORDER BY nama_mitra");
          $resultmitra = $link->query($querymitra);
          $no = 1;

          while ($hasildatamitra  = $resultmitra->fetch_assoc()) {
            $mitra    = $hasildatamitra['nama_mitra'];
            $id_mitra = $hasildatamitra['id'];

            $querytotaltim = ("SELECT * FROM teknisi JOIN customer ON customer.id_teknisi = teknisi.id WHERE id_mitra = $id_mitra AND last_update BETWEEN '$rangeawal' AND '$rangeakhir'");
            $totaltim = $link->query($querytotaltim)->num_rows;

            $querysto = ("SELECT DISTINCT nama_sto FROM teknisi JOIN list_sto ON id_teknisi = teknisi.id JOIN sto ON list_sto.id_sto = sto.id JOIN customer ON customer.id_teknisi = teknisi.id WHERE id_mitra = $id_mitra AND last_update BETWEEN '$rangeawal' AND '$rangeakhir'");
            $sto = $link->query($querysto);


            $queryps = ("SELECT * FROM customer JOIN teknisi ON customer.id_teknisi = teknisi.id JOIN kendala ON customer.id_kendala = kendala.id WHERE id_mitra = $id_mitra AND kendala.kategori_kendala = 'PS' AND last_update BETWEEN '$rangeawal' AND '$rangeakhir' ");
            $ps = $link->query($queryps)->num_rows;

            $querykt = ("SELECT * FROM customer JOIN teknisi ON customer.id_teknisi = teknisi.id JOIN kendala ON customer.id_kendala = kendala.id WHERE id_mitra = $id_mitra  AND kendala.kategori_kendala = 'KENDALA TEKNISI'AND last_update BETWEEN '$rangeawal' AND '$rangeakhir' ");
            $kt = $link->query($querykt)->num_rows;

            $querykp = ("SELECT * FROM customer JOIN teknisi ON customer.id_teknisi = teknisi.id JOIN kendala ON customer.id_kendala = kendala.id WHERE id_mitra = $id_mitra  AND kendala.kategori_kendala = 'KENDALA PELANGGAN' AND last_update BETWEEN '$rangeawal' AND '$rangeakhir'");
            $kp = $link->query($querykp)->num_rows;

            $totalkendala = $kp + $kt;
            $totalwo      = $ps + $totalkendala;
            if ($ps == 0) {
              $pswo = 0;
            }else {
              $pswo       = ($ps/$totalwo)*100;
            }


            ?>
            <tr>
              <th scope="row"><?php echo $no ?></th>
              <td><?php echo $mitra ?></td>
              <td><?php
              $liststo = array();
              while ($hasilsto = $sto->fetch_assoc()) {
               array_push($liststo,  $hasilsto['nama_sto'], '-');
              }

              for ($i=0; $i < count($liststo)-1; $i++) {
                echo $liststo[$i];
              }

              ?></td>
              <td><?php echo $totaltim ?></td>
              <td><?php echo $totalwo ?></td>
              <td><?php echo $ps ?></td>
              <td><?php echo $kt ?></td>
              <td><?php echo $kp ?></td>
              <td><?php echo $totalkendala ?></td>
              <td><?php echo $pswo ?>%</td>
            </tr>

            <?php
            $no++;
          }
          ?>
        </tbody>
      </table>
    </div>

  </div>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script type="text/javascript">

  $.urlParam = function(name){
    var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
    return results[1] || 0;
  }
  var periode = $('#'+$.urlParam('periode'))
  $('#dropdownMenuButton').text(periode.text())
  </script>

</body>
</html>

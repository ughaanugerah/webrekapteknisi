<!DOCTYPE html>
<html lang="en" dir="ltr">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<style media="screen">
.table td, .table th{
  vertical-align: middle;
}

</style>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Home</title>
</head>


<body>

  <?php
  include_once '../navbar.php';
  include '../function/function.php';
  ?>
  <div class="container">
    <h1 class="text-center">Report Kendala Teknisi</h1>
    <div class="row">
      <div class="offset-10 col">
        <div class="dropdown">
          <button class="btn btn-secondary dropdown-toggle btn-block" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Hari Ini</button>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" id="hari" href="kendala.php?periode=hari">Hari Ini</a>
            <a class="dropdown-item" id="minggu" href="kendala.php?periode=minggu">Minggu Ini</a>
            <a class="dropdown-item" id="bulan" href="kendala.php?periode=bulan">Bulan Ini</a>
          </div>
        </div>
      </div>
    </div>
    <br>

    <table class="table table-hover table-sm table-bordered ">
      <thead class="thead-light">
        <tr>
          <th scope="col" class="text-center">Kendala</th>
          <th scope="col">Tipe Kendala</th>
          <th scope="col">Total Kendala</th>
          <th scope="col">Berhasil PS</th>
          <th scope="col">%PS/Kendala</th>
        </tr>
      </thead>
      <tbody>
        <?php

        include_once '../function/filter.php';


        $querygetkendala = ("SELECT DISTINCT kategori_kendala FROM kendala WHERE NOT kategori_kendala = 'PS' AND NOT kategori_kendala = 'INPUT-RE' ");
        $getkendala = $link->query($querygetkendala);

        while ($getkendaladata = $getkendala->fetch_assoc() ) {

          $totalkendalateknisi = 0;
          $totalberhasilpsteknisi = 0;
          $totalkendalapelanggan = 0;
          $totalberhasilpspelanggan = 0;

          $kendala = GetKendala($getkendaladata['kategori_kendala']);
          $jumlah = count($kendala);

          echo "<th scope='row' rowspan=' ".($jumlah+1)."' class='text-center'>".$getkendaladata['kategori_kendala']."</th>";


          foreach ($kendala as $key => $value) {
            $namakendala = $value['nama_kendala'];
            $idkendala = $value['id'];

            $queryhitung = ("SELECT DISTINCT id_customer FROM distribusi WHERE id_kendala = '$idkendala' AND fu_date BETWEEN '$rangeawal' AND '$rangeakhir'");
            $hitung = $link->query($queryhitung)->num_rows;

            $queryberhasilps = ("SELECT id_customer FROM distribusi WHERE id_kendala = '$idkendala' AND fu_date BETWEEN '$rangeawal' AND '$rangeakhir' AND EXISTS (SELECT * FROM customer WHERE id_kendala = 31 AND distribusi.id_customer = customer.id AND last_update BETWEEN '$rangeawal' AND '$rangeakhir')");
            $berhasilps = $link->query($queryberhasilps)->num_rows;

            if ($hitung == 0) {
              $pskendala = 0;
            }else {
              $pskendala = ($berhasilps/$hitung)*100;
            }


            echo "<tr>";
            echo "  <td>$namakendala</td>";
            echo "  <td>$hitung</td>";
            echo "  <td>$berhasilps</td>";
            echo "  <td>".sprintf('%.0f', $pskendala)."%</td>";
            echo "</tr>";

            $totalkendalateknisi+=$hitung;
            $totalberhasilpsteknisi+=$berhasilps;

            if ($totalberhasilpsteknisi == 0 || $totalkendalateknisi == 0) {
              $totalpskendala = 0;
            }else {
              $totalpskendala = ($totalberhasilpsteknisi/$totalkendalateknisi)*100;
            }



          }

          echo "<tr class='table-active'>";
          echo "  <th colspan='2' class='text-center'>Total Kendala Pelanggan</th>";
          echo "  <td> $totalkendalateknisi</td>";
          echo "  <td> $totalberhasilpsteknisi</td>";
          echo "  <td>".sprintf('%.0f', $totalpskendala)."%</td>";
          echo "</tr>";
        }
        echo $periode;
        ?>


      </tbody>
    </table>

  </div>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

</script>
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

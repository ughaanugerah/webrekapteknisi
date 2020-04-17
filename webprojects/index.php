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
  <title>Home</title>
</head>


<body>

  <?php
  include_once 'navbar.php';
  include 'global_function.php';
  include 'function/function.php';
  ?>

  <div class="container">
    <h1 class="text-center">Report Performansi Teknisi</h1>
    <div class="row">
      <div class="offset-10 col">

        <select class="browser-default custom-select" id="sto" name="sto" required>
          <option value=''> Filter</option>
        </select>
      </div>
    </div>
    <br>
    <div class="row">

      <?php
      $querysto  = ("SELECT * FROM sto");
      $resultsto = $link->query($querysto);
      while ($hasildatasto  = $resultsto->fetch_assoc()) {
        $sto    = $hasildatasto['nama_sto'];
        $id_sto = $hasildatasto['id'];

        $querycustomer = ("SELECT * FROM customer JOIN teknisi ON customer.id_teknisi = teknisi.id WHERE id_sto = $id_sto");
        $resultcustomer = $link->query($querycustomer);
        $checkdata = $resultcustomer->num_rows;
        if ($checkdata > 0) {

          $querynamateam = ("SELECT DISTINCT nama_team, id_teknisi FROM customer JOIN teknisi ON customer.id_teknisi = teknisi.id WHERE id_sto = $id_sto");
          $resultnamateam = $link->query($querynamateam);
          $jumlah = $resultnamateam->num_rows;
          $jumlah+= 1;
          ?>


          <table class="table table-bordered table-hover">
            <thead class='thead-dark' id="<?php echo $sto; ?>">
              <tr>
                <th scope='col' style='padding-left: 20px; padding-right: 20px;'>AREA</th>
                <th scope='col'>NAMA TIM</th>
                <th scope='col'>JUMLAH HARI KERJA</th>
                <th scope='col'>TOTAL WO</th>
                <th scope='col' style='padding-left: 20px; padding-right: 20px;'>PS</th>
                <th scope='col'>KENDALA TEKNISI</th>
                <th scope='col'>KENDALA PELANGGAN</th>
                <th scope='col'>TOTAL KENDALA</th>
                <th scope='col'>%PS/WO</th>
                <th scope='col'>PRODUKTIVITAS</th>
              </tr>
            </thead>
            <tbody id="<?php echo $sto; ?>body">
              <th scope='row' rowspan='<?php echo $jumlah; ?>'> <?php echo $sto; ?> </th>

              <?php

              while ($data = $resultnamateam->fetch_assoc()) {
                $namateam = $data['nama_team'];
                $id_team  = $data['id_teknisi'];

                $queryps = ("SELECT * FROM customer JOIN teknisi ON customer.id_teknisi = teknisi.id JOIN kendala ON customer.id_kendala = kendala.id WHERE id_sto = $id_sto AND id_teknisi = '$id_team' AND kendala.kategori_kendala = 'PS' ");
                $ps = $link->query($queryps)->num_rows;

                $querykt = ("SELECT * FROM customer JOIN teknisi ON customer.id_teknisi = teknisi.id JOIN kendala ON customer.id_kendala = kendala.id WHERE id_sto = $id_sto AND nama_team = '$namateam' AND kendala.kategori_kendala = 'KENDALA TEKNISI' ");
                $kt = $link->query($querykt)->num_rows;

                $querykp = ("SELECT * FROM customer JOIN teknisi ON customer.id_teknisi = teknisi.id JOIN kendala ON customer.id_kendala = kendala.id WHERE id_sto = $id_sto AND nama_team = '$namateam' AND kendala.kategori_kendala = 'KENDALA PELANGGAN' ");
                $kp = $link->query($querykp)->num_rows;

                $querykehadiran = ("SELECT * FROM kehadiran WHERE id_teknisi = $id_team");
                $kehadiran = $link->query($querykehadiran)->num_rows;

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
                }elseif ($pswo > 80) {
                  echo "<tr class='table-warning'>";
                }else {
                  echo "<tr class='table-danger'>";
                }

                echo "<td>".$namateam ."</td>";
                echo "<td>".$kehadiran ."</td>";
                echo "<td>".$totalwo ."</td>";
                echo "<td>".$ps ."</td>";
                echo "<td>".$kt ."</td>";
                echo "<td>".$kp ."</td>";
                echo "<td>".$totalkendala ."</td>";
                echo "<td>".$pswo ."%</td>";
                echo "<td>".sprintf("%.1f", $produktivitas) ."</td>";
                ?>
              </tr>
              <?php
            }
            ?>


          </tbody>
        </table>


        <?php
      }

    }
    ?>
  </div>

</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript">


$('thead').click(function(){
  var id = $(this).attr('id');
  $('#'+id+'body').fadeToggle();
  console.log(id);
})
</script>

</body>
</html>

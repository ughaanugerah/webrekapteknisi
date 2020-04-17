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
  include_once '../navbar.php';
  include '../function/function.php';

  ?>

  <div class="container">
    <h1 class="text-center">Report PSB Witel Makassar</h1>
    <h5 class="text-left"> Tanggal: <?php echo date('d-m-Y'); ?></h5>
    <div class="row">
      <table class="table table-striped table-hover">
        <thead>
          <tr>
            <th scope="col">AREA</th>
            <th scope="col">JUMLAH TIM</th>
            <th scope="col">RE ALL</th>
            <th scope="col">RE TER-DIST</th>
            <th scope="col">SURVEY</th>
            <th scope="col">KENDALA</th>
            <th scope="col">OGP INSTALL</th>
            <th scope="col">DONE INSTALL</th>
            <th scope="col">DONE INS NO PS</th>
            <th scope="col">PS</th>
          </tr>
        </thead>
        <tbody>
          <?php


          $AREA = array(
            'ANTANG',
            'BALAIKOTA',
            'BULUKUMBA',
            'BANTAENG',
            'JENEPONTO',
            'KIMA',
            'MALINO',
            'MAROS',
            'MATTOANGIN',
            'PANGKEP',
            'PANAKUKANG',
            'SINJAI',
            'SELAYAR',
            'SUDIANG',
            'SUNGGUMINASA',
            'TAKALAR',
            'TAMALANREA',
            'WATAMPONE'
          );

          global $link;

          $querysto  = ("SELECT * FROM sto");
          $resultsto = $link->query($querysto);
          $namasto = array();

          while ($hasildatasto  = $resultsto->fetch_assoc()) {
            $namasto[] = $hasildatasto['id'];
          }

          $totalteam         = 0;
          $totalredist       = 0;
          $totalsurvey       = 0;
          $totalkendala      = 0;
          $totalogpinstall   = 0;
          $totaldoneinstall  = 0;
          $totalnops         = 0;
          $totalps           = 0;

          $AREA = array_combine($namasto,$AREA);
          foreach ($AREA as $key => $value) {

            $queryteam = ("SELECT * FROM kehadiran JOIN teknisi ON id_teknisi = teknisi.id WHERE id_sto = '$key' AND  tanggal = '$tanggal_harini'");
            $team = $link->query($queryteam)->num_rows;
            $totalteam +=$team;

            $queryredist = ("SELECT * FROM customer JOIN teknisi ON id_teknisi = teknisi.id WHERE id_sto = '$key' AND  last_update = '$tanggal_harini'");
            $redist = $link->query($queryredist)->num_rows;
            $totalredist +=$redist;

            $querysurvey = ("SELECT * FROM customer JOIN teknisi ON id_teknisi = teknisi.id JOIN kendala ON id_kendala = kendala.id  WHERE id_sto = '$key' AND  last_update = '$tanggal_harini' AND kode = 501");
            $survey = $link->query($querysurvey)->num_rows;
            $totalsurvey +=$survey;

            $querykendala = ("SELECT * FROM customer JOIN teknisi ON id_teknisi = teknisi.id JOIN kendala ON id_kendala = kendala.id WHERE id_sto = '$key' AND  last_update = '$tanggal_harini' AND kode BETWEEN 1 AND 400");
            $kendala = $link->query($querykendala)->num_rows;
            $totalkendala += $kendala;

            $queryogpinstall = ("SELECT * FROM customer JOIN teknisi ON id_teknisi = teknisi.id JOIN kendala ON id_kendala = kendala.id WHERE id_sto = '$key' AND  last_update = '$tanggal_harini' AND kode = 502 OR kode = 401");
            $ogpinstall = $link->query($queryogpinstall)->num_rows;
            $totalogpinstall += $ogpinstall;

            $querydoneinstall = ("SELECT * FROM customer JOIN teknisi ON id_teknisi = teknisi.id JOIN kendala ON id_kendala = kendala.id WHERE id_sto = '$key' AND  last_update = '$tanggal_harini' AND kode = 402");
            $doneinstall = $link->query($querydoneinstall)->num_rows;
            $totaldoneinstall += $doneinstall;

            $querynops = ("SELECT * FROM customer JOIN teknisi ON id_teknisi = teknisi.id JOIN kendala ON id_kendala = kendala.id WHERE id_sto = '$key' AND  last_update = '$tanggal_harini' AND kode BETWEEN 403 AND 405");
            $nops = $link->query($querynops)->num_rows;
            $totalnops += $nops;

            $queryps = ("SELECT * FROM customer JOIN teknisi ON id_teknisi = teknisi.id JOIN kendala ON id_kendala = kendala.id WHERE id_sto = '$key' AND  last_update = '$tanggal_harini' AND kode = 500");
            $ps = $link->query($queryps)->num_rows;
            $totalps += $ps;



            ?>
            <tr>
              <th scope="row"><?php echo $value;?></th>
              <td><?php echo $team;  ?></td>
              <td>BELUM DIATUR</td>
              <td><?php echo $redist ?></td>
              <td><?php echo $survey ?></td>
              <td><?php echo $kendala ?></td>
              <td><?php echo $ogpinstall ?></td>
              <td><?php echo $doneinstall ?></td>
              <td><?php echo $nops ?></td>
              <td><?php echo $ps ?></td>
            </tr>

            <?php
          }

          $potensips = $totalps + $totalnops + $totaldoneinstall;


          ?>
          <tr>
            <th scope="row" class="table-success">TOTAL</th>
            <td class="table-success"><?php echo $totalteam;  ?></td>
            <td class="table-success">BELUM DIATUR</td>
            <td class="table-success"><?php echo $totalredist ?></td>
            <td class="table-success"><?php echo $totalsurvey ?></td>
            <td class="table-success"><?php echo $totalkendala ?></td>
            <td class="table-success"><?php echo $totalogpinstall ?></td>
            <td class="table-success"><?php echo $totaldoneinstall ?></td>
            <td class="table-success"><?php echo $totalnops ?></td>
            <td class="table-success"><?php echo $totalps ?></td>
          </tr>
          <tr>
            <th colspan="8" class="text-right"></th>
            <td class="text-left table-danger">Potensi PS</td>
            <td class="table-danger"><?php echo $potensips ?></td>
          </tr>
        </tbody>
      </table>
    </div>

  </div>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

</body>
</html>

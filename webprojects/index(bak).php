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
          <?php
          $namasto = GetSto();
          foreach ($namasto as $key => $value) {
            $key  = $value['nama_sto'];
            $key2 = $value['id'];
            echo "<option value='".$key2."'>".$key."</option>";
          }
          ?>
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




        //PANGGIL LIST TIM
        $queryteam  = ("SELECT DISTINCT id_team, nama_team FROM distribusi JOIN teknisi ON id_team = teknisi.id WHERE distribusi.id_sto = '$id_sto' ORDER BY nama_team ASC");
        $resultteam = $link->query($queryteam) or die ($link->error);
        $jumlahteam = $resultteam->num_rows;


        if ($jumlahteam != 0) {
          $jumlahteam+=1 ;

          //PRINT HEADER
          PrintIndexTable($sto);
          echo "<th scope='row' rowspan='".$jumlahteam."'>".$sto."</th>";

          while ($hasildatateam  = $resultteam->fetch_assoc()) {
            $sday  = date('yy-m-01');
            $today = date('yy-m-d');

            $team    = $hasildatateam['nama_team'];
            $id_team = $hasildatateam['id_team'];






            /*
            SELECT DISTINCT id_customer FROM distribusi  JOIN kendala
            ON distribusi.id_kendala = kendala.id

            hasil diatas ambil id_customer

            SELECT COUNT(id_customer) AS jumlah FROM distribusi
            WHERE NOT id_kendala = 29

            hasil diatas ambil data yang bukan PS

            */




            // Query Query
            $querykerja  = ("SELECT team FROM ant WHERE team='$team' AND kategori='PS' AND sto='$sto' ");
            $queryps     = ("SELECT * FROM distribusi JOIN kendala ON distribusi.id_kendala = kendala.id WHERE id_sto = $id_sto AND id_team = $id_team AND kategori_kendala='PS'");
            $querykt     = ("SELECT DISTINCT id_customer FROM distribusi JOIN kendala ON distribusi.id_kendala = kendala.id WHERE id_sto = $id_sto AND id_team = $id_team AND kategori_kendala='KENDALA TEKNISI' AND NOT kategori_kendala='PS'");
            $querykp     = ("SELECT DISTINCT id_customer FROM distribusi JOIN kendala ON distribusi.id_kendala = kendala.id WHERE id_sto = $id_sto AND id_team = $id_team AND kategori_kendala='KENDALA PELANGGAN' AND NOT kategori_kendala='PS'");

            $querydist = ("SELECT * FROM distribusi JOIN kendala ON distribusi.id_kendala = kendala.id WHERE id_sto = $id_sto AND id_team = $id_team");
            $resultdist = $link->query($querydist);


            $resultps = $link->query($queryps);
            $resultps = $resultps->num_rows;

            $resultkt = $link->query($querykt);
            $resultkt = $resultkt->num_rows;

            $resultkp = $link->query($querykp);
            $resultkp = $resultkp->num_rows;



            $querycustomer = ("SELECT DISTINCT id_customer FROM distribusi WHERE id_team = '$id_team'");
            $hasilquerycustomer = $link->query($querycustomer);

            while ($hasilquerycustomer1 = $hasilquerycustomer->fetch_assoc()) {
              $customer = $hasilquerycustomer1['id_customer'];

              $querystatus = ("SELECT kategori_kendala  FROM distribusi JOIN kendala ON distribusi.id_kendala = kendala.id WHERE id_customer = $customer ORDER BY created_at DESC LIMIT 1");
              $hasilquerystatus= $link->query($querystatus) or die($link->error);;
              $ps = 0;
              $kt = 0;
              $kp = 0;

              while ($hasilquerystatus1 = $hasilquerystatus->fetch_assoc()) {
                $status = $hasilquerystatus1['kategori_kendala'];

                echo $status;

                if ($status == 'PS') {
                  $ps++;
                }
                if ($status == 'KENDALA TEKNISI') {
                  $kt++;
                }
                if ($status == 'KENDALA PELANGGAN') {
                  $kp++;
                }
              }
              $totalkendala = $kt + $kp;
              $totalwo = $ps + $totalkendala;
              echo "<tr>";
              echo "<td> $team </td>";
              echo "<td>  </td>";                //JUMLAH HARI KERJA
              echo "<td> $totalwo </td>";                //TOWAL WO
              echo "<td> $ps </td>";                //PS
              echo "<td> $kt </td>";                //KENDALA TEKNISI
              echo "<td> $kp </td>";                //KENDALA PELANGGAN
              echo "<td> $totalkendala </td>";                //TOTAL KENDALA
              echo "<td> ADAKAH</td>";                //%PS/WO
              echo "<td> ADAKAH</td>";                //PRODUKTIVITAS
              echo "</tr>";

            }



          }

        }

      }
      $link->close();

      ?>


    </tbody>
  </table>

</div>

</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


</body>
</html>

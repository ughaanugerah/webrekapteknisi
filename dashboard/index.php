<!DOCTYPE html>
<html lang="en" dir="ltr">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<style media="screen">
.border{
  margin: 20px 0;
  padding : 20px;
}

.border img{
  width: 100%;
  background-color: #000;
}
.border h5{
  margin-bottom: 20px;
}

.accomplishment{
  height: 100%;
  width: 100%;
  background-color: #dc3545;
  padding: 1rem 2rem;

}

.accomplishment p{
  vertical-align: middle;
  text-align: center;
  margin: 0;
  color: #f8f9fa;
}

.table-responsive {
  height: 200px;
}

.table{
  width: 120%;

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
  include_once '../function/preventaccess.php';

  $querycheck = ("SELECT role FROM user WHERE username = '$username'");
  $check = $link->query($querycheck)->fetch_assoc();
  if ($check['role'] == 1) {
    header('Location: ../admin/index.php');
  }

  ?>

  <div class="container">
    <h1>Dashboard</h1>


    <div class="border rounded">
      <h5>PERSONAL INFO</h5>
      <div class="row">

        <?php

        $mitra = array();
        $wilayah = array();
        $sto = array();
        $idsto = array();
        $team = 0;
        $totalps = 0;
        $totalkendala = 0;
        $totalpskemarin = 0;
        $totalkendalakemarin = 0;
        $totaltimhariini = 0;

        $queryuser = ("SELECT * FROM user WHERE username='$username'");
        $user = $link->query($queryuser)->fetch_assoc();

        $iduser = $user['id'];
        $querylist_mitra = ("SELECT nama_wilayah, nama_mitra, mitra.id  FROM list_mitra JOIN mitra ON id_mitra = mitra.id JOIN wilayah ON id_wilayah = wilayah.id WHERE id_user = '$iduser' ");
        $list_mitra = $link->query($querylist_mitra);

        while ($datamitra = $list_mitra->fetch_assoc()) {
          $idmitra = $datamitra['id'];

          //STO
          $queryliststo = ("SELECT DISTINCT sto.id, nama_sto FROM sto JOIN list_sto ON list_sto.id_sto = sto.id JOIN teknisi ON list_sto.id_teknisi = teknisi.id   WHERE id_mitra = $idmitra");
          $liststo = $link->query($queryliststo);
          while ($datasto = $liststo->fetch_assoc()) {
            array_push($sto, $datasto['nama_sto']);
            array_push($idsto, $datasto['id']);
          }

          // WILAYAH
          $querylistwilayah = ("SELECT nama_wilayah FROM wilayah JOIN mitra ON wilayah.id = id_wilayah WHERE mitra.id = $idmitra");
          $listwilayah = $link->query($querylistwilayah);
          while ($datawilayah = $listwilayah->fetch_assoc()) {
            array_push($wilayah, $datawilayah['nama_wilayah']);
          }

          // JUMLAH TEAM
          $querydatateam = ("SELECT DISTINCT nama_team  FROM teknisi WHERE id_mitra = '$idmitra' ");
          $datateam = $link->query($querydatateam)->num_rows;
          $team += $datateam;

          // JUMLAH TIM HARI INI
          $queryteamhariini = ("SELECT date FROM kehadiran JOIN teknisi ON id_teknisi = teknisi.id WHERE id_mitra = '$idmitra' AND date = '$tanggal_hariini'");
          $datateamhariini = $link->query($queryteamhariini)->num_rows;
          $totaltimhariini += $datateamhariini;

          // NAMA MITRA
          array_push($mitra, $datamitra['nama_mitra']);
          array_push($mitra, ', ');

          // PS
          $queryps = ("SELECT * FROM customer JOIN kendala ON id_kendala = kendala.id JOIN teknisi ON id_teknisi = teknisi.id WHERE id_mitra = '$idmitra' AND last_update BETWEEN '$tanggal_awalbulan' AND '$tanggal_akhirbulan' AND kategori_kendala = 'PS'");
          $ps = $link->query($queryps)->num_rows;
          $totalps += $ps;

          // PS KEMARIN
          $querypskemarin = ("SELECT * FROM customer JOIN kendala ON id_kendala = kendala.id JOIN teknisi ON id_teknisi = teknisi.id WHERE id_mitra = '$idmitra' AND last_update BETWEEN '$tanggal_awalbulan' AND '$tanggal_kemarin' AND kategori_kendala = 'PS'");
          $pskemarin = $link->query($querypskemarin)->num_rows;
          $totalpskemarin += $pskemarin;

          // KENDALA
          $querykendala = ("SELECT * FROM customer JOIN kendala ON id_kendala = kendala.id JOIN teknisi ON id_teknisi = teknisi.id WHERE id_mitra = '$idmitra' AND last_update BETWEEN '$tanggal_awalbulan' AND '$tanggal_akhirbulan' AND NOT kategori_kendala = 'PS'");
          $kendala = $link->query($querykendala)->num_rows;
          $totalkendala += $kendala;

          // KENDALA
          $querykendalakemarin = ("SELECT * FROM customer JOIN kendala ON id_kendala = kendala.id JOIN teknisi ON id_teknisi = teknisi.id WHERE id_mitra = '$idmitra' AND last_update BETWEEN '$tanggal_awalbulan' AND '$tanggal_kemarin' AND NOT kategori_kendala = 'PS'");
          $kendalakemarin = $link->query($querykendalakemarin)->num_rows;
          $totalkendalakemarin += $kendalakemarin;




        }
        $wilayah= array_unique($wilayah);
        $sto= array_unique($sto);
        $idsto= array_unique($idsto);



        ?>


        <div class="col-2">
          <img src="<?php echo $user['image']; ?>" alt="GAMBAR" class="rounded-circle">
        </div>

        <div class="col-2 offset-1">
          <p class="font-weight-bold">USER</p>
          <p class="font-weight-bold">MITRA</p>
          <p class="font-weight-bold">AREA</p>
          <p class="font-weight-bold">STO</p>
        </div>

        <div class="col">
          <p class="font-weight-bold">:&nbsp <?php echo $user['username'] ?></p>
          <p class="font-weight-bold">:&nbsp <?php for ($i=0; $i < count($mitra)-1; $i++) {
            echo $mitra[$i];
          } ?></p>

          <p class="font-weight-bold">:&nbsp <?php

          foreach ($wilayah as $key => $value) {
            echo $value;
            echo " ";
          }




          ?></p>

          <p class="font-weight-bold">:&nbsp <?php

          foreach ($sto as $key => $value) {
            echo $value;
            echo " ";
          }
          ?></p>

        </div>
      </div>
    </div>

    <div class="border rounded">
      <h5>ACCOMPLISHMENT</h5>
      <div class="row">
        <div class="col-2 offset-1 accomplishment rounded">
          <p class="h5">PS</p>
          <p class="font-weight-bold h1"><?php echo $totalps ?></p>
          <p>HARI INI: <?php echo $totalps-$totalpskemarin ?></p>
        </div>
        <div class="col-2 offset-2 accomplishment rounded">
          <p class="h5">KENDALA</p>
          <p class="font-weight-bold h1"><?php echo $totalkendala ?></p>
          <p>HARI INI: <?php echo $totalkendala-$totalkendalakemarin ?></p>
        </div>
        <div class="col-2 offset-2 accomplishment rounded">
          <p class="h5">TOTAL TIM</p>
          <p class="font-weight-bold h1"><?php echo $team ?></p>
          <p>HARI INI: <?php echo $totaltimhariini; ?></p>
        </div>
      </div>
    </div>

    <!-- RE NO TIM -->
    <div class="border rounded col">
      <div class="row justify-content-between">
        <div class="col-4">
          <?php

          foreach ($idsto as $key => $value) {
            $jumlahre = $link->query("SELECT * FROM customer JOIN sto ON id_sto = sto.id JOIN user ON created_by = user.id WHERE id_teknisi IS NULL AND id_sto = '$value'")->num_rows or die($link->error);
          }

          ?>
          <h5>RE NO TIM &nbsp;<span class="badge badge-danger"><?php echo $jumlahre ?></span> </h5>

        </div>
        <div class="col-2">
          <a class="btn btn-block btn-link" href="#" role="button">Show All</a>
        </div>
      </div>
      <div class="table-responsive">

        <table class="table">
          <thead>
            <tr>
              <th scope="col">Action</th>
              <th scope="col">Track ID</th>
              <th scope="col">Nama Customer</th>
              <th scope="col">STO</th>
              <th scope="col">Order Date</th>
              <th scope="col">Created By</th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($idsto as $key => $value) {
              $queryre = ("SELECT * FROM customer JOIN sto ON id_sto = sto.id JOIN user ON created_by = user.id WHERE id_teknisi IS NULL AND id_sto = '$value'");
              $re = $link->query($queryre) or die($link->error);

              $re->num_rows;


              while ($datare = $re->fetch_assoc()) {
                ?>
                <tr>
                  <th scope="row">
                    <a href="../form/index.php?track_id=<?php echo $datare['track_id'] ?>" title="Set Tim">
                      <svg class="bi bi-arrow-up-square-fill text-danger" width="1.5em" height="1.5em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm3.354 8.354a.5.5 0 1 1-.708-.708l3-3a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 6.207V11a.5.5 0 0 1-1 0V6.207L5.354 8.354z"/>
                      </svg>
                    </a>
                  </th>
                  <td><?php echo $datare['track_id'] ?></td>
                  <td><?php echo $datare['nama_customer'] ?></td>
                  <td><?php echo $datare['nama_sto'] ?></td>
                  <td><?php echo $datare['order_date'] ?></td>
                  <td><?php echo $datare['username'] ?></td>
                </tr>

                <?php
              }
            }
            ?>
          </tbody>
        </table>
      </div>

    </div>

    <!-- KENDALA -->
    <div class="border rounded col">
      <div class="row justify-content-between">
        <div class="col-4">
          <?php

          foreach ($idsto as $key => $value) {
            $jumlahkendala = $link->query("SELECT * FROM customer JOIN kendala ON id_kendala = kendala.id JOIN sto ON customer.id_sto = sto.id JOIN teknisi ON customer.id_teknisi = teknisi.id WHERE NOT nama_kendala = 'PS' AND customer.id_sto = '$value'")->num_rows or die($link->error);
          }

          ?>
          <h5>KENDALA&nbsp;<span class="badge badge-danger"><?php echo $jumlahkendala ?></span> </h5>

        </div>
        <div class="col-2">
          <a class="btn btn-block btn-link" href="#" role="button">Show All</a>
        </div>
      </div>
      <div class="table-responsive">

        <table class="table">
          <thead>
            <tr>
              <th scope="col">Action</th>
              <th scope="col">Track ID</th>
              <th scope="col">Nama Customer</th>
              <th scope="col">Status</th>
              <th scope="col">Teknisi</th>
              <th scope="col">STO</th>
              <th scope="col">Order Date</th>
              <th scope="col">Last Update</th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($idsto as $key => $value) {

              $queryre = ("SELECT * FROM customer JOIN kendala ON id_kendala = kendala.id JOIN sto ON customer.id_sto = sto.id JOIN teknisi ON customer.id_teknisi = teknisi.id WHERE NOT nama_kendala = 'PS' AND customer.id_sto = '$value'");
              $re = $link->query($queryre) or die($link->error);
              while ($datare = $re->fetch_assoc()) {


                ?>
                <tr>
                  <th scope="row">
                    <a href="../form/index.php?track_id=<?php echo $datare['track_id'] ?>" title="Follow Up">
                      <svg class="bi bi-arrow-up-square-fill text-danger" width="1.5em" height="1.5em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm3.354 8.354a.5.5 0 1 1-.708-.708l3-3a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 6.207V11a.5.5 0 0 1-1 0V6.207L5.354 8.354z"/>
                      </svg>
                    </a>
                    <a href="../distribusi/detail.php?track_id=<?php echo $datare['track_id'] ?>" title="Info">
                      <svg class="bi bi-info-square-fill" width="1.5em" height="1.5em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm8.93 4.588l-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM8 5.5a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
                      </svg>
                    </a>
                  </th>
                  <td><?php echo $datare['track_id'] ?></td>
                  <td><?php echo $datare['nama_customer'] ?></td>
                  <td><?php echo $datare['nama_kendala'] ?></td>
                  <td><?php echo $datare['nama_team'] ?></td>
                  <td><?php echo $datare['nama_sto'] ?></td>
                  <td><?php echo $datare['order_date'] ?></td>
                  <td><?php echo $datare['last_update'] ?></td>
                </tr>

                <?php
              }
            }
            ?>
          </tbody>
        </table>
      </div>

    </div>


    <!-- RESCHEDULE -->
    <div class="border rounded col">
      <div class="row justify-content-between">
        <div class="col-4">
          <?php

          foreach ($idsto as $key => $value) {
            $jumlahreshcedule = $link->query("SELECT * FROM customer JOIN kendala ON id_kendala = kendala.id JOIN sto ON customer.id_sto = sto.id JOIN teknisi ON customer.id_teknisi = teknisi.id WHERE kode = '201' OR kode = '211' AND customer.id_sto = '$value'")->num_rows;
            if ($jumlahreshcedule == 0) {
              $jumlahreshcedule = 0;
            }
          }

          ?>
          <h5>RESCHEDULE&nbsp;<span class="badge badge-warning"><?php echo $jumlahreshcedule ?></span> </h5>

        </div>
        <div class="col-2">
          <a class="btn btn-block btn-link" href="#" role="button">Show All</a>
        </div>
      </div>
      <div class="table-responsive">

        <table class="table">
          <thead>
            <tr>
              <th scope="col">Action</th>
              <th scope="col">Track ID</th>
              <th scope="col">Nama Customer</th>
              <th scope="col">Status</th>
              <th scope="col">Teknisi</th>
              <th scope="col">STO</th>
              <th scope="col">Order Date</th>
              <th scope="col">Last Update</th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($idsto as $key => $value) {

              $queryre = ("SELECT * FROM customer JOIN kendala ON id_kendala = kendala.id JOIN sto ON customer.id_sto = sto.id JOIN teknisi ON customer.id_teknisi = teknisi.id WHERE kode = '201' OR kode = '211' AND customer.id_sto = '$value'");
              $re = $link->query($queryre) or die($link->error);
              while ($datare = $re->fetch_assoc()) {


                ?>
                <tr>
                  <th scope="row">
                    <a href="../form/index.php?track_id=<?php echo $datare['track_id'] ?>" title="Follow Up">
                      <svg class="bi bi-arrow-up-square-fill text-danger" width="1.5em" height="1.5em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm3.354 8.354a.5.5 0 1 1-.708-.708l3-3a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 6.207V11a.5.5 0 0 1-1 0V6.207L5.354 8.354z"/>
                      </svg>
                    </a>
                    <a href="../distribusi/detail.php?track_id=<?php echo $datare['track_id'] ?>" title="Info">
                      <svg class="bi bi-info-square-fill" width="1.5em" height="1.5em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm8.93 4.588l-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM8 5.5a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
                      </svg>
                    </a>
                  </th>
                  <td><?php echo $datare['track_id'] ?></td>
                  <td><?php echo $datare['nama_customer'] ?></td>
                  <td><?php echo $datare['nama_kendala'] ?></td>
                  <td><?php echo $datare['nama_team'] ?></td>
                  <td><?php echo $datare['nama_sto'] ?></td>
                  <td><?php echo $datare['order_date'] ?></td>
                  <td><?php echo $datare['last_update'] ?></td>
                </tr>

                <?php
              }
            }
            ?>
          </tbody>
        </table>
      </div>

    </div>



    <!-- PS -->
    <div class="border rounded col">
      <div class="row justify-content-between">
        <div class="col-4">
          <?php
          foreach ($idsto as $key => $value) {
            $jumlahps = $link->query("SELECT * FROM customer JOIN kendala ON id_kendala = kendala.id JOIN sto ON customer.id_sto = sto.id JOIN teknisi ON customer.id_teknisi = teknisi.id WHERE nama_kendala = 'PS' AND customer.id_sto = '$value'")->num_rows or die($link->error);
          }
          ?>

          <h5>PS&nbsp;<span class="badge badge-success"><?php echo $jumlahps ?></span> </h5>

        </div>
        <div class="col-2">
          <a class="btn btn-block btn-link" href="#" role="button">Show All</a>
        </div>
      </div>
      <div class="table-responsive">

        <table class="table">
          <thead>
            <tr>
              <th scope="col">Action</th>
              <th scope="col">Track ID</th>
              <th scope="col">Nama Customer</th>
              <th scope="col">Status</th>
              <th scope="col">Teknisi</th>
              <th scope="col">STO</th>
              <th scope="col">Order Date</th>
              <th scope="col">Last Update</th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($idsto as $key => $value) {

              $queryps = ("SELECT * FROM customer JOIN kendala ON id_kendala = kendala.id JOIN sto ON customer.id_sto = sto.id JOIN teknisi ON customer.id_teknisi = teknisi.id WHERE nama_kendala = 'PS' AND customer.id_sto = '$value'");
              $re = $link->query($queryps) or die($link->error);
              while ($datare = $re->fetch_assoc()) {


                ?>
                <tr>
                  <th scope="row">
                    <a href="../distribusi/detail.php?track_id=<?php echo $datare['track_id'] ?>" title="Info">
                      <svg class="bi bi-info-square-fill" width="1.5em" height="1.5em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm8.93 4.588l-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM8 5.5a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
                      </svg>
                    </a>
                  </th>
                  <td><?php echo $datare['track_id'] ?></td>
                  <td><?php echo $datare['nama_customer'] ?></td>
                  <td><?php echo $datare['nama_kendala'] ?></td>
                  <td><?php echo $datare['nama_team'] ?></td>
                  <td><?php echo $datare['nama_sto'] ?></td>
                  <td><?php echo $datare['order_date'] ?></td>
                  <td><?php echo $datare['last_update'] ?></td>
                </tr>

                <?php
              }
            }
            ?>
          </tbody>
        </table>
      </div>

    </div>


  </div>



  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>

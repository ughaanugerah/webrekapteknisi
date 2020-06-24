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
    <?php
    if (isset($_GET['track_id'])) {
      $value = $_GET['track_id'];
      $param = 'track_id';
    }elseif (isset($_GET['team'])) {
      $value = $_GET['team'];
      $param = 'nama_team';
    }else {
      exit();
    }

    $queryuser = GetUser($param,$value);


    global $link;
    $resultuser = $link->query($queryuser);
    $userdata = $resultuser->fetch_assoc();

    ?>
    <h1 class="text-center"><?php echo $value; ?></h1>
    <h3 class="text-center">Status: <?php echo $userdata['nama_kendala']; ?></h3>
    <div class="row text-left">
      <div class="col-5">
        <p  class="font-weight-bold"><span class="text-muted">Nama Customer</span> <br> <?php echo $userdata['nama_customer']?> </p>
      </div>
    </div>

    <div class="row text-left">
      <div class="col-4">
        <p  class="font-weight-bold"><span class="text-muted">Track ID</span> <br> <?php echo $userdata['track_id']?> </p>
      </div>
      <div class="col-4">
        <p  class="font-weight-bold"><span class="text-muted">Nomor SC</span> <br> <?php CheckEmpty($userdata['nomor_sc']) ?> </p>
      </div>
      <div class="col-4">
        <p  class="font-weight-bold"><span class="text-muted">Nomor User</span> <br> <?php CheckEmpty($userdata['nomor_user'])?> </p>
      </div>
    </div>

    <div class="row text-left">
      <div class="col-4">
        <p  class="font-weight-bold"><span class="text-muted">Channel</span> <br> <?php echo $userdata['channel']?> </p>
      </div>
      <div class="col-4">
        <p  class="font-weight-bold"><span class="text-muted">Order Date</span> <br> <?php echo $userdata['order_date']?> </p>
      </div>
    </div>

    <div class="row text-left">
      <div class="col-4">
        <p  class="font-weight-bold"><span class="text-muted">ODP Pelanggan</span> <br> <?php CheckEmpty($userdata['odp_pelanggan'])?> </p>
      </div>
      <div class="col-4">
        <p  class="font-weight-bold"><span class="text-muted">ODP Alternatif</span> <br> <?php CheckEmpty($userdata['odp_alternatif'])?> </p>
      </div>
      <div class="col-4">
        <p  class="font-weight-bold"><span class="text-muted">Koordinat</span> <br> <?php CheckEmpty($userdata['koordinat'])?> </p>
      </div>
    </div>

    <div class="row text-left">
      <div class="col-4">
        <p  class="font-weight-bold"><span class="text-muted">Barcode</span> <br> <?php CheckEmpty($userdata['barcode'])?> </p>
      </div>
    </div>

    <div class="row text-left">
      <div class="col-4">
        <p  class="font-weight-bold"><span class="text-muted">Last Update</span> <br> <?php CheckEmpty($userdata['last_update'])?> </p>
      </div>
      <div class="col-4">
        <p  class="font-weight-bold"><span class="text-muted">Last Edit</span> <br> <?php CheckEmpty($userdata['username'])?> </p>
      </div>
    </div>

    <hr>


    <div class="row">
      <div class="col-3 offset-9">
        <input class="form-control" id="table_input" type="text" placeholder="Cari...">
      </div>
    </div>


    <table class="table table-hover table-bordered">
      <thead class="thead-dark">
        <tr>
          <th scope="col">NO</th>
          <th scope="col">FU DATE</th>
          <th scope="col">KODE</th>
          <th scope="col">STATUS</th>
          <th scope="col">DESKRIPSI</th>
          <th scope="col">TEAM</th>
          <th scope="col">TEKNISI1</th>
          <th scope="col">TEKNISI2</th>
          <th scope="col">STO</th>
          <th scope="col">KATEGORI</th>

        </tr>
      </thead>
      <tbody id="table">

        <?php

        $querydistribusi = GetDetail($param,$value);
        $resultdistribusi = $link->query($querydistribusi) or die($link->error);


        $i = 1;
        if ($resultdistribusi->num_rows > 0) {
          while ($distribusi = $resultdistribusi->fetch_assoc()) {

            if ($distribusi['kode'] == 500) {
              echo "<tr class='table-success'>";
            }else {
              echo "<tr class='table-warning'>";
            };


            echo "<th scope='row'>". $i ."</th>";
            echo "<td>". $distribusi['fu_date'] ."</td>";
            echo "<td>".$distribusi['kode'] ."</td>";
            echo "<td>".$distribusi['nama_kendala'] ."</td>";
            echo "<td>".$distribusi['deskripsi'] ."</td>";
            echo "<td>". $distribusi['nama_team'] ."</td>";
            echo "<td>".$distribusi['teknisi1'] ."</td>";
            echo "<td>".$distribusi['teknisi2'] ."</td>";
            echo "<td>".$distribusi['nama_sto'] ."</td>";
            echo "<td>".$distribusi['nama_kendala'] ."</td>";

            echo "</tr>";

            $i++;
          }
        }else {
          echo "<th scope='row' colspan='15'> DATA TIDAK DITEMUKAN </th>";
        }

        $link->close();

        ?>

      </tbody>
    </table>
    <div class="row">

      <div class="col-2">
        <button type="button" class="btn btn-danger btn-block" onclick="history.back()">&#x2190;Kembali</button>
      </div>
      <div class="col-2">

        <a class="btn-block btn btn-danger" href="../form/index.php?track_id=<?php echo $userdata['track_id'] ?>">Follow UP</a>
      </div>
    </div>



  </div>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script>
  $(document).ready(function(){
    $("#table_input").on("keyup", function() {
      var value = $(this).val().toLowerCase();
      $("#table tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });
  });
  </script>


</body>
</html>

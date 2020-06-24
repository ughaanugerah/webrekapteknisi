<!DOCTYPE html>
<html lang="en" dir="ltr">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<style media="screen">

.border{
  padding : 20px;
  margin: 10px;
}

.table-fixed tbody {
  height: 300px;
  overflow-y: auto;
  width: 100%;
}

.table-fixed thead,
.table-fixed tbody,
.table-fixed tr,
.table-fixed td,
.table-fixed th {
  display: block;
}

.table-fixed tbody td,
.table-fixed tbody th,
.table-fixed thead > tr > th {
  float: left;
  position: relative;

  &::after {
    content: '';
    clear: both;
    display: block;
  }
}

</style>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Admin</title>
</head>
<body>

  <?php

  include_once '../navbar.php';
  include '../function/function.php';
  include_once '../function/preventaccess.php';


  ?>

  <div class="container">
    <h1>Dashboard</h1>
    <div class="row">

      <div class="col border rounded">
        <h2 id="list_mitra" style="cursor: pointer">List Mitra</h2>

        <div class="table-responsive" id="list_mitra_table">
          <table class="table table-fixed">
            <thead>
              <tr>
                <th scope="col" class="col-2">#</th>
                <th scope="col" class="col-4">Nama Team</th>
                <th scope="col" class="col-3">Wilayah</th>
                <th scope="col" class="col-3">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $querymitra = ("SELECT * FROM mitra JOIN wilayah ON id_wilayah = wilayah.id ORDER BY nama_mitra");
              $mitra  = $link->query($querymitra);
              $i = 1;
              while ($datamitra = $mitra->fetch_assoc()) {
                ?>
                <tr>
                  <th scope="row" class="col-2"><?php echo $i ?></th>
                  <td class="col-4"><?php echo $datamitra['nama_mitra'] ?></td>
                  <td class="col-3"><?php echo $datamitra['nama_wilayah'] ?></td>
                  <td class="col-3"> <a href="#">Edit</a> </td>
                </tr>
                <?php
                $i++;
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>

      <div class="col border rounded">
        <h2 id="list_team" style="cursor: pointer">List Team</h2>

        <div class="table-responsive" id="list_team_table">
          <table class="table table-fixed">
            <thead>
              <tr>
                <th scope="col" class="col-2">#</th>
                <th scope="col" class="col-4">Username</th>
                <th scope="col" class="col-3">Role</th>
                <th scope="col" class="col-3">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $querymitra = ("SELECT * FROM user WHERE NOT role = '1' ORDER BY username");
              $mitra  = $link->query($querymitra);
              $i = 1;
              while ($datamitra = $mitra->fetch_assoc()) {
                if ( $datamitra['role'] == '2' ) {
                  $role = 'Team Leader';
                }elseif ($datamitra['role'] == '3' ) {
                  $role = 'Home Service';
                }
                ?>
                <tr>
                  <th scope="row" class="col-2"><?php echo $i ?></th>
                  <td class="col-4"><?php echo $datamitra['username'] ?></td>
                  <td class="col-3"><?php echo $role?></td>
                  <td class="col-3"> <a href="#">Edit</a> </td>
                </tr>
                <?php
                $i++;
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <div class="row">

      <div class="col border rounded">
        <h2 id="list_mitra" style="cursor: pointer">List Wilayah</h2>

        <div class="table-responsive" id="list_mitra_table">
          <table class="table table-fixed">
            <thead>
              <tr>
                <th scope="col" class="col-2">#</th>
                <th scope="col" class="col-6">Nama Team</th>
                <th scope="col" class="col-4">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $querymitra = ("SELECT * FROM wilayah ORDER BY nama_wilayah");
              $mitra  = $link->query($querymitra);
              $i = 1;
              while ($datamitra = $mitra->fetch_assoc()) {
                ?>
                <tr>
                  <th scope="row" class="col-2"><?php echo $i ?></th>
                  <td class="col-6"><?php echo $datamitra['nama_wilayah'] ?></td>
                  <td class="col-4"> <a href="#">Edit</a> </td>
                </tr>
                <?php
                $i++;
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>

      <div class="col border rounded">
        <h2 id="list_sto" style="cursor: pointer">List STO</h2>
        <div class="table-responsive" id="list_sto_table">
          <table class="table table-fixed">
            <thead>
              <tr>
                <th scope="col" class="col-2">#</th>
                <th scope="col" class="col-6">Nama STO</th>
                <th scope="col" class="col-4">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $querymitra = ("SELECT * FROM sto ORDER BY nama_sto");
              $mitra  = $link->query($querymitra);
              $i = 1;
              while ($datamitra = $mitra->fetch_assoc()) {
                ?>
                <tr>
                  <th scope="row" class="col-2"><?php echo $i ?></th>
                  <td class="col-6"><?php echo $datamitra['nama_sto'] ?></td>
                  <td class="col-4"> <a href="#">Edit</a> </td>
                </tr>
                <?php
                $i++;
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- Button trigger modal -->




  </div>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script type="text/javascript">
  $('#list_mitra').click(function(){
    if ($(this).text() === 'List Mitra') {
      $(this).text('List Mitra +')
    }else if ($(this).text() === 'List Mitra +') {
      $(this).text('List Mitra')

    }
    $('tbody').toggle()
    $('#list_mitra_table').toggle()

  })
  </script>

</body>
</html>

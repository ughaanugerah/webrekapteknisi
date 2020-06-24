<!DOCTYPE html>
<html lang="en" dir="ltr">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Input Absensi Teknisi </title>
</head>
<body>

  <?php include_once '../navbar.php';
  include '../function/function.php';
  include_once '../function/preventaccess.php';
  include_once 'team_connect.php';

  ?>


  <div class="container">
    <h1 class="text-center"> Tambahkan Team</h1>


        <?php
        if (isset($info)) {
          echo "<div class='alert alert-primary text-ceter' role='alert'>";
          echo $info;
          echo "</div>";
        }
        ?>


    <form method="POST" action="tambah.php">

      <div class="form-group">
        <div class="form-row">

          <div class="col-2">
            <label>MITRA</label>
            <select class="browser-default custom-select" name="mitra" id="mitra" required>
              <option value=''> Pilih Mitra</option>
              <?php
              $namamitra = GetMitra();

              foreach ($namamitra as $key => $value) {
                $namamitra = $value['nama_mitra'];
                $idmitra = $value['id'];

                echo "<option value='".$idmitra."'>".$namamitra."</option>";
              }
              ?>
            </select>
          </div>


          <div class="col-1">
            <label>STO</label>
            <select class="browser-default custom-select" name="sto" id="sto" required>
              <option value=''>STO</option>
              <?php
              $namasto = GetSto();

              foreach ($namasto as $key => $value) {
                $namasto = $value['nama_sto'];
                $idsto = $value['id'];

                echo "<option value='".$idsto."'>".$namasto."</option>";
              }
              ?>
            </select>
          </div>

          <div class="col-2 offset-1">
            <label>NAMA TEAM</label>
            <input name="team" type="text" class="form-control form-control-sm" placeholder="Nama Team" id="team" required>
          </div>

          <div class="col-3 offset-1">
            <label>NAMA TEKNISI</label>
            <div class="form-row">
              <div class="col">
                <input name="teknisi1" type="text" class="form-control form-control-sm" placeholder="Teknisi 1" required>
              </div>
              <div class="col">
                <input name="teknisi2" type="text" class="form-control form-control-sm" placeholder="Teknisi 2">
              </div>
            </div>
          </div>

          <div class="col-1 offset-1">
            <label> &nbsp;	 </label>
            <input type="submit" id="submit" class="btn btn-danger btn-block" value="Tambah" name="submit_team">
          </div>
        </div>
      </div>
    </form>

<hr>

<h4>Tambah STO</h4>
<br>
<form method="POST" action="tambah.php">

  <div class="form-group">
    <div class="form-row">

      <div class="col-2">
        <label>NAMA TEAM</label>
        <select class="browser-default custom-select" name="teamsto" required>
          <option value=''>Nama Tim</option>
          <?php
          $namateam = GetTeam();

          foreach ($namateam as $key => $value) {
            $namateam = $value['nama_team'];
            $idteam = $value['id'];

            echo "<option value='".$idteam."'>".$namateam."</option>";
          }
          ?>
        </select>

      </div>


      <div class="col-1">
        <label>STO</label>
        <select class="browser-default custom-select" name="addsto" required>
          <option value=''>STO</option>
          <?php
          $namasto = GetSto();

          foreach ($namasto as $key => $value) {
            $namasto = $value['nama_sto'];
            $idsto = $value['id'];

            echo "<option value='".$idsto."'>".$namasto."</option>";
          }
          ?>
        </select>
      </div>


      <div class="col-2 offset-1">
        <label> &nbsp;	 </label>
        <input type="submit" id="submitsto" class="btn btn-danger btn-block" value="Tambah STO" name="submit_sto">
      </div>
    </div>
  </div>
</form>


    <div class="row">
      <div class="col">
        <button type="button" class="btn btn-danger" onclick="history.back()">  &#x2190;Kembali </button>
      </div>
    </div>
  </div>


  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

  <script type="text/javascript">
  $('#mitra').change(function(){
    var name = $(this).find('option:selected').text();
    $('#team').val(name)
  });

  $.urlParam = function(name){
    var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
    return results[1] || 0;
  }

  $('#sto').val($.urlParam('sto'));
  </script>
</body>
</html>

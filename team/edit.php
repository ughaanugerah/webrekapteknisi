<!DOCTYPE html>
<html lang="en" dir="ltr">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

<style media="screen">
.list-unstyled {
  padding-left: 0;
  list-style: none;
  position: absolute;
  width: 95%;
}

#listcrew ul {
  background-color: #eee;
  cursor: pointer;
}

</style>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Input Absensi Teknisi </title>
</head>
<body>

  <?php include_once '../navbar.php';
  include '../function/function.php';
  include_once '../function/preventaccess.php';

  ?>

  <div class="container">
    <h1 class="text-center"> Tambahkan Team</h1>

    <form method="POST" action="edit.php">

      <div class="form-group">
        <div class="form-row">
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

          <div class="col-2">
            <label>TEAM</label>
            <select class="browser-default custom-select" id="crew" name="crew" required>
              <option value=''> Pilih Team</option>
            </select>
          </div>

          <div class="col-2 offset-1">
            <label>NAMA BARU</label>
            <input name="namabaru" type="text" class="form-control form-control-sm" placeholder="Nama Baru" id="namabaru" required>
          </select>
        </div>


        <div class="col-3 offset-1">
          <label>NAMA TEKNISI</label>
          <div class="form-row">
            <div class="col">
              <input name="teknisi1" type="text" class="form-control form-control-sm" placeholder="Teknisi 1" id="teknisi1" required>
            </div>
            <div class="col">
              <input name="teknisi2" type="text" class="form-control form-control-sm" placeholder="Teknisi 2" id="teknisi2">
            </div>
          </div>
        </div>

        <div class="col-1">
          <label> &nbsp;	 </label>
          <input type="submit" id="submit" class="btn btn-danger btn-block" value="Edit" name="edit_team">

        </div>
      </div>
    </div>
  </form>
  <div class="row">
    <div class="col-1">
      <button type="button" class="btn btn-danger" onclick="history.back()">&#x2190;Kembali</button>
    </div>

  </div>
</div>

<?php
include_once 'team_connect.php';
?>

<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<script type="text/javascript">

$('#sto').change(function(){
  var sto = $(this).val();
  $.get('../form/team.php',{ 'sto' : sto })
  .done(function(data){
    $('#crew').html(data);
  });
});

$('#crew').change(function(){
  var crew = $(this).val();
  var nama = $('#crew option:selected').text()

  if (crew === '') {
    $('#teknisi1').val('');
    $('#teknisi2').val('');
  }else {
    $('#namabaru').val(nama)
    $.get('../form/team.php',{ 'crew' : crew })
    .done(function(data){
      var json = data;
      obj = JSON.parse(json);
      $('#teknisi1').val(obj.teknisi1);
      $('#teknisi2').val(obj.teknisi2);
    });
  }
});

$.urlParam = function(name){
  var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
  return results[1] || 0;
}

$('#sto').val($.urlParam('sto'));
$('#crew').val($.urlParam('crew'));
</script>

</body>
</html>

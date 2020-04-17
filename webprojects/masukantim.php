<!DOCTYPE html>
<html lang="en" dir="ltr">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Input Absensi Teknisi </title>
  </head>
  <body>





    <div class="container">
      <h1 class="text-center"> Input Absensi Teknisi</h1>
      <h5 class="text-center"> Tanggal: <?php echo date('d-m-yy'); ?></h5>
      <br>

      <form method="POST" action="masukantim.php">

        <div class="form-group">
          <div class="form-row">
            <div class="col-2">
              <label>KODE</label>
            </div>
            <div class="col-1">
            </div>
            <div class="col-5">
              <label>NAMA KENDALA</label>
            </div>
          </div>
          <div class="form-row">
            <div class="col-2">
              <input name="crew" type="text" class="form-control form-control-sm" placeholder="KODE">
            </div>
            <div class="col-1">
            </div>
            <div class="col-2">
              <input name="teknisi1" type="text" class="form-control form-control-sm" placeholder="NAMA KENDALA">
            </div>
            <div class="col-2">

              <div class="form-group">
                <label for="sel1">Select list:</label>
                <select class="form-control" id="sel1" name="teknisi2">
                  <option value="PS">KENDALA PELANGGAN</option>
                  <option value="KENDALA TEKNISI">KENDALA TEKNISI</option>
                </select>
              </div>

            </div>
            <div class="col-1">
            </div>
            <div class="col-1">
            </div>
            <div class="col-1">
              <input type="submit" id="submit" class="btn btn-danger btn-block" value="Tambah" name="submit_team">
            </div>
          </div>
        </div>
      </form>

      <?php

      $tanggal = date('yy-m-d');
      global $link;

      if (isset($_POST['submit_team'])) {
        $crew         = trim($_POST['crew']);
        $teknisi1     = trim($_POST['teknisi1']);
        $teknisi2     = trim($_POST['teknisi2']);

        $queryteam =  $link->prepare("INSERT INTO kendala (kode, nama_kendala, kategori_kendala) VALUES (?, ?, ?)");


        $queryteam->bind_param('iss',$crew, $teknisi1, $teknisi2);
        $queryteam->execute();
      }





       ?>




    </div>

    <script>
    function isNumberKey(evt)
    {
      var charCode = (evt.which) ? evt.which : evt.keyCode;
      if (charCode != 46 && charCode > 31
      && (charCode < 48 || charCode > 57))
      return false;
      return true;
    };

    </script>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>

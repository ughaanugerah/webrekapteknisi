<!DOCTYPE html>
<html lang="en" dir="ltr">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Input Data </title>
</head>
<body>

  <?php
  include_once '../navbar.php';
  include '../function/function.php';
  ?>



  <div class="container">
    <h1 class="text-center"> Input Report Teknisi</h1>


    <form method="POST" action="index.php">

      <div class="form-group">
        <div class="form-row">
          <div class="col-4">
            <label>TRACK ID</label>
            <div class="input-group input-group-sm">
              <div class="input-group-prepend">
                <span class="input-group-text">MYIR-</span>
              </div>
              <input name="track_id" id="track_id" type="number" class="form-control form-control-sm" placeholder="Nomor Track ID" pattern="[0-9]" required>
            </div>
            <small class="form-text text-muted">(Jika belum ada tulis "BELUM ADA")</small>
          </div>
          <div class="col-4">
            <label>NOMOR SC</label>
            <div class="input-group input-group-sm">
              <input id="nomor_sc" name="nomor_sc" type="text" class="form-control form-control-sm" placeholder="Nomor SC">
            </div>
          </div>

          <div class="col-4">
            <label>NOMOR USER</label>
            <div class="input-group input-group-sm">
              <input id="nomor_user" name="nomor_user" type="text" class="form-control form-control-sm" placeholder="Nomor User">
            </div>
          </div>
        </div>
      </div>

      <div class="form-group">
        <div class="form-row">
          <div class="col-4">
            <label>NAMA CUSTOMER</label>
            <input id="nama_customer" name="nama_customer" type="text" class="form-control form-control-sm" placeholder="Nama Customer" required>
          </div>

          <div class="col-2">
            <label>CHANNEL</label>
            <select class="browser-default custom-select" id="channel" name="channel" required>
              <option value=''> Pilih Channel</option>
              <?php
              $channel = GetChannel();

              foreach ($channel as $key => $value) {
                $key  = $value['channel'];
                $key2 = $value['id'];
                echo "<option value='".$key2."'>".$key."</option>";
              }
              ?>
            </select>

          </div>
        </div>
      </div>

      <div class="form-group">
        <div class="form-row">
          <div class="col-2">
            <label>STO</label>
            <select class="browser-default custom-select" id="sto" name="sto" required>
              <option value=''> Pilih STO</option>
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
          <div class="col-3 offset-1">
            <label>CREW</label>
            <select class="browser-default custom-select" id="crew" name="crew" required>
              <option value=''> Pilih CREW</option>
            </select>
            <a id="tambah" href="/team/tambah.php">Tambah</a> | <a id="edit" href="/team/edit.php">Edit</a>
          </div>
          <div class="col-2 offset-1">
            <label>TEKNISI 1</label>
            <input name="teknisi1"type="text" class="form-control" id="teknisi1" placeholder="Teknisi1" readonly>
          </div>

          <div class="col-2 offset-1">
            <label>TEKNISI 2</label>
            <input name="teknisi2"type="text" class="form-control" id="teknisi2" placeholder="Teknisi2" readonly>
          </div>
        </div>
      </div>

      <div class="form-group">
        <div class="form-row">
          <div class="col-3">
            <label>ORDER DATE</label>
            <input id="order_date" name="order_date" type="date" class="form-control" required>
          </div>

          <div class="col-3 offset-1">
            <label>FU DATE</label>
            <input name="fu_date" type="date" class="form-control" value="<?php echo date('yy-m-d'); ?>">
          </div>
        </div>
      </div>

      <div class="form-group">
        <div class="form-row">
          <div class="col-4">
            <label>ODP PELANGGAN</label>
            <input id="odp_pelanggan" name="odp_pelanggan" type="text" class="form-control" placeholder="Nama ODP">
          </div>
          <div class="col-4">
            <label>ODP ALTERNATIF</label>
            <input id="odp_alternatif" name="odp_alternatif" type="text" class="form-control" placeholder="Nama ODP">
          </div>
          <div class="col-4">
            <label>KOORDINAT</label>
            <input id="koordinat" name="koordinat" type="text" class="form-control" placeholder="Titik Koordinat Pelanggan">
          </div>
        </div>
      </div>

      <div class="form-group">
        <div class="form-row">
          <div class="col-3">
            <label>BARCODE</label>
            <input id="barcode" name="barcode"type="text" class="form-control" placeholder="Barcode">
          </div>
        </div>
      </div>


      <div class="form-group">
        <label>STATUS</label>
        <div class="form-row">
          <div class="col-3">
            <select class="browser-default custom-select" id="kode" name="kode">
              <option value=''> Pilih Kode </option>
              <?php
              $namasto = GetKode();

              foreach ($namasto as $key => $value) {
                $key  = $value['kode'];
                $key2 = $value['id'];
                $key3 = $value['nama_kendala'];
                echo "<option value='".$key2."'>".$key ." - ". $key3."</option>";
              }
              ?>
            </select>


          </div>
          <div class="col">
            <input type="text" name="deskripsi" id="deskripsi" class="form-control" placeholder="Deskripsi" required>
          </div>

        </div>
      </div>

      <input type="submit" id="submit" class="btn btn-danger btn-lg btn-block" value="Masukkan Data" name="submit_data">

    </form>

  </div>

  <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="form.js">    </script>
  <?php include_once 'connect_db.php'; ?>

</body>
</html>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Input Absensi Teknisi </title>
</head>
<body>

  <?php
  include_once '../navbar.php';
  include_once '../function/function.php';
  include_once '../function/preventaccess.php';
  ?>

  <div class="container">
    <h1 class="text-center"> Input Absensi Teknisi</h1>
    <h5 class="text-center"> Tanggal: <?php echo $display_hariini ?></h5>
    <br>

    <form method="POST" action="index.php">

      <div class="form-group">
        <div class="form-row">

          <div class="col-1">
            <label>STO</label>
            <select class="browser-default custom-select" name="sto" id="sto">
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
            <label>CREW</label>
            <select class="browser-default custom-select" id="crew" name="crew" required>
              <option value=''> Pilih CREW</option>
            </select>
          </div>

          <div class="col-3 offset-1">
            <label>NAMA TEKNISI</label>
            <div class="form-row">
              <div class="col">
                <input name="teknisi1" type="text" class="form-control form-control-sm" placeholder="Teknisi 1" id="teknisi1" readonly required>
              </div>
              <div class="col">
                <input name="teknisi2" type="text" class="form-control form-control-sm" placeholder="Teknisi 2" id="teknisi2" readonly required>
              </div>
            </div>
          </div>

          <div class="col-2 offset-1">
            <label>WAKTU</label>
            <input name="jamhadir" type="time" class="form-control form-control-sm" placeholder="JAM" required>
          </div>
          <div class="col1 offset-1">
            <label> &nbsp;	 </label>
            <input type="submit" id="submit" class="btn btn-danger btn-block" value="Tambah" name="submit_waktu">
          </div>
        </div>
      </div>
    </form>

    <div class="row">
      <div class="col-2">
        <a class="btn-block btn btn-danger" href="tambah.php" role="button">Tambah Team</a>
      </div>
      <div class="col-2">
        <a class="btn-block btn btn-danger" href="edit.php" role="button">Edit Team</a>
      </div>
    </div>
    <hr>
    <h2>Progress Teknisi On Duty</h2>

    <div class="row">
      <table class="table table-sm table-bordered table-hover">
        <thead class="thead-dark">
          <tr>
            <th scope="col">NAMA TIM</th>
            <th scope="col">JAM HADIR</th>
            <th scope="col">TEKNISI 1</th>
            <th scope="col">TEKNISI 2</th>
            <th scope="col">TOTAL WO</th>
            <th scope="col" style="padding-left: 20px; padding-right: 20px;">PS</th>
            <th scope="col">TOTAL KENDALA</th>
          </tr>
        </thead>
        <tbody>
          <?php
          include_once 'team_connect.php';

          $querytable = ("SELECT * FROM kehadiran JOIN teknisi ON kehadiran.id_teknisi = teknisi.id JOIN list_sto ON list_sto.id_teknisi = teknisi.id JOIN sto ON list_sto.id_sto = sto.id WHERE date = '$tanggal_hariini'");
          $resulttable = $link->query($querytable);

          while ($hasildata  = $resulttable->fetch_assoc()) {
            $id_teknisi  = $hasildata['id_teknisi'];
            $team        = $hasildata['nama_team'];
            $sto        = $hasildata['nama_sto'];
            $jamhadir    = $hasildata['time'];
            $teknisi1    = $hasildata['teknisi1'];
            $teknisi2    = $hasildata['teknisi2'];

            $queryps = ("SELECT * FROM customer JOIN kendala ON customer.id_kendala = kendala.id WHERE last_update = '$tanggal_hariini' AND id_teknisi = '$id_teknisi' AND kategori_kendala = 'PS' ");
            $querykt = ("SELECT * FROM customer JOIN kendala ON customer.id_kendala = kendala.id WHERE last_update = '$tanggal_hariini' AND id_teknisi = '$id_teknisi' AND kategori_kendala = 'KENDALA PELANGGAN' ");
            $querykp = ("SELECT * FROM customer JOIN kendala ON customer.id_kendala = kendala.id WHERE last_update = '$tanggal_hariini' AND id_teknisi = '$id_teknisi' AND kategori_kendala = 'KENDALA TEKNISI' ");


            $ps = $link->query($queryps)->num_rows;
            $kt = $link->query($querykt)->num_rows;
            $kp = $link->query($querykp)->num_rows;

            $totalkendala   = $kp+$kt;
            $totalwo = $totalkendala+$ps;

            echo "<tr>";
            echo "<td> <a href='detail.php?team=".$team." '>". $team ."-".$sto."</a></td>";
            echo "<td>".$jamhadir."</td>";
            echo "<td>".$teknisi1."</td>";
            echo "<td>".$teknisi2."</td>";
            echo "<td>".$totalwo."</td>";
            echo "<td>".$ps."</td>";
            echo "<td>".$totalkendala."</td>";
            echo "</tr>";
          }
          $link->close();

          ?>

        </tbody>
      </table>


    </div>

  </div>


  <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="team.js">    </script>

</body>
</html>

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

    <?php include_once 'navbar.php'; ?>

    <div class="container">
      <?php
      if (isset($_GET['track_id'])) {
        $param = $_GET['track_id'];
        $query  = ("SELECT  * FROM ant WHERE track_id='$param' ");
      }elseif (isset($_GET['fu_date'])) {
        $param = $_GET['fu_date'];
        $query  = ("SELECT  * FROM ant WHERE fu_date='$param' ");
      }elseif (isset($_GET['team'])) {
        $param = $_GET['team'];
        $query  = ("SELECT  * FROM ant WHERE team='$param' ");
      }elseif (isset($_GET['order_date'])) {
        $param = $_GET['order_date'];
        $query  = ("SELECT  * FROM ant WHERE order_date='$param' ");
      }else {
        exit();
      }




      global $link;
      $result = $link->query($query);

       ?>
       <h1 class="text-center"><?php echo $param; ?></h1>


       <div class="row">
         <div class="col-1">
           <button type="button" class="btn btn-danger" onclick="history.back()">  &#x2190;Back </button>
         </div>

         <div class="col-1">
           <div class="dropdown">
             <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Filter</button>
             <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
               <a class="dropdown-item" href="#">Hari Ini</a>
               <a class="dropdown-item" href="#">Minggu Ini</a>
               <a class="dropdown-item" href="#">Bulan Ini</a>
             </div>
           </div>
         </div>

         <div class="col-2">
           <div class="dropdown">
             <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Jumlah Data</button>
             <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
               <a class="dropdown-item" href="#">10</a>
               <a class="dropdown-item" href="#">15</a>
               <a class="dropdown-item" href="#">25</a>
             </div>
           </div>
         </div>
         <div class="col">
         </div>
         <div class="col-3">
           <input class="form-control" id="table_input" type="text" placeholder="Cari...">
         </div>
       </div>

       <br>

       <table class="table table-hover table-bordered table-responsive">
         <thead class="thead-dark">
           <tr>
             <th scope="col">NO</th>
             <th scope="col">FU DATE</th>
             <th scope="col">ORDER DATE</th>
             <th scope="col">TRACK ID</th>
             <th scope="col">NAMA CUSTOMER</th>
             <th scope="col">KODE</th>
             <th scope="col">STATUS</th>
             <th scope="col">DESKRIPSI</th>
             <th scope="col">TEAM</th>
             <th scope="col">ODP PELANGGAN</th>
             <th scope="col">ODP ALTERNATIF</th>
             <th scope="col">TEKNISI1</th>
             <th scope="col">TEKNISI2</th>
             <th scope="col">STO</th>
             <th scope="col">KATEGORI</th>

           </tr>
         </thead>
         <tbody id="table">

           <?php

           $i = 1;
           if ($result->num_rows > 0) {
             while ($row = $result->fetch_assoc()) {

               if ($row['kode'] == 500) {
                 echo "<tr class='table-info'>";
               }else {
                 echo "<tr class='table-warning'>";
               };


               echo "<th scope='row'>". $i ."</th>";
               echo "<td> <a href='detail.php?fu_date=".$row['fu_date']." '>". $row['fu_date'] ."</a></td>";
               echo "<td> <a href='detail.php?order_date=".$row['order_date']." '>". $row['order_date'] ."</a></td>";
               echo "<td> <a href='detail.php?track_id=".$row['track_id']." '>". $row['track_id'] ."</a></td>";
               echo "<td>".$row['nama_customer'] ."</td>";
               echo "<td>".$row['kode'] ."</td>";
               echo "<td>".$row['status'] ."</td>";
               echo "<td>".$row['deskripsi'] ."</td>";
               echo "<td> <a href='detail.php?team=".$row['team']." '>". $row['team'] ."</a></td>";
               echo "<td>".$row['odp_pelanggan'] ."</td>";
               echo "<td>".$row['odp_alternatif'] ."</td>";
               echo "<td>".$row['teknisi1'] ."</td>";
               echo "<td>".$row['teknisi2'] ."</td>";
               echo "<td>".$row['sto'] ."</td>";
               echo "<td>".$row['status'] ."</td>";

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

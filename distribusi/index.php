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

.option{
  text-align: left;
  padding: 5px 0;
}

.option label{
  padding: 5px;
}
</style>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Tabel Distribusi</title>
</head>
<body>

  <?php include_once '../navbar.php';

  if (isset($_GET['sto'])) {
    $sto = $_GET['sto'];
  }else {
    exit();
  }

  if (isset($_GET['page'])) {
    $page = $_GET['page'];
  }else {
    $page = 1;
  }

  if (isset($_GET['limit'])) {
    $limit = $_GET['limit'];
  }else {
    $limit = 15;
  }

  $offset = ($page - 1)*$limit;

  if (isset($_GET['filter'])) {
    if ($_GET['filter'] == 'ps') {
      $filter = "AND nama_kendala = 'PS'";
    }elseif ($_GET['filter'] == 'kendala') {
      $filter = "AND NOT nama_kendala = 'PS'";
    }else {
      $filter = "";
    }
  }else {
    $filter = "";
  }



  ?>

  <div class="container">
    <h1 class="text-center"> Tabel Distribusi <?php echo $sto; ?></h1>

    <div class="row justify-content-between">
      <div class="col-1 pull-left">
        <div class="dropdown">
          <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Jumlah Data</button>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="index.php?sto=<?php echo $sto ?>&limit=15">15</a>
            <a class="dropdown-item" href="index.php?sto=<?php echo $sto ?>&limit=25">25</a>
            <a class="dropdown-item" href="index.php?sto=<?php echo $sto ?>&limit=50">50</a>
          </div>
        </div>
      </div>

      <div class="col offset-1">
        <div class="option">

          <label class="radio-inline"><input type="radio" name="filter" value="all" checked> Show All</label>
          <label class="radio-inline"><input type="radio" name="filter" value="ps"> PS</label>
          <label class="radio-inline"><input type="radio" name="filter" value="kendala"> Kendala</label>
        </div>

      </div>

      <div class="col-3">
        <input class="form-control" id="table_input" type="text" placeholder="Cari...">
      </div>
    </div>




    <table class="table table-hover table-bordered table-responsive-md">
      <thead class="thead-dark">
        <tr>
          <th scope="col">NO</th>
          <th scope="col">FU DATE</th>
          <th scope="col">TRACK ID</th>
          <th scope="col">NAMA CUSTOMER</th>
          <th scope="col">KODE</th>
          <th scope="col">STATUS</th>
          <th scope="col">DESKRIPSI</th>
          <th scope="col">TEAM</th>
          <th scope="col">ACTION</th>
        </tr>
      </thead>
      <tbody id="table">

        <?php



        global $link;


        $query  = ("SELECT  * FROM customer
          JOIN sto ON customer.id_sto = sto.id
          JOIN kendala ON customer.id_kendala = kendala.id
          JOIN teknisi ON customer.id_teknisi = teknisi.id
          JOIN distribusi ON distribusi.id_customer = customer.id
          WHERE nama_sto='$sto' $filter
          ORDER BY distribusi.created_at DESC LIMIT $offset, $limit");
          $result = $link->query($query) or die($link->error);

          $i = $offset+1;
          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {

              if ($row['kode'] == 500) {
                echo "<tr class='table-success'>";
              }else {
                echo "<tr class='table-warning'>";

              };

              $tanggal = $row['fu_date'];
              $tanggal = date("d F Y", strtotime($tanggal));


              echo "<th scope='row'>". $i ."</th>";
              echo "<td>".$tanggal ."</td>";
              echo "<td>". $row['track_id'] ."</td>";
              echo "<td>".$row['nama_customer'] ."</td>";
              echo "<td>".$row['kode'] ."</td>";
              echo "<td>".$row['nama_kendala'] ."</td>";
              echo "<td>".$row['deskripsi'] ."</td>";
              echo "<td>".$row['nama_team'] ."</td>";

              if ($row['nama_kendala'] == 'PS') {
                echo "<td>
                <a class='btn btn-link btn-sm' role='button' href='detail.php?track_id=".$row['track_id']." 'title='Info'>
                <svg class='bi bi-info-square-fill' width='1.5em' height='1.5em' viewBox='0 0 16 16' fill='currentColor' xmlns='http://www.w3.org/2000/svg'>
                <path fill-rule='evenodd' d='M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm8.93 4.588l-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM8 5.5a1 1 0 1 0 0-2 1 1 0 0 0 0 2z'/>
                </svg>
                </td>";

                
              }else {
                echo "<td>
                <div class='row'>

                <a class='btn btn-link btn-sm' role='button' href='detail.php?track_id=".$row['track_id']." 'title='Info'>
                <svg class='bi bi-info-square-fill' width='1.5em' height='1.5em' viewBox='0 0 16 16' fill='currentColor' xmlns='http://www.w3.org/2000/svg'>
                <path fill-rule='evenodd' d='M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm8.93 4.588l-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM8 5.5a1 1 0 1 0 0-2 1 1 0 0 0 0 2z'/>
                </svg>

                </a>
                <a class='btn btn-link btn-sm' role='button' href='../form/index.php?track_id=".$row['track_id']." ' title='Follow Up'>
                <svg class='bi bi-arrow-up-square-fill text-danger' width='1.5em' height='1.5em' viewBox='0 0 16 16' fill='currentColor' xmlns='http://www.w3.org/2000/svg'>
                <path fill-rule='evenodd' d='M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm3.354 8.354a.5.5 0 1 1-.708-.708l3-3a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 6.207V11a.5.5 0 0 1-1 0V6.207L5.354 8.354z'/>
                </svg>
                </a>
                </div>

                </td>";
              }
              echo "</tr>";

              $i++;
            }


          }else {
            echo "<tr class='table-warning'>";
            echo "<th scope='row' colspan='9'> NO DATA</th>";
            echo "</tr>";

          }


          ?>

        </tbody>
      </table>
      <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
          <?php
          include_once 'pagination.php';


          $link->close();

          ?>
        </ul>
      </nav>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
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

    $("input[type=radio]").click(function() {
      console.log($(this).val());
    });
    </script>


  </body>
  </html>

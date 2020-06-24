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
    include_once 'navbar.php';
    include '../global_function.php';
    ?>


    <div class="container">

      <?php
      setlocale(LC_ALL, 'IND');

      if ($_GET['laporan'] == "hari_ini") {
        echo "<h1>Performansi Mitra Teknisi PSB Makassar <br>Hari Ini ".strftime('%d %B %Y')." </h1>";
      } elseif ($_GET['laporan'] == "minggu_ini") {
        $pengurang    = date('N');
        $penambah     = 7 - $pengurang;
        $tanggalawal  = strftime('%d %B', strtotime("-$pengurang days"));
        $tanggalakhir = strftime('%d %B %Y', strtotime("+$penambah days"));

        echo "<h1>Performansi Mitra Teknisi PSB Makassar <br>Minggu Ini ".$tanggalawal." - ".$tanggalakhir." </h1>";

      } elseif ($_GET['laporan'] == "bulan_ini") {
        echo "<h1>Performansi Mitra Teknisi PSB Makassar <br> 01 - ".strftime('%d %B %Y')." </h1>";

      }
       ?>

          <?php

          // PNK
          $NamaTim = array("BERUANG_PNK" ,"BAGAMAS_BAL","DAJ_PNK","BAGAMAS_PNK", "SIPORIO_PNK" );
          $JumlahTim = count($NamaTim);
          PrintTable("PNK", $JumlahTim+1);
          for ($i=0; $i < $JumlahTim ; $i++) {
            PrintList($NamaTim[$i],$i+1);
          }
          PrintTableClose();

          //BAL
          $NamaTim = array("PM_PNK" ,"PM_BAL","PSS_BAL","IMN_BAL" );
          $JumlahTim = count($NamaTim);
          PrintTable("BAL", $JumlahTim+1);
          for ($i=0; $i < $JumlahTim ; $i++) {
           PrintList($NamaTim[$i],$i+1);
          }
          PrintTableClose();

          //MAT
          $NamaTim = array("NAL_MAT" ,"SUM_MAT","AGI-MAT","LRU_MAT" );
          $JumlahTim = count($NamaTim);
          PrintTable("MAT", $JumlahTim+1);
          for ($i=0; $i < $JumlahTim ; $i++) {
            PrintList($NamaTim[$i],$i+1);
          }
          PrintTableClose();

          //ANT
          $NamaTim = array("PSG_PNK" );
          $JumlahTim = count($NamaTim);
          PrintTable("ANT", $JumlahTim+1);
          for ($i=0; $i < $JumlahTim ; $i++) {
            PrintList($NamaTim[$i],$i+1);
          }
          PrintTableClose();

          //TAM-KIM
          $NamaTim = array("TIM_MAT", "TIM_TAM", "SPRN_KIM", "VISDAT_TAM", "SPM_TAM" );
          $JumlahTim = count($NamaTim);
          PrintTable("TAM-KIM", $JumlahTim+1);
          for ($i=0; $i < $JumlahTim ; $i++) {
            PrintList($NamaTim[$i],$i+1);
          }
          PrintTableClose();

          //MASSIPA
          $NamaTim = array("MAP_MAROS", "SIPA_MAROS" );
          $JumlahTim = count($NamaTim);
          PrintTable("MASSIPA", $JumlahTim+1);
          for ($i=0; $i < $JumlahTim ; $i++) {
            PrintList($NamaTim[$i],$i+1);
          }
          PrintTableClose();

          //GOWA
          $NamaTim = array("ABBN", "SIPO_PKN", "SIPO_MAR", "SIPO_GOWA", "ABB_PNK", "AJT_PNKANT", "AJT_GOWA");
          $JumlahTim = count($NamaTim);
          PrintTable("GOWA", $JumlahTim+1);
          for ($i=0; $i < $JumlahTim ; $i++) {
            PrintList($NamaTim[$i],$i+1);
          }
          PrintTableClose();

          //BANTAENG
          $NamaTim = array("SIPO_SLY", "AJT_BTN", "SIPO_BLK", "SIPO_BTN", "AJT_JNP");
          $JumlahTim = count($NamaTim);
          PrintTable("BANTAENG", $JumlahTim+1);
          for ($i=0; $i < $JumlahTim ; $i++) {
            PrintList($NamaTim[$i],$i+1);
          }
          PrintTableClose();

          //BONE
          $NamaTim = array("SIPO_SIN", "LPI_WTP");
          $JumlahTim = count($NamaTim);
          PrintTable("BONE", $JumlahTim+1);
          for ($i=0; $i < $JumlahTim ; $i++) {
            PrintList($NamaTim[$i],$i+1);
          }
          PrintTableClose();
          $link->close();

      ?>
   </tbody>
 </table>



    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


  </body>
</html>

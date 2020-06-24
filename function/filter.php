<?php
if (isset($_GET['periode'])) {
  if ($_GET['periode'] == 'hari') {
    $rangeawal  = $tanggal_hariini;
    $rangeakhir = $tanggal_hariini;

    $periode = "Periode : $display_hariini";

  }elseif ($_GET['periode'] == 'minggu') {
    $rangeawal  = $tanggal_awalminggu;
    $rangeakhir = $tanggal_akhirminggu;

    $periode = "Periode : $display_awalminggu - $display_akhirminggu";

  }elseif ($_GET['periode'] == 'bulan') {
    $rangeawal  = $tanggal_awalbulan;
    $rangeakhir = $tanggal_akhirbulan;

    $periode = "Periode : $display_awalbulan - $display_akhirbulan";
  }
}else {
  $rangeawal  = $tanggal_hariini;
  $rangeakhir = $tanggal_hariini;

  $periode = "Periode : $display_hariini";

}

 ?>

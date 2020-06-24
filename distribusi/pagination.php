<?php

$queryjumlah  = ("SELECT  * FROM distribusi
  JOIN sto ON distribusi.id_sto = sto.id
  JOIN kendala ON distribusi.id_kendala = kendala.id
  JOIN customer ON distribusi.id_customer = customer.id
  JOIN teknisi ON distribusi.id_team = teknisi.id
  WHERE nama_sto='$sto'");
  $jumlah = $link->query($queryjumlah)->num_rows;

  $jumlah = ceil($jumlah/$limit);

  if ($page > 1) {
    echo "<li class='page-item'>";
    echo "  <a class='page-link' href='index.php?sto=$sto&limit=$limit&page=".($page-1)."' tabindex='-1' aria-disabled='true'>Previous</a>";
    echo "</li>";
  }else {
    echo "<li class='page-item disabled'>";
    echo "  <a class='page-link' href='#' tabindex='-1' aria-disabled='true'>Previous</a>";
    echo "</li>";
  }

  if ($page-2 > 0) {
    echo "<li class='page-item'><a class='page-link' href='index.php?sto=$sto&limit=$limit&page=".($page-2)."'>".($page-2)."</a></li>";
  }
  if ($page-1 > 0) {
    echo "<li class='page-item'><a class='page-link' href='index.php?sto=$sto&limit=$limit&page=".($page-1)."'> ".($page-1)."</a></li>";
  }
  if ($page > 0) {
    echo "<li class='page-item active'><a class='page-link' href='index.php?sto=$sto&limit=$limit&page=$page' active> $page</a></li>";
  }
  if ($page+1 <= $jumlah) {
    echo "<li class='page-item'><a class='page-link' href='index.php?sto=$sto&limit=$limit&page=".($page+1)."'> ".($page+1)."</a></li>";
  }
  if ($page+2 <= $jumlah) {
    echo "<li class='page-item'><a class='page-link' href='index.php?sto=$sto&limit=$limit&page=".($page+2)."'> ".($page+2)."</a></li>";
  }

  if ($page < $jumlah && $jumlah != 0) {
    echo "<li class='page-item'>";
    echo "  <a class='page-link' href='index.php?sto=$sto&limit=$limit&page=".($page+1)."' tabindex='-1' aria-disabled='true'>Next</a>";
    echo "</li>";
  }
  else {
    echo "<li class='page-item disabled'>";
    echo "  <a class='page-link' href='#' tabindex='-1' aria-disabled='true'>Next</a>";
    echo "</li>";
  }

  ?>

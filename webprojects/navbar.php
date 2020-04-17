<?php
include 'function/db.php';

date_default_timezone_set("Asia/Makassar");
$tanggal_awalminggu      = date("Y-m-d", strtotime("last monday"));
$tanggal_akhirminggu     = date("Y-m-d", strtotime("next sunday"));
$tanggal_awalbulan       = date("Y-m-d", strtotime("first day of this month"));
$tanggal_akhirbulan      = date("Y-m-d", strtotime("last day of this month"));
$tanggal_harini          = date("Y-m-d", strtotime("now"));

?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="margin-bottom: 30px;">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="../index.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/form">Masukkan Data</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Tabel Distribusi
        </a>
        <div class="dropdown-menu overflow-auto" aria-labelledby="navbarDropdown" style="height : 150px">

          <?php

          $querysto  = ("SELECT nama_sto FROM sto");
          $resultsto = $link->query($querysto);
          while ($hasildatasto  = $resultsto->fetch_assoc()) {
            echo "<a class='dropdown-item' href='/distribusi/index.php?sto=".$hasildatasto['nama_sto']."'>".$hasildatasto['nama_sto']."</a>";
          }

          ?>

        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Report
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="/report/index.php">Report PSB </a>
          <a class="dropdown-item" href="/report/performansi.php">Performansi Mitra</a>
          <a class="dropdown-item" href="/report/kendala.php">Kendala</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/team/">Team</a>
      </li>
    </ul>
  </div>
</nav>

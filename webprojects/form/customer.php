<?php
include '../function/db.php';

if (isset($_GET['track_id'])) {
  $track_id = $_GET['track_id'];
  global $link;

  $query = ("SELECT * FROM customer WHERE track_id = '$track_id'");
  $result = $link->query($query) or die($link->error);

  if ($result->num_rows > 0) {

    $hasildata = $result->fetch_assoc();
    $customer = array(
      'nomor_sc'       => $hasildata['nomor_sc'],
      'nomor_user'     => $hasildata['nomor_user'],
      'nama_customer'  => $hasildata['nama_customer'],
      'id_channel'     => $hasildata['id_channel'],
      'order_date'     => $hasildata['order_date'],
      'odp_pelanggan'  => $hasildata['odp_pelanggan'],
      'odp_alternatif' => $hasildata['odp_alternatif'],
      'koordinat'      => $hasildata['koordinat'],
      'barcode'        => $hasildata['barcode']
    );

    echo json_encode($customer);

  }else {
    return false;
  }

  $link->close();



}
?>

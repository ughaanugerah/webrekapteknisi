<?php

//fetch.php

if(!empty($_FILES['csv_file']['name']))
{
  $file_data = fopen($_FILES['csv_file']['tmp_name'], 'r'); //Membuka Data CSV
  $column = fgetcsv($file_data);
  while($row = fgetcsv($file_data,NULL , ';'))
  {
    if ($row[1] !== '') {
      $row_data[] = array(

        'ORDER_DATE' => $row[0],
        'TRACK_ID' => $row[1],
        'STO' => $row[2],
        'ADDRESS' => $row[3],
        'NAMA' => $row[4],
        'K_KONTAK' => $row[5],
        'CHANNEL' => $row[6],
        'SC' => $row[7],
        'USER' => $row[8]
      );
    };

  }
  $output = array(
    'column'    => $column,
    'row_data'  => $row_data
  );

  echo json_encode($output);

}




?>

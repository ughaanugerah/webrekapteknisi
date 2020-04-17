$('#sto').change(function(){
  var sto = $(this).val();
  $('#tambah').attr('href', '../team/tambah.php?id=' +sto)
  $.get('team.php',{ 'sto' : sto })
  .done(function(data){
    $('#crew').html(data);
  });
});

$('#crew').change(function(){
  var crew = $(this).val();
  if (crew === '') {
    $('#teknisi1').val('');
    $('#teknisi2').val('');
  }else {
    $('#edit').attr('href', '../team/edit.php?id=' +crew)
    $.get('team.php',{ 'crew' : crew })
    .done(function(data){
      var json = data;
      obj = JSON.parse(json);
      $('#teknisi1').val(obj.teknisi1);
      $('#teknisi2').val(obj.teknisi2);
    });
  }
});

$('#track_id').change(function(){
  var track_id = $(this).val();
  track_id = 'MYIR-' + track_id;
  $.get('customer.php',{ 'track_id' : track_id })
  .done(function(data){
    if (data != '') {
      var json = data;
      obj = JSON.parse(json);
      $('#nomor_sc').val(obj.nomor_sc);
      $('#nomor_user').val(obj.nomor_user);
      $('#nama_customer').val(obj.nama_customer);
      $('#channel').val(obj.id_channel);
      $('#order_date').val(obj.order_date);
      $('#odp_pelanggan').val(obj.odp_pelanggan);
      $('#odp_alternatif').val(obj.odp_alternatif);
      $('#barcode').val(obj.barcode);
      $('#koordinat').val(obj.koordinat);
    }

  });
});

$('#kode').change(function(){
  if ($(this).val()== 29) {
    $('#deskripsi').val('DONE PS')
  }else {
    $('#deskripsi').val('')
  }
});

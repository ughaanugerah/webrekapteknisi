$(document).ready(function() {

  $('#crew').hover(function(){
    var sto = $('#sto').val();
    var crew = $('#crew').val();
    console.log("ADAKAHHH");

    if ( crew === '') {
      $('#tambah').attr('href', '../team/tambah.php?sto=' +sto)
      $.get('team.php',{ 'sto' : sto })
      .done(function(data){
        $('#crew').html(data);
      });
    }
  });

  $('#sto').change(function(){
    var sto = $('#sto').val();
    var crew = $('#crew').val();
    if ( crew === '') {
      $('#tambah').attr('href', '../team/tambah.php?sto=' +sto)
    }
    $('#teknisi1').val('');
    $('#teknisi2').val('');

    $.get('team.php',{ 'sto' : sto })
    .done(function(data){
      $('#crew').html(data);
    });
  });



  $('#crew').change(function(){
    var crew = $(this).val();
    var sto = $('#sto').val();

    if ( crew != '') {
      $('#kode').prop('disabled', false);
      $('#deskripsi').prop('readonly', false);
    }else {
      $('#kode').prop('disabled', true);
      $('#deskripsi').prop('readonly', true);
      $('#deskripsi').prop('required', false);
      $('#kode').prop('required', false);


    }


    if (crew === '') {
      $('#teknisi1').val('');
      $('#teknisi2').val('');
    }else {
      $('#edit').attr('href', '../team/edit.php?crew='+crew+'&sto='+sto)
      $.get('team.php',{ 'crew' : crew })
      .done(function(data){
        var json = data;
        obj = JSON.parse(json);
        $('#teknisi1').val(obj.teknisi1);
        $('#teknisi2').val(obj.teknisi2);
      });
    }
  });

  $('#track_id').keyup(function(){
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
        $('#sto').val(obj.id_sto);
        $('#submit').val('Update Data');
      }else {
        $('#nomor_sc').val('');
        $('#nomor_user').val('');
        $('#nama_customer').val('');
        $('#channel').val('');
        $('#order_date').val('');
        $('#odp_pelanggan').val('');
        $('#odp_alternatif').val('');
        $('#barcode').val('');
        $('#koordinat').val('');
        $('#sto').val('');
        $('#submit').val('Masukkan Data');

      }

    });
  });

  $.urlParam = function(name){
    var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
    return results[1] || 0;
  }

  var track_idcek = $.urlParam('track_id') ;
  track_idcek = track_idcek.match(/\d+/)[0]

  if ( track_idcek != '') {
    $('#track_id').val(track_idcek);
    var track_id = track_idcek;
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
        $('#sto').val(obj.id_sto);
        $('#submit').val('Update Data');

      }

    });



  }




  $('#kode').change(function(){
    console.log($(this).val());
    if ($(this).val()== '31') {
      $('#deskripsi').val('DONE PS')
    }else {
      $('#deskripsi').val('')
    }
  });
  $('#kode').prop('disabled', true);
  $('#deskripsi').prop('readonly', true);


})

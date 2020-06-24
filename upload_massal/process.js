
$(document).ready(function(){

  $(document).on("click", ".delete", function(){
    $(this).parents("tr").remove();

  })

  $('#upload_csv').on('submit', function(event){
    event.preventDefault();
    $.ajax({
      url:"fetch.php",
      method:"POST",
      data:new FormData(this),
      dataType:'json',
      contentType:false,
      cache:false,
      processData:false,
      success:function(data)
      {
        var html = '<table class="table table-striped table-bordered">';
        //HEADING
        if(data.column)
        {
          html += '<tr>';
          html += '<th> ACTION </th>';
          html += '<th> ORDER DATE  (dd/mm/yyyy) </th>';
          html += '<th> TRACK ID </th>';
          html += '<th> STO </th>';
          html += '<th> ADDRESS </th>';
          html += '<th> NAMA </th>';
          html += '<th> K-KONTAK </th>';
          html += '<th> CHANNEL </th>';
          html += '<th> SC </th>';
          html += '<th> USER </th>';
          html += '</tr>';
        }

        //BODY
        if(data.row_data)
        {
          for(var count = 0; count < data.row_data.length; count++)
          {
            if (data.row_data[count].NAMA === '') {
              html += '<tr class="table-danger">';
            }else {
              html += '<tr>';
            }
            html += '<td class="delete"> <a class="delete">Delete</a> </td>';
            html += '<td class="order_date" contenteditable>'+data.row_data[count].ORDER_DATE+'</td>';
            html += '<td class="track_id" contenteditable required>'+data.row_data[count].TRACK_ID+'</td>';
            html += '<td class="sto" contenteditable>'+data.row_data[count].STO+'</td>';
            html += '<td class="address" contenteditable>'+data.row_data[count].ADDRESS+'</td>';
            html += '<td class="nama" contenteditable>'+data.row_data[count].NAMA+'</td>';
            html += '<td class="kkontak" contenteditable>'+data.row_data[count].K_KONTAK+'</td>';
            html += '<td class="channel" contenteditable>'+data.row_data[count].CHANNEL+'</td>';
            html += '<td class="sc" contenteditable>'+data.row_data[count].SC+'</td>';
            html += '<td class="user" contenteditable>'+data.row_data[count].USER+'</td></tr>';
          }
        }
        html += '<table>';

        $('#csv_file_data').html(html);
        $('#upload_csv')[0].reset();
      },
      error: function(){
        alert('Format Data Tidak Valid');
      }
    })
  });

  $(document).on('click', '#import_data', function(){
    var order_date = [];
    var track_id = [];
    var sto = [];
    var address = [];
    var nama = [];
    var kkontak = [];
    var channel = [];
    var sc = [];
    var user = [];

    $('.order_date').each(function(){
      order_date.push($(this).text());
    });
    $('.track_id').each(function(){
      track_id.push($(this).text());
    });
    $('.sto').each(function(){
      sto.push($(this).text());
    });
    $('.address').each(function(){
      address.push($(this).text());
    });
    $('.nama').each(function(){
      nama.push($(this).text());
    });
    $('.kkontak').each(function(){
      kkontak.push($(this).text());
    });
    $('.channel').each(function(){
      channel.push($(this).text());
    });
    $('.sc').each(function(){
      sc.push($(this).text());
    });
    $('.user').each(function(){
      user.push($(this).text());
    });

    $.ajax({
      url:"import.php",
      method:"post",
      dataType: "html",
      data:{
        order_date:order_date,
        track_id:track_id,
        sto:sto,
        address:address,
        nama:nama,
        kkontak:kkontak,
        channel:channel,
        sc:sc,
        user:user
      },
      success:function(data)
      {
        $('#csv_file_data').html(data);
      },
      error: function(){
        alert('Terjadi Kesalahan Eror');
      }
    })

  });
});

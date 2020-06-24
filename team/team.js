$('#sto').change(function(){
  var sto = $(this).val();
  $.get('../form/team.php',{ 'sto' : sto })
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
    $.get('../form/team.php',{ 'crew' : crew })
    .done(function(data){
      var json = data;
      obj = JSON.parse(json);
      $('#teknisi1').val(obj.teknisi1);
      $('#teknisi2').val(obj.teknisi2);
    });
  }
});

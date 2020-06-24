$('.sideitem').click(function(){
  var item = $(this).attr('id');
  $('.sideitem').removeClass("active");
  $(this).addClass("active");


  $.get('maindata.php',{ 'item' : item })
  .done(function(data){
    $('table').html(data);
  });
});


$.ajax({
  type: 'POST',
    url:"http://localhost/star/get.php",
    success: (function( data ) {
    var rate = data[0];
    //console.log( rate );
    if(rate == 0){
    $(document).ready(function(){
      // $('form .stars input[type="radio"].star-5:checked ~ span').css("width", "100%")
      // $('form .stars label.star-5:hover ~ span').css("width", "100% !important");
      $('form .stars input[type="radio"].star-5').width('100%');
      $('form .stars label.star-5:hover ~ span').width('100%');
    }else
    if(rate == 1){
    $(document).ready(function(){
      // $('form .stars input[type="radio"].star-5:checked ~ span').css("width", "100%")
      // $('form .stars label.star-5:hover ~ span').css("width", "100% !important");
      $('form .stars input[type="radio"].star-5').width('20%');
      $('form .stars label.star-5:hover ~ span').width('20%');
    }else
    if(rate == 2){
    $(document).ready(function(){
      // $('form .stars input[type="radio"].star-5:checked ~ span').css("width", "100%")
      // $('form .stars label.star-5:hover ~ span').css("width", "100% !important");
      $('form .stars input[type="radio"].star-5').width('40%');
      $('form .stars label.star-5:hover ~ span').width('40%');
    }else
    if(rate == 3){
    $(document).ready(function(){
      // $('form .stars input[type="radio"].star-5:checked ~ span').css("width", "100%")
      // $('form .stars label.star-5:hover ~ span').css("width", "100% !important");
      $('form .stars input[type="radio"].star-5').width('60%');
      $('form .stars label.star-5:hover ~ span').width('60%');
    }else
    if(rate == 4){
    $(document).ready(function(){
      // $('form .stars input[type="radio"].star-5:checked ~ span').css("width", "100%")
      // $('form .stars label.star-5:hover ~ span').css("width", "100% !important");
      $('form .stars input[type="radio"].star-5').width('80%');
      $('form .stars label.star-5:hover ~ span').width('80%');
    }else
    if(rate == 5){
    $(document).ready(function(){
      // $('form .stars input[type="radio"].star-5:checked ~ span').css("width", "100%")
      // $('form .stars label.star-5:hover ~ span').css("width", "100% !important");
      $('form .stars input[type="radio"].star-5').width('100%');
      $('form .stars label.star-5:hover ~ span').width('100%');
    }


  })
  })
});

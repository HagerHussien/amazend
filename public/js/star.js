  var rate = 0;
$(document).ready(function(){
    $('.star-1').click(function(){
        rate = 1 ;
        $.ajax({
          type: 'POST',
            url:"http://localhost/star/startest.php",
            data:{
                'rate':rate
             },
             success: (function( data ) {
            console.log( data[0] );
          })
        })
    });
});

$(document).ready(function(){
    $('.star-2').click(function(){
        rate = 2 ;
        $.ajax({
          type: 'POST',
            url:"http://localhost/star/startest.php",
            data:{
                'rate':rate
             },
             success: (function( data ) {
            console.log( data[0] );
          })
    });
});
});

$(document).ready(function(){
    $('.star-3').click(function(){
        rate = 3 ;
        $.ajax({
          type: 'POST',
            url:"http://localhost/star/startest.php",
            data:{
                'rate':rate
             },
             success: (function( data ) {
            console.log( data[0] );
          })
    });
});
});

$(document).ready(function(){
    $('.star-4').click(function(){
        rate = 4 ;
        $.ajax({
          type: 'POST',
            url:"http://localhost/star/startest.php",
            data:{
                'rate':rate
             },
             success: (function( data ) {
            console.log( data[0] );
          })
    });
});
});

$(document).ready(function(){
    $('.star-5').click(function(){
        rate = 5 ;
        $.ajax({
          type: 'POST',
            url:"http://localhost/star/startest.php",
            data:{
                'rate':rate
             },
             success: (function( data ) {
            console.log( data[0] );
          })
    });
});
})
// console.log(rate);

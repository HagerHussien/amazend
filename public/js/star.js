  var rate = 0;
$(document).ready(function(){
    $('.star-1').click(function(e){
        rate = 1 ;
        productID = e.target.id;
        $.ajax({
          type: 'POST',
            url:"http://amazend.com/customer/addrate",
            data:{
                'product_id': productID,
                'rate':rate
             },
             success: (function( data ) {
            console.log( data[0] );
          })
        })
    });
});

$(document).ready(function(){
    $('.star-2').click(function(e){
        rate = 2 ;
        productID = e.target.id;
        $.ajax({
          type: 'POST',
            url:"http://amazend.com/customer/addrate",
            data:{
                'product_id': productID,
                'rate':rate
             },
             success: (function( data ) {
            console.log( data[0] );
          })
        })
});
});

$(document).ready(function(){
    $('.star-3').click(function(e){
        rate = 3 ;
        productID = e.target.id;
        $.ajax({
          type: 'POST',
            url:"http://amazend.com/customer/addrate",
            data:{
                'product_id': productID,
                'rate':rate
             },
             success: (function( data ) {
            console.log( data[0] );
          })
        })
});
});

$(document).ready(function(){
    $('.star-4').click(function(e){
        rate = 4 ;
        productID = e.target.id;
        $.ajax({
          type: 'POST',
            url:"http://amazend.com/customer/addrate",
            data:{
                'product_id': productID,
                'rate':rate
             },
             success: (function( data ) {
            console.log( data[0] );
          })
        })
});
});

$(document).ready(function(){
    $('.star-5').click(function(e){
        rate = 5 ;
        productID = e.target.id;
        $.ajax({
          type: 'POST',
            url:"http://amazend.com/customer/addrate",
            data:{
                'product_id': productID,
                'rate':rate
             },
             success: (function( data ) {
            console.log( data[0] );
          })
        })
});
})
// console.log(rate);

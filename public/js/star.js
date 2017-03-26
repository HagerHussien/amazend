  var rate = 0;
$(document).ready(function(){
    $('.star-1').click(function(e){
        rate = 1 ;
        productID = e.target.id;
        console.log(e.target.id);
        console.log(productID);
        $.ajax({
          url:"http://amazend.com/customer/addrate",
          method: 'POST',
          data:{
                'product_id': productID,
                'rate':rate
             },
             dataType:'JSON',
             success: (function( data ) {
            console.log( data[0] );
          }
        ),
        error: function(xhr, ajaxOptions, thrownErrors) {
          console.log(xhr);
          console.log(ajaxOptions);
          console.log(thrownErrors);
        }

        })
    });
});

$(document).ready(function(){
    $('.star-2').click(function(e){
        rate = 2 ;
        productID = e.target.id;
        console.log(e.target.id);
        console.log(productID);
        $.ajax({
          url:"http://amazend.com/customer/addrate",
          method: 'POST',
          data:{
                'product_id': productID,
                'rate':rate
             },
             dataType:'JSON',
             success: (function( data ) {
            console.log( data[0] );
          }
        ),
        error: function(xhr, ajaxOptions, thrownErrors) {
          console.log(xhr);
          console.log(ajaxOptions);
          console.log(thrownErrors);
        }

        })
});
});

$(document).ready(function(){
    $('.star-3').click(function(e){
        rate = 3 ;
        productID = e.target.id;
        console.log(e.target.id);
        console.log(productID);
        $.ajax({
          url:"http://amazend.com/customer/addrate",
          method: 'POST',
          data:{
                'product_id': productID,
                'rate':rate
             },
             dataType:'JSON',
             success: (function( data ) {
            console.log( data[0] );
          }
        ),
        error: function(xhr, ajaxOptions, thrownErrors) {
          console.log(xhr);
          console.log(ajaxOptions);
          console.log(thrownErrors);
        }

        })
});
});

$(document).ready(function(){
    $('.star-4').click(function(e){
        rate = 4 ;
        productID = e.target.id;
        console.log(e.target.id);
        console.log(productID);
        $.ajax({
          url:"http://amazend.com/customer/addrate",
          method: 'POST',
          data:{
                'product_id': productID,
                'rate':rate
             },
             dataType:'JSON',
             success: (function( data ) {
            console.log( data[0] );
          }
        ),
        error: function(xhr, ajaxOptions, thrownErrors) {
          console.log(xhr);
          console.log(ajaxOptions);
          console.log(thrownErrors);
        }

        })
});
});

$(document).ready(function(){
    $('.star-5').click(function(e){
        var rate = 5 ;
        var productID = e.target.id;
        console.log(rate);
        console.log(e.target.id);
        console.log(productID);
        $.ajax({
          url:"http://amazend.com/customer/addrate",
          method: 'POST',
          data:{
                'product_id': productID,
                'rate':rate
             },
             dataType:'JSON',
             success: (function( data ) {
            console.log( data[0] );
          }
        ),
        error: function(xhr, ajaxOptions, thrownErrors) {
          console.log(xhr);
          console.log(ajaxOptions);
          console.log(thrownErrors);
        }

        })
});
})
// console.log(rate);

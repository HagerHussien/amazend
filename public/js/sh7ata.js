var inputs = $('.sh7ata[type=number]');
for (var i = 0; i < inputs.length; i++) {
    $(inputs[i]).data("lastval", $(inputs[i]).val());
}

function calcTotal() {
    var totals = $('#cart_table>tbody>tr>td:nth-of-type(6)');
    var sum = 0;
    for (var i = 0; i < totals.length; i++) {
        sum += parseInt($(totals[i]).text().split("$")[1]);
    }
    return sum;
}

$('.sh7ata[type=number]').on('input', function (e) {
    if ($(this).data("lastval") != $(this).val() && $(this).val() > 0) {
        $(this).data("lastval", $(this).val());
        var item_num = $(this).val();
        var uprice = $(this).parent().next();
        var unit_price = uprice.text().split("$")[1];
        var udiscount = $(this).parent().next().next();
        var discount = udiscount.text().split("(")[1].split("%")[0];
        var utotal = $(this).parent().next().next().next();
        var total = utotal.text().split("$")[1];
        var coup = $('#summary>tbody>.coup>th:first-of-type')
        var coupon_value = coup.length ? coup.text().split("-")[1].split("%")[0] : 0;

        //change ids
        $(this).attr('id', $(this).attr('id').split('_')[0] + "_" + item_num)
        var subtotal = item_num * unit_price;
        var discount_amount = discount * subtotal / 100;
        var netprice = subtotal - discount_amount;


        //cahnge text for total price of item
        udiscount.text("$" + discount_amount + " (" + discount + "%)");
        utotal.text("$" + netprice);

        //Order total
        var order_subtotal = calcTotal();
        var order_total = order_subtotal - (coupon_value) * order_subtotal / 100;

        $('#cart_table>tfoot>tr>th:nth-of-type(2)').text("$" + order_subtotal);
        $('#summary>tbody>tr:first-of-type>th:first-of-type').text("$" + order_subtotal);
        $('#summary>tbody>.total>th:first-of-type').text("$" + order_total);

    } else {
//        alert("This product has a minimum quantity of 1")
    }
});


$('#updatebasket').click(function (e) {
    e.preventDefault();
    var items = $('.sh7ata[type=number]');
    var obj = {};
    for (var i = items.length - 1; i >= 0; i--) {
        var item_id = $(items[i]).attr('id').split("_")[0];
        var item_quantity = $(items[i]).attr('id').split("_")[1];
        var price = $(items[i]).parent().next().text().split("$")[1];
        var discount = $(items[i]).parent().next().next().text().split("$")[1].split(" ")[0];
        var total = discount?item_quantity*price:$(items[i]).parent().next().next().next().text().split("$")[1];
        obj[i] = [item_id, item_quantity, price, total];
    }
    $.ajax({
        url: 'http://amazend.com/checkout/updatebasket',
        method: 'GET',
        data: obj,
        dataType: 'text',
        success: function (result) {
            console.log(result);
        }
    });
});

$('#placeorder').click(function (e) {
    e.preventDefault();
    $('#updatebasket').click();
    var items = $('.sh7ata[type=number]');
    var obj = {};
    var order_subtotal = calcTotal();
    var coup = $('#summary>tbody>.coup>th:first-of-type')
    var coupon_value = coup.length ? coup.text().split("-")[1].split("%")[0] : 0;
    var order_total = parseInt(order_subtotal) - parseInt(coupon_value) * parseInt(order_subtotal) / 100;
    for (var i = items.length - 1; i >= 0; i--) {
        var item_id = $(items[i]).attr('id').split("_")[0];
        var item_quantity = $(items[i]).attr('id').split("_")[1];
        var price = $(items[i]).parent().next().text().split("$")[1];
        var discount = $(items[i]).parent().next().next().text().split("$")[1].split(" ")[0];
//        var total = $(items[i]).parent().next().next().next().text().split("$")[1];
        var total = discount?item_quantity*price:$(items[i]).parent().next().next().next().text().split("$")[1];

        obj[i] = [item_id, item_quantity, price, discount, total];
    };
    $.ajax({
        url: 'http://amazend.com/checkout/placeorder',
        method: 'POST',
        data: {data:obj,'order_subtotal':order_subtotal,'coupon_value':coupon_value,'order_total':order_total},
        dataType: 'text',
        success: function (result) {
            console.log(result);
            window.location.href="/index";
        },
          error: function(xhr, ajaxOptions, thrownErrors) {
          console.log(xhr);
          console.log(ajaxOptions);
          console.log(thrownErrors);
        }
    })
//    console.log(obj);
});

$(document).ready(function () {

    function loadListOrderTotal() {
        $.ajax({
            type: 'POST',
            url: 'pemesanan_list_total.php',
            success: function (data) {
                $('.list-order-foot').html(data);
            }
        });
    }

    $('.del-cart').click(function () {
        var id = $(this).attr('data-menu-id');
        $.ajax({
            type: 'POST',
            url: 'pemesanan_list_del.php',
            data: {id: id},
            success: function() {
                loadListOrder();
                loadListOrderTotal();
            }
        });
    });
});



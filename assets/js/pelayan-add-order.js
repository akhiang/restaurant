$(document).ready(function () {
    loadOrderBody();
    loadOrderTotal();

    $('#table-order-list').on('click', '.del-order', function () {
        var id = $(this).attr('data-menu-id');
        var num = $(this).attr('data-order');
        $.ajax({
            type: 'POST',
            url: 'add_order_del.php',
            data: {
                id: id,
                num: num
            },
            success: function () {
                loadOrderBody();
                loadOrderTotal();
            }
        });
    })

    $('#cancel-ordered').on('click', function () {
        var meja_id = $(this).attr('data-meja-id');
        var num = $(this).attr('data-order-number');
        cancelOrdered(meja_id, num);
    })

    // $('#add-order-submit').click(function () {
    //     var num = $(this).attr('data-order');
    //     $.ajax({
    //         type: 'POST',
    //         url: 'add_order_submit.php',
    //         data: {
    //             num: num
    //         },
    //         success: function (data) {
    //             delCart(user_id);
    //             Swal.fire({
    //                 title: data.replace(/['"]+/g, ''),
    //                 text: 'Order added successful!',
    //                 icon: 'success',
    //                 confirmButtonText: 'Ok'
    //             })
    //         }
    //     })
    // });
})

function cancelOrdered(table, number) {
    $.ajax({
        type: 'POST',
        url: 'add_order_cancel_order.php',
        data: {
            table_id: table,
            order_number: number
        },
        success: function () {
            window.location.href = "pesanan.php";
        }
    })
}

function addToOrder(id) {
    var num = $('#number').val();
    var data = $('.menu-card' + id).serialize()
    $.ajax({
        type: 'post',
        url: 'add_order_add.php',
        data: data + '&num=' + num,
        success: function (response) {
            if (response == 'ingredient') {
                Swal.fire({
                    icon: 'info',
                    title: 'Can\'t add menu',
                    text: 'Please check the menu\'s ingredient',
                })
            } else if (response == 'quantity') {
                Swal.fire({
                    icon: 'info',
                    title: 'Can\'t add menu',
                    text: 'Please check the menu\'s ingredient quantity',
                })
            } else if (response == 'success') {
                loadOrderBody();
                loadOrderTotal();
            }
        },
        error: function () {
            alert('aa');
        }
    });
}

function emptyOrder(num) {
    $.ajax({
        type: 'POST',
        data: {
            num: num
        },
        url: 'add_order_empty_order.php',
        success: function () {}
    })
}

function loadOrderBody() {
    var num = $('#number').val();
    $.ajax({
        type: 'POST',
        data: {
            num: num
        },
        url: 'add_order_list_body.php',
        success: function (data) {
            $('#add-order-body').html(data);
        }
    });
}

function loadOrderTotal() {
    var num = $('#number').val();
    $.ajax({
        type: 'POST',
        url: 'add_order_list_total.php',
        data: {
            num: num
        },
        success: function (data) {
            $('#add-order-foot').html(data);
        }
    });
}
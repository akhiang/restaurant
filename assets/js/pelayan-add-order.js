$(document).ready(function () {
    loadOrderBody();
    loadOrderTotal();

    $('#table-order-list').on('click', '.del-order', function () {
        var id = $(this).attr('data-menu-id');
        var num = $(this).attr('data-order');
        $.ajax({
            type: 'POST',
            url: 'add_order_del.php',
            data: { id: id, num: num },
            success: function () {
                loadOrderBody();
                loadOrderTotal();
            }
        });
    })

    $('#add-order-submit').click(function () {
        // var user_id = $(this).attr('data-user-id');
        // var meja_id = $(this).attr('data-meja-id');
        // var tipe = $(this).attr('data-tipe');
        var num = $(this).attr('data-order');
        $.ajax({
            type: 'POST',
            url: 'add_order_submit.php',
            data: { num: num },
            success: function (data) {
                delCart(user_id);
                Swal.fire({
                    title: data.replace(/['"]+/g, ''),
                    text: 'Order added successful!',
                    icon: 'success',
                    confirmButtonText: 'Ok'
                })
            }
        })
    });
})

function addToOrder(id) {
    var num = $('#number').val();
    var data = $('.menu-card' + id).serialize()
    $.ajax({
        type: 'post',
        url: 'add_order_add.php',
        data: data + '&num=' +  num,
        success: function (response) {
            // checkSameItem(response);
            loadOrderBody();
            loadOrderTotal();
            // spinnerReset();
        }, error: function() {
            alert('aa');
        }
    });
}

function loadOrderBody() {
    var num = $('#number').val();
    $.ajax({
        type: 'POST',
        data: {num: num},
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
        data: { num: num },
        success: function (data) {
            $('#add-order-foot').html(data);
        }
    });
}
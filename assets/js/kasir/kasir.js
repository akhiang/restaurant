$(document).ready(function () {
    loadTable();
    loadEmptyOrderHead();
    loadEmptyOrder();
    loadEmptyOrderFoot();

    $(".table-container").niceScroll({
        // cursorcolor: "aquamarine"
    });

    $(".order-list-body").niceScroll({
        // cursorcolor: "aquamarine"
    });

    var tableOrder = $('#order-table').DataTable({
        "ajax": {
            url: "order_list_fetch.php",
            type: "POST",
            data: {
                is_date: 'no',
                from: '',
                to: '',
            }
        },
        "order": [
            [0, "desc"]
        ]
    });

    function toCurrency(num) {
        return currency(num, { precision: 0, separator: '.' }).format();
    }

    function notCurrency(num)   {
        return num.replace(/\./g, '');
    }
    
    $('#payment-modal-body').on('keypress','#bayar', function(e) {
        var keyCode = e.which ? e.which : e.keyCode

        if (!(keyCode >= 48 && keyCode <= 57)) {
            // $(".error").css("display", "inline");
            return false;
        } else {
            // $(".error").css("display", "none");
        }
    });

    $('#payment-modal-body').on('keyup','#bayar', function() {
        let total = $('#total').val();
        let bayar = $('#bayar').val();
        $('#pay-hidden').val(bayar);
        bayar = notCurrency(bayar);
        total = parseInt(notCurrency(total));
        let kembalian = bayar - total;
        
        $('#kembalian').val(toCurrency(kembalian));
        $('#bayar').val(toCurrency(bayar));
    });

    $.validator.addMethod('le', function (value, element, param) {
        value = notCurrency(value);
        total = notCurrency($(param).val())
        return this.optional(element) || parseInt(value) >= parseInt(total);
    }, 'Invalid value');

    $('#payment-form').validate({
        errorElement: "small",
        rules: {
            total: {
                required: true,
                number: true,
            },
            bayar: {
                required: true,
                number: true,
                le: '#total'
            },
            kembalian: {
                required: true,
                number: true,
            }
        },
        messages: {
            bayar: {
                le: 'Must be more than Total Amount'
            }
        },
        submitHandler: function (form) {
            var data = new FormData(form)
            $.ajax({
                url: "payment_submit.php",
                type: "POST",
                data: data,
                contentType: false,
                cache: false,
                processData: false,
                success: function (data) {
                    swal.fire({
                        icon: "success",
                        title: "Payment Successful",
                        timer: 3000
                    }).then(() => {
                        $('#btn-print')[0].click();
                        location.reload();
                    })
                    $("#payment-form")[0].reset();
                    $('#payment-modal').modal('toggle');
                }
            });
        }
    });

    $('[name="total"]').on('change blur keyup', function () {
        $('[name="bayar"]').valid();
    });

    $('.list-table').on('click', '.card', function () {
        $("#btn-payment").css("visibility", "");
        var no_trans = $(this).attr('data-no-trans');
        $.ajax({    
            type: 'POST',
            url: 'payment_order_head_load.php',
            data: { no_trans: no_trans },
            success: function (data) {
                $('.order-list-head').html(data);
            }
        });

        $.ajax({
            type: 'POST',
            url: 'payment_order_load.php',
            data: { no_trans : no_trans },
            success: function (data) {
                $('.order-list-body').html(data);
            }
        });

        $.ajax({
            type: 'POST',
            url: 'payment_order_total_load.php',
            data: {no_trans : no_trans},
            success: function (data) {
                $('.order-list-foot').html(data);
            }
        });

        $.ajax({
            type: 'POST',
            url: 'payment_order_payment.php',
            data: { no_trans : no_trans },
            success: function (data) {
                $('#payment-form').html(data);
            }
        });

        $('#btn-print').attr('data-order-number', no_trans);
    });

    $('#order-table').on('click', '.order-detail', function () {
        // $("#btn-payment").css("visibility", "");
        var no_trans = $(this).attr('data-order-number');        
        $.ajax({
            type: 'POST',
            url: 'order_list_view.php',
            data: {
                no_trans: no_trans
            },
            success: function (data) {
                $('#order-list-view').html(data);
            }
        });
    });
})

function pdf() {
    var num = $('#btn-print').attr('data-order-number');
    window.open("invoice/invoice.php?o=" + num);
}

function loadTable() {
    $.get('payment_load.php', function (data) {
        $('.list-table').html(data);
    });
};

function loadEmptyOrderHead() {
    $.get('empty_load_head.php', function (data) {
        $('.order-list-head').html(data);
    });
};

function loadEmptyOrder() {
    $.get('empty_load_body.php', function (data) {
        $('.order-list-body').html(data);
    });
};

function loadEmptyOrderFoot() {
    $.get('empty_load_foot.php', function (data) {
        $('.order-list-foot').html(data);
    });
};

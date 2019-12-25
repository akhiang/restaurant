$(document).ready(function () {
    loadTable();
    // loadOrderList();

    $(".table-container").niceScroll({
        // cursorcolor: "aquamarine"
    });

    $(".order-list-body").niceScroll({
        // cursorcolor: "aquamarine"
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
        // console.log(total);
        // total = notCurrency(total);
        bayar = notCurrency(bayar);
        total = parseInt(notCurrency(total));

        // console.log(typeof total, total);

        let kembalian = bayar - total;
        
        $('#kembalian').val(toCurrency(kembalian));
        $('#bayar').val(toCurrency(bayar));
    });

    $.validator.addMethod('le', function (value, element, param) {
        value = notCurrency(value);
        total = notCurrency($(param).val())
        // console.log(typeof notCurrency($(param).val()));
        // console.log(typeof value);
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
                le: 'Harus lebih dari Total.'
            }
        },
        submitHandler: function (form) {
            var data = new FormData(form)
            $.ajax({
                url: "table_submit_payment.php",
                type: "POST",
                data: data,
                contentType: false,
                cache: false,
                processData: false,
                success: function (data) {
                    swal.fire({
                        icon: "success",
                        title: "Transaksi Selesai",
                    });
                    $("#payment-form")[0].reset();
                    $('#payment-modal').modal('toggle');
                    // tableMenu.ajax.reload();
                }
            });
        }
    });

    $('[name="total"]').on('change blur keyup', function () {
        $('[name="bayar"]').valid();
    });

    $('.table-container').on('click', '.table-card', function () {
        var kode_meja = $(this).attr('data-table-id');
        var nama_meja = $(this).attr('data-table-name');
        var no_trans = $(this).attr('data-no-trans');
        
        $.ajax({    
            type: 'POST',
            url: 'table_order_head_load.php',
            data: {
                kode_meja: kode_meja,
                nama_meja: nama_meja,
                no_trans: no_trans,
            },
            success: function (data) {
                $('.order-list-head').html(data);
            }
        });

        $.ajax({
            type: 'POST',
            url: 'table_order_load.php',
            data: {
                no_trans : no_trans,
            },
            success: function (data) {
                $('.order-list-body').html(data);
            }
        });

        $.ajax({
            type: 'POST',
            url: 'table_order_total_load.php',
            data: {no_trans : no_trans},
            success: function (data) {
                $('.order-list-foot').html(data);
            }
        });

        $.ajax({
            type: 'POST',
            url: 'table_order_payment.php',
            data: {no_trans : no_trans, kode_meja: kode_meja, nama_meja: nama_meja},
            success: function (data) {
                $('#payment-form').html(data);
            }
        });
    })
})

function loadTable() {
    $.get('table_load.php', function (data) {
        $('.list-table').html(data);
    });
};

function LoadEmptyOrderHead() {
    $.get('table_order_head_load.php', function (data) {
        $('.order-list-head').html(data);
    });
};

function LoadEmptyOrder() {
    $.get('table_order_load.php', function (data) {
        $('.order-list-body').html(data);
    });
};

function LoadEmptyOrderTotal() {
    $.get('table_order_load.php', function (data) {
        $('.order-list-body').html(data);
    });
};

function firstLoad() {
    var kode_meja = 1;
    var nama_meja = 'M01';
    var no_trans = $(this).attr('data-no-trans');
    // alert(kode_meja);
    // var id = $(this).attr('data-menu-id');
    $.ajax({
        type: 'POST',
        url: 'table_order_head_load.php',
        data: {
            kode_meja: kode_meja,
            nama_meja: nama_meja,
            no_trans: no_trans,
        },
        success: function (data) {
            $('.order-list-head').html(data);
        }
    });

    $.ajax({
        type: 'POST',
        url: 'table_order_load.php',
        data: {
            no_trans: no_trans,
        },
        success: function (data) {
            $('.order-list-body').html(data);
        }
    });

    $.ajax({
        type: 'POST',
        url: 'table_order_total_load.php',
        data: { no_trans: no_trans },
        success: function (data) {
            $('.order-list-foot').html(data);
        }
    });
}
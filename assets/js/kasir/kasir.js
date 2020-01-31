$(document).ready(function () {
    loadTable();
    LoadEmptyOrderHead();
    LoadEmptyOrder();
    LoadEmptyOrderFoot();

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
                }
            });
        }
    });

    // $('.print').click(function() {
    //     var order_number = $(this).attr("data-number");
    //     window.location.href = "invoice/test.php?o=" + order_number;
    // });

    $('[name="total"]').on('change blur keyup', function () {
        $('[name="bayar"]').valid();
    });

    $('.list-table').on('click', '.card', function () {
        $("#btn-payment").css("visibility", "");
        var no_trans = $(this).attr('data-no-trans');
        $.ajax({    
            type: 'POST',
            url: 'table_order_head_load.php',
            data: { no_trans: no_trans },
            success: function (data) {
                $('.order-list-head').html(data);
            }
        });

        $.ajax({
            type: 'POST',
            url: 'table_order_load.php',
            data: { no_trans : no_trans },
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
            data: { no_trans : no_trans },
            success: function (data) {
                $('#payment-form').html(data);
            }
        });

        $('#btn-print').attr('data-order-number', no_trans);
    })
})

function pdf() {
    var num = $('#btn-print').attr('data-order-number');
    window.open("invoice/test.php?o=" + num);
    // window.location.href = "invoice/test.php?o=" + num , "_blank";
}

function loadTable() {
    $.get('table_load.php', function (data) {
        $('.list-table').html(data);
    });
};

function LoadEmptyOrderHead() {
    $.get('empty_load_head.php', function (data) {
        $('.order-list-head').html(data);
    });
};

function LoadEmptyOrder() {
    $.get('empty_load_body.php', function (data) {
        $('.order-list-body').html(data);
    });
};

function LoadEmptyOrderFoot() {
    $.get('empty_load_foot.php', function (data) {
        $('.order-list-foot').html(data);
    });
};

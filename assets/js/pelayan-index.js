$(document).ready(function () {
    
    $('select').val('');

    $('#tipepesanan').change(function () {
        var tipe = $(this).val();
        if(tipe == 2 || tipe == '') {
            $("#meja").prop('disabled', true);
        } else {
            $("#meja").prop('disabled', false);;
        }
    });

    $('#form-pesanan').validate({
        errorElement: "small",
        rules: {
            tipepesanan: {required: true,},
            id_meja: {required: true,},
        },
        messages: {
            tipepesanan: {required: 'This field is required',},
            id_meja: {required: 'This field is required',},
        },
        submitHandler: function (form) {   
            var tipe_pesanan = $('#tipepesanan').val();
            var id_meja = $('#meja').val();

            $.ajax({
                type: 'post',
                url: 'pemesanan_submit.php',
                data: {
                    tipe_id: tipe_pesanan,
                    id_meja: id_meja,
                },
                success: function () {
                    // alert('ok');
                }
            });

            form.submit();
        }
    });
})
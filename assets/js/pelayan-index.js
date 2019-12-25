$(document).ready(function () {

    $('#tipepesanan').change(function () {
        var tipe = $(this).val();
        if(tipe == 1 || tipe == '') {
            $("#meja").prop('disabled', true);
        } else {
            $("#meja").prop('disabled', false);;
        }
    });

    $('#form-pesanan').validate({
        errorElement: "small",
        rules: {
            tipepesanan: {
                required: true,
            },
            id_meja: {
                required: true,
            },
        },
        messages: {
            tipepesanan: {
                required: 'This field is required',
            },
            id_meja: {
                required: 'This field is required',
            },
        },
        submitHandler: function (form) {
            // var data = new FormData(form);
            // console.log(...data);
            // $.ajax({
            //     type: 'POST',
            //     url: "pemesanan.php",
            //     data: data,
            //     contentType: false,
            //     cache: false,
            //     processData: false,
            //     success: function () {
            //         form.submit();
            //     }
            // });
            form.submit();
        }
    });

    // $('#submit-pesanan').click(function () {
    //     $('#form-pesanan').submit();
    // });
})
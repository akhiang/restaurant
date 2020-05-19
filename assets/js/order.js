$(document).ready(function () {

    $(".menu-item").niceScroll();

    $('.menu-filter li span').on('click', function() {
        $('.menu-filter li span').each(function() {
            $(this).removeClass('active');
        })
        $(this).addClass('active');
    })

    loadCart();
    loadCartTotal();
    loadCheckoutOrder();

    // order-list.php

    $('.view-order').on('click', function() {
        var num = $(this).attr('data-no-trans');
        window.location.href = "order-list-detail.php?o=" + num;
    })

    // end order-list.php

    // order-list-detail.php

    $('.option-order-item').on('click', function () {
        var id = $(this).attr('data-id');
        var orderNumber = $(this).attr('data-order-num');
        Swal.fire({
            title: 'Are you sure',
            text: 'you want to cancel this menu?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, cancel it!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: 'POST',
                    url: 'order-list-detail-cancel-menu.php',
                    data: {
                        id: id,
                        orderNumber: orderNumber,                 
                    },
                    success: function (response) {
                        location.reload();
                    }
                });
            }
        })      
    });

    $('#cancel-order-btn').on('click', function () {
        var orderNumber = $(this).attr('data-order-num');
        var tableId = $(this).attr('data-table-id');
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, cancel it!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: 'POST',
                    url: 'order-list-detail-cancel.php',
                    data: {
                        orderNumber: orderNumber,
                        tableId: tableId
                    },
                    success: function (response) {
                        location.reload();
                        window.location.href = 'order-list.php';
                    }
                });
            }
        })      
    });
    
    $('.order-list-menu-note').on('click', function () {
        var id = $(this).attr('data-cart-id')
        $.ajax({
            type: 'POST',
            data: {
                id: id,
            },
            url: 'order-list-get-menu-note.php',
            success: function (response) {
                response = $.parseJSON(response);
                $('#checkout-menu-note').val(response.note);
            }
        });
    });
    // end order-list-detail.php

    //  Cart.php

    // ubah qty menu di cart
    $('#cart-table').on('change', '.qty-menu-cart', function () {
        var qty = $(this).val();
        var cart_id = $(this).attr('data-menu-id');
        var user_id = $(this).attr('data-user-id');

        if (qty == '') $(this).val(1);

        $.ajax({
            type: 'POST',
            url: 'cart-change-qty.php',
            data: {
                cart_id: cart_id,
                user_id: user_id,
                qty: qty
            },
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
                        text: 'Please check the ingredient inventory',
                    })
                } else if (response == 'success') {
                    loadCart();
                    loadCartTotal();
                }
            }
        });
    });

    $('#cart-table').on('click', '.note-menu-cart', function() {
        var id = $(this).attr('data-cart-id');
        $.ajax({
            type: 'POST',
            url: 'cart-note.php',
            data: {
                id: id,
            },
            success: function (response) {
                $('#menu-note-modal').html(response);
            }
        });
    })

    $('#menu-note-modal').on('change', '.note', function () {
        var id = $(this).attr('data-cart-id');
            note = $(this).val();
        
        $.ajax({
            type: 'POST',
            url: 'cart-note-save.php',
            data: {
                id: id,
                note: note,
            },
            success: function (response) {
                //
            }
        });
    })

    // hapus menu di cart
    $('#cart-table').on('click', '.del-menu-cart', function() {
        var id = $(this).attr('data-cart-id');
        var user_id = $(this).attr('data-user-id');

        Swal.fire({
            title: 'Are you sure?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: 'POST',
                    url: 'cart-delete.php',
                    data: {
                        id: id,
                        user_id: user_id
                    },
                    success: function (response) {
                        loadCart();
                        loadCartTotal();
                        Swal.fire(
                            'Deleted!',
                            'Menu has been deleted.',
                            'success'
                        )
                    }
                });
            }
        })
    });
    // End Cart.php

    // Checkout.php

    $('.order-radio').on('change', function () {
        var orderOption = $("input[name='orderRadio']:checked").val();
        $('#new-order-form').removeClass('d-block');
        $('#exist-order-form').removeClass('d-block');

        if (orderOption == 'new') {
            $('#new-order-form').addClass('d-block');
            $("#exist-order-form :input").each(function () {                
                $(this).prop('disabled', true).removeClass('error');
            });

            $("#new-order-form :input").each(function () {                
                $(this).removeClass('error');
            });
            $('#new-order-form input[name="customer1"]').prop('disabled', false);
            $('#order-type-select').prop('disabled', false);
        } else if (orderOption == 'exist') {
            $('#exist-order-form').addClass('d-block');
            $("#new-order-form :input").each(function () {            
                $(this).prop('disabled', true).removeClass('error');
            });

            $("#exist-order-form :input").each(function () {                
                $(this).prop('disabled', false).removeClass('error');
            });
        }
    });

    $('#order-type-select').change(function () {
        var tipe = $(this).val();
        if (tipe == 2 || tipe == '') {
            $("#order-table-select").prop('disabled', true);
        } else {
            $("#order-table-select").prop('disabled', false);;
        }
    });

    $('#button-addon').on('click', function() {
        $.ajax({
            type: 'POST',    
            url: 'checkout-exist-order.php',
            success: function (response) {
                $('#existOrderModal .modal-body').html(response);
            }
        });
    })

    $('#existOrderModal .modal-body').on('click', '.card', function () {
        var orderNumber = $(this).attr('data-order-number');
        $.ajax({
            type: 'POST',
            data: {orderNumber: orderNumber},
            url: 'checkout-get-exist-order.php',
            success: function (response) {
                response = $.parseJSON(response);
                $('#exist-order-form input[name="orderNumber"]').val(response.order_number);
                $('#exist-order-form input[name="customer2"]').val(response.customer_name);                
                $('#existOrderModal').modal('hide');
            }
        });
    });

    $('#checkout-order-table-body').on('click', '.checkout-menu-pen', function () {
        var id = $(this).attr('data-cart-id')
        $.ajax({
            type: 'POST',
            data: {
                id: id,
            },
            url: 'checkout-get-menu-note.php',
            success: function (response) {
                response = $.parseJSON(response);
                $('#checkout-menu-note').val(response.note);
                $('#checkout-menu-note').attr('data-cart-id', response.id);
            }
        });
    });

    $('#exampleModal').on('change', '.note', function () {
        var id = $(this).attr('data-cart-id');
        note = $(this).val();

        $.ajax({
            type: 'POST',
            url: 'cart-note-save.php',
            data: {
                id: id,
                note: note,
            },
            success: function (response) {
                //
            }
        });
    })

    $('#checkout-form').validate({
        errorElement: "small",
        rules: {
            orderRadio: {
                required: true,
            },
            customer1: {
                required: true,
            },
            customer2: {
                required: true,
            },
            orderTypeSelect: {
                required: true,
            },
            orderTableSelect: {
                required: true,
            },
            orderNumber: {
                required: true,
            },
        },
        messages: {
            orderRadio: {
                required: '* Please pick an option ',
            },
            customer1: {
                required: '* This field is required',
            },
            customer2: {
                required: '* This field is required',
            },
            orderTypeSelect: {
                required: '* Please select an order type',
            },
            orderTableSelect: {
                required: '* Please select an option',
            },
            orderNumber: {
                required: '* Please select an existing order',
            },
        },
        errorPlacement: function (error, element) {
            if (element.is(":radio")) {
                error.appendTo(element.parents('.radio-group'));
            } else if (element.attr('name') == 'orderNumber') {
                error.appendTo(element.parents('#exist-order-form .form-group'));
            } else { // This is the default behavior 
                error.insertAfter(element);
            }
        },
        submitHandler: function (form) {
            var data = $(form).serialize()

            $.ajax({
                type: 'POST',
                url: 'checkout-place-order.php',
                data: data,
                success: function (response) {
                    if (response == 'success') {
                        Swal.fire({
                            title: 'Success',
                            text: 'Order successful placed!',
                            icon: 'success',
                            confirmButtonText: 'Ok'
                        }).then(() => {
                            window.location.href = 'order-list.php';
                        })
                    }
                }
            });

            // console.log(data);
            // form.submit();
        }
    });

    // End Checkout.php
});

function setQty(id) {
    var qty = $('.spinner' + id).val();
    $('#qty' + id).val(qty);
}

function addCart(id) {
    var data = $('.menu-form' + id).serialize()    
    $.ajax({
        type: 'POST',
        url: 'order-add.php',
        cache: false,
        data: data,
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
                    text: 'Please check the ingredient inventory',
                })
            } else if (response == 'success') {
                toast();
            }
        }
    });
}

function loadCart() {
    $.ajax({
        type: 'POST',
        // data: {id: id},
        url: 'cart-load.php',
        success: function (response) {
            $('#cart-body').html(response);
        }
    });
}

function loadCartTotal() {
    $.ajax({
        type: 'POST',
        url: 'cart-total.php',
        success: function (response) {
            $('#cart-total').html(response);
        }
    });
}

function loadCheckoutOrder() {
    $.ajax({
        type: 'POST',
        url: 'checkout-order-details.php',
        success: function (response) {
            $('#checkout-order-table-body').html(response);
        }
    })
}

function toast() {
    Swal.fire({
        toast: true,
        icon: 'success',
        position: 'top',
        timer: 1200,
        timerProgressBar: true,
        title: 'Added to cart successfully',
        showConfirmButton: false,
        onOpen: (toast) => {
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })
}
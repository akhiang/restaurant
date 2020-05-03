$(document).ready(function () {

    clock();
    loadListOrder();
    loadListOrderTotal();

    $(".spinner").inputSpinner({
        buttonsClass: "btn-outline-success rounded"
    });

    $(".order-list-body").niceScroll();
    $(".menu-container").niceScroll();

    // $('#menu').isotope('layout');

    $('.menu-item').imagesLoaded(function () {
        // images have loaded
        var $menu = $('.menu-item').isotope();

        $('.menu-filter').on('click', 'span', function () {
            var filterValue = $(this).attr('data-filter');
            $menu.isotope({
                filter: filterValue
            });
            return false;
        });
    });

    // --------------------- Pelayan table.php

    // bakso modifier modal
    $('form[id="modifier-form"]').validate({
        rules: {
            'mie[]': {
                required: true,
            }
        },
        messages: {
            'mie[]': {
                required: "You must check at least 1 box",
            }
        },
        submitHandler: function (form) {
            // console.log('success');
            var data = new FormData(form)
            $.ajax({
                url: "pemesanan_add_modifier.php",
                type: "POST",
                data: data,
                contentType: false,
                cache: false,
                processData: false,
                success: function (response) {
                    loadListOrder();
                    loadListOrderTotal();
                    $("#modifier-form")[0].reset();
                    $('#baksoModal').modal('toggle');
                }
            });
        }
    });

    // pesanan.php
    $('.add-order').click(function () {
        var no_trans = $(this).attr('data-no-trans');
        $.ajax({
            type: 'post',
            url: 'add_order_conf.php',
            data: {
                no_trans: no_trans
            },
            success: function (data) {
                $('#add-order-conf').html(data);
            }
        });
    });
    //

    // table.php
    $('.view-order').click(function () {
        var no_trans = $(this).attr('data-no-trans');
        var nama_meja = $(this).attr('data-meja-name');
        $.ajax({
            type: 'post',
            url: 'table_view_order.php',
            data: {
                no_trans: no_trans,
                nama_meja: nama_meja
            },
            success: function (data) {
                $('#table-view-order').html(data);
            }
        });
    });

    $('.btn-new-order').click(function () {
        var id = $(this).attr('data-table');
        $.ajax({
            type: 'post',
            url: 'table_new_order_conf.php',
            data: {
                meja_id: id
            },
            success: function (data) {
                $('#table-new-order-conf').html(data);
            }
        });
    });

    $('#btn-new-order-modal').click(function () {
        var tipe = $('#table-new-order-form input[name="tipe_id"]').val();
        var meja = $('#table-new-order-form input[name="id_meja"]').val();

        $.ajax({
            type: 'post',
            url: 'pemesanan_submit.php',
            data: {
                tipe_id: tipe,
                id_meja: meja,
            }
        });
        $("#table-new-order-form").submit(); // Submit the form
    });
    // table.php

    // pemesanan.php

    // hapus menu dari cart
    $('#table-order-list').on('click', '.del-menu-cart', function () {
        var id = $(this).attr('data-menu-id');
        var user = $(this).attr('data-user-id');
        $.ajax({
            type: 'POST',
            url: 'pemesanan_list_del.php',
            data: {
                id: id,
                user: user
            },
            success: function () {
                loadListOrder();
                loadListOrderTotal();
            }
        });
    })

    $('#place-order').click(function () {
        var user_id = $(this).attr('data-user-id');
        var meja_id = $(this).attr('data-meja-id');
        var tipe = $(this).attr('data-tipe');
        $.ajax({
            type: 'POST',
            url: 'pemesanan_place_order.php',
            data: {
                user_id: user_id,
                meja_id: meja_id,
                tipe: tipe,
            },
            success: function (response) {
                emptyCart(user_id);
                Swal.fire({
                    title: 'Success',
                    text: 'Order successful placed!',
                    icon: 'success',
                    confirmButtonText: 'Ok'
                }).then(() => {
                    window.location.href = 'pesanan.php';
                })
            }
        })
    });
    // pemesanan.php end
});

function clock() {
    var clock = document.getElementById("clock");
    var waktu = new Date();
    var jam = waktu.getHours() + "";
    var menit = waktu.getMinutes() + "";
    var detik = waktu.getSeconds() + "";
    clock.innerHTML = (jam.length == 1 ? "0" + jam : jam) + ":" + (menit.length == 1 ? "0" + menit : menit) + ":" + (detik.length == 1 ? "0" + detik : detik);
    setTimeout("clock()", 1000);
}

function loadListOrder() {
    $.ajax({
        type: 'POST',
        // data: {id: id},
        url: 'pemesanan_list_load.php',
        success: function (data) {
            $('#order-list-body').html(data);
        }
    });
}

function loadListOrderTotal() {
    $.ajax({
        type: 'POST',
        url: 'pemesanan_list_total.php',
        // data: {id: id},
        success: function (data) {
            $('#order-list-foot').html(data);
        }
    });
}

function cancelListOrder() {
    var table = $('.input_table').val(),
        user = $('.input_user').val();
    $.ajax({
        type: 'POST',
        data: {
            table: table,
            user: user,
        },
        url: 'pemesanan_cancel_order2.php',
        success: function () {
            window.location.href = "index.php";
        }
    })
}

function addToCart(id) {
    var data = $('.menu-card' + id).serialize()
    $.ajax({
        type: 'post',
        url: 'pemesanan_list_add.php',
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
                    text: 'Please check the menu\'s ingredient quantity',
                })
            } else if (response == 'success') {
                loadListOrder();
                loadListOrderTotal();
            }
        }
    });
}

function emptyCart(id) {
    $.ajax({
        type: 'POST',
        data: {
            id: id
        },
        url: 'pemesanan_del_cart.php',
        success: function () {}
    })
}

$(function () {
    // $(".navbar .nav-link").on('click', function() {
    //     var cur = $(this).parent().index();
    //     $('.nav-link').removeClass('active');
    //     $('.navbar .nav-link').eq(cur).addClass('active');
    // });

    $(window).on('scroll', function () {
        $(window).scrollTop() ? $('.navbar').addClass('fixed-top') : $('.navbar').removeClass('fixed-top')
    });

    $('#modalMenu').on('shown.bs.modal', function () {
        var $container = $('.menu-item2').isotope({
            itemSelector: '.card',
            layoutMode: 'fitRows'
        });

        $('.filter2').on('click', 'span', function () {
            var filterValue = $(this).attr('data-filter');
            $container.isotope({
                filter: filterValue
            });
            return false;
        });
    });

});
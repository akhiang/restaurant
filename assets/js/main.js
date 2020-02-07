$(document).ready(function () {

    clock();
    loadListOrder();
    loadListOrderTotal();

    $(".spinner").inputSpinner({
        buttonsClass: "btn-outline-success rounded"
    });

    $(".order-list-body").niceScroll();
    // $(".menu-item").niceScroll();

    // $('#menu').isotope('layout');

    var $menu = $('.menu-item').isotope({

    });
    
    $('.menu-filter').on('click', 'span', function () {
        var filterValue = $(this).attr('data-filter');
        $menu.isotope({
            filter: filterValue
        });
        return false;
    });

    // --------------------- Pelayan table.php
    // add more order
    $('.view-order').click(function() {
        var no_trans = $(this).attr('data-no-trans');
        var nama_meja = $(this).attr('data-meja-name');
        $.ajax({
            type: 'post',
            url: 'table_view_order.php',
            data: {no_trans: no_trans, nama_meja: nama_meja},
            success: function(data) {
                $('#table-view-order').html(data);
            }
        });
    });

    $('.add-order').click(function() {
        var no_trans = $(this).attr('data-no-trans');
        $.ajax({
            type: 'post',
            url: 'add_order_conf.php',
            data: { no_trans: no_trans },
            success: function (data) {
                $('#add-order-conf').html(data);
            }
        });
    });
    // add more order
    // --------------------- table.php 

    // pemesanan.php

    $('#table-order-list').on('click', '.del-cart', function () {
        var id = $(this).attr('data-menu-id');
        var user = $(this).attr('data-user-id');
        $.ajax({
            type: 'POST',
            url: 'pemesanan_list_del.php',
            data: { id: id, user: user },
            success: function () {
                loadListOrder();
                loadListOrderTotal();
            }
        });
    })

    $('.make-order').click(function () {
        var user_id = $(this).attr('data-user-id');
        var meja_id = $(this).attr('data-meja-id');
        var tipe = $(this).attr('data-tipe');
        $.ajax({
            type: 'POST',
            url: 'pemesanan_make_order.php',
            data: {
                user_id: user_id,
                meja_id: meja_id,
                tipe: tipe,
            },
            success: function (data) {
                delCart(user_id);
                Swal.fire({
                    title: data.replace(/['"]+/g, ''),
                    text: 'Order successful placed!',
                    icon: 'success',
                    confirmButtonText: 'Ok'
                })
            }
        })
    });

    $('.cancel-order').click(function () {
        var meja_id = $(this).attr('data-meja-id');
        var user_id = $(this).attr('data-user-id');
        $.ajax({
            type: 'POST',
            url: 'pemesanan_cancel_order.php',
            data: {
                meja_id: meja_id
            },
            success: function () {
                delCart(user_id);
                window.location.href = "index.php";
            }
        })
    });
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

function delCart(id) {
    $.ajax({
        type: 'POST',
        data: {id: id},
        url: 'pemesanan_del_cart.php',
        success: function () {
            loadListOrder();
            loadListOrderTotal();
        }
    })
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
        success: function(data) {
            $('#order-list-foot').html(data);
        }
    });
}

function addToCart(id){
    var data = $('.menu-card' + id).serialize()
    // var user_id = $('input[name="hidden_user_id"]').val();
    // alert(kode_meja);
    $.ajax({
        type:'post',
        url:'pemesanan_list_add.php',
        data: data,
        success:function (response) {
            checkSameItem(response);
            loadListOrder();
            loadListOrderTotal();
            spinnerReset();  
        }
    });
}

function spinnerReset() {
    $('.spinner').val(1);
}

function checkSameItem(item) {
    if(item) {
        alert('Item sudah ada');
    }
}

$(function() {  
    // $(".navbar .nav-link").on('click', function() {
    //     var cur = $(this).parent().index();
    //     $('.nav-link').removeClass('active');
    //     $('.navbar .nav-link').eq(cur).addClass('active');
    // });

    $(window).on('scroll', function(){
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

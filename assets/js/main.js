$(document).ready(function () {

    // clock();

    $('.navbar a[href^="./' + location.pathname.split("/")[3] + '"]').addClass('active');

    $(".spin").inputSpinner({
        buttonsClass: "btn-outline-success rounded"
    });

    $(".order-list-body").niceScroll();
    // $(".menu-container").niceScroll();

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

$(function () {
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

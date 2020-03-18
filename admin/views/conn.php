<?php
    $conn = mysqli_connect("localhost", "root", "", "restaurant");
    if(!$conn) {
        die("Connecttion failed: ".mysqli_connect_error());
    }

    function orderStatus($status){
        if($status == 'unpaid'){
            return '<span class="badge badge-warning">Unpaid</span>';
        } else if($status == 'paid') {
            return '<span class="badge badge-success">Paid</span>';
        } else {
            return '<span class="badge badge-secondary">Cancelled</span>';
        }
    }
?>
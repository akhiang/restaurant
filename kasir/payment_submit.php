<?php
    require_once "../conn.php";
    date_default_timezone_set("Asia/Bangkok");
    $kode_meja = $_POST['kode_meja'];
    $no_trans = $_POST['no_trans'];
    $tgl = date("Y-m-d");
    $waktu = date("h:i:sa");
    $pay = $_POST['pay_hidden'];
    $total = $_POST['total_hidden'];

    $sql = "INSERT INTO tb_bills VALUES ('','$no_trans','$tgl', '$waktu', '$total', '$pay')";
    $q = $conn->query($sql);

    $sql = "UPDATE tb_order SET order_status = 'paid' WHERE order_number = '$no_trans'";
    $q = $conn->query($sql);
    
    if ($kode_meja != 0) {
        $sql = "UPDATE tb_meja SET status = 1 WHERE kode_meja='$kode_meja'";
        $q = $conn->query($sql);
    }

?>
<?php
    require_once "../conn.php";

    date_default_timezone_set("Asia/Bangkok");
    $kode_meja = $_POST['kode_meja'];
    $no_trans = $_POST['no_trans'];
    $tgl = date("Y-m-d");
    $waktu = date("h:i:sa");
    $total = $_POST['total_hidden'];

    $sql = "INSERT INTO tb_bills (id, order_number, tgl, waktu, total) VALUES ('','$no_trans','$tgl', '$waktu', '$total')";
    $q = $conn->query($sql);

    $sql = "UPDATE tb_order SET paid = 1 WHERE order_number = '$no_trans'";
    $q = $conn->query($sql);
    
    if ($kode_meja != 0) {
        echo "dine in";
        $sql = "UPDATE tb_meja SET status = 1 WHERE kode_meja='$kode_meja'";
        $q = $conn->query($sql);
    }

?>
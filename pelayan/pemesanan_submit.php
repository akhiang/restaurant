<?php
    require_once "../conn.php";
    session_start();
    // date_default_timezone_set("Asia/Bangkok");

    // $user_id = $_SESSION["user_id"];
    // $tgl = date("Y-m-d");
    // $waktu = date("h:i:sa");
    $tipe = $_POST['tipe'];

    if($tipe == 2) {
        $kode_meja = '';
    } else {
        $kode_meja = $_POST['id_meja'];
        $sql = "UPDATE tb_meja set status = 0 WHERE kode_meja = $kode_meja";
        $q = $conn->query($sql);
    }

    // insert order baru di tabel order
    // $sql = "INSERT INTO tb_order(order_id, order_number, tipe_pesanan_id, kode_meja, user_id, tgl, waktu, subtotal, tax, total, deleted) 
    //         VALUES('', '$order_number', $tipe, '$kode_meja', '$user_id', '$tgl', '$waktu', '', '', '', 0)";
    // $q = $conn->query($sql);
?>
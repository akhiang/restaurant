<?php
    require_once "../conn.php";

    $kode_meja = $_POST['kode_meja'];
    $no_trans = $_POST['no_trans'];
    $tgl = date("Y-m-d");
    $waktu = date("h:i:sa");
    $total = $_POST['total_hidden'];

    // $sql = "INSERT INTO tb_bills (id, no_trans, tgl, total) VALUES ('','$no_trans','$tgl', '$waktu', '$total')";
    // $q = $conn->query($sql);
    
    if ($kode_meja !== 0) {
        echo "zero";
        // $sql = "UPDATE tb_meja SET status = 1 WHERE kode_meja='$kode_meja'";
        // $q = $conn->query($sql);
    }

?>
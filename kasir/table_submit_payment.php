<?php
    require_once "../conn.php";

    $kode_meja = $_POST['kode_meja'];
    $no_trans = $_POST['no_trans'];
    $tgl = date("Y-m-d");
    $total = $_POST['total_hidden'];

    $sql = "INSERT INTO tb_bills (id, no_trans, tgl, total) VALUES ('','$no_trans','$tgl','$total')";
    $q = $conn->query($sql);

    $sql = "UPDATE tb_meja SET status=1 WHERE kode_meja='$kode_meja'";
    $q = $conn->query($sql);
?>
<?php
    require_once "../conn.php";
    $kode = $_POST['kode_meja'];
    $nama = $_POST['nama_meja'];
    $status = $_POST['status'];
    $sql = "INSERT INTO tb_meja (kode_meja, nama_meja,status) VALUES ('$kode','$nama','$status')";
    $q = $conn->query($sql);
?>
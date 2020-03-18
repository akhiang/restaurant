<?php
    require_once "../conn.php";
    
    $kode = $_POST['kode_meja'];
    $nama = $_POST['nama_meja'];

    $sql = "INSERT INTO tb_meja (kode_meja, nama_meja, status) VALUES ('$kode','$nama', 1)";
    $q = $conn->query($sql);
?>
<?php
	require_once "../conn.php";
    $kode = $_POST['kode_meja'];
    $nama = $_POST['nama_meja'];
    $status = $_POST['status'];
	$sql = "UPDATE tb_meja SET nama_meja = '$nama', status = $status WHERE kode_meja = '$kode'";
    $conn->query($sql);
?>

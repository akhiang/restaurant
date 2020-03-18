<?php
    require_once "../conn.php";
    $id = $_POST['id'];
	$sql = "DELETE FROM tb_meja WHERE kode_meja = '$id'";
    $conn->query($sql);
?>
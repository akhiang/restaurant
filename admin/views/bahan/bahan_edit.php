<?php
	require_once "../conn.php";
    $id = $_POST['id'];
    $name = $_POST['name'];
    $unit = $_POST['unit'];
    $qty = $_POST['qty'];
	$sql = "UPDATE tb_bahan SET name = '$name', unit = '$unit', qty = '$qty' WHERE id = '$id'";
    $conn->query($sql);
?>

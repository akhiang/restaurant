<?php
	require_once "../conn.php";

    $path = "../assets/images/menu/".basename($_FILES['image']['name']);
    $id = $_POST['id'];
    $nama = $_POST['nama_menu'];
    $jenis = $_POST['jenis'];
    $stock = $_POST['stock'];
    $harga = $_POST['harga'];
    $gambar = $_FILES['image']['name'];

	$sql = "UPDATE tbl_menu SET nama_menu = '$nama', jenis = '$jenis', harga = '$harga',
			stok = '$stock', gambar = '$gambar' WHERE id = '$id'";
    $conn->query($sql);
    
    move_uploaded_file($_FILES['image']['tmp_name'],$path)
?>

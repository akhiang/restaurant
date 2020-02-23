<?php
	require_once "../conn.php";

    $path = "../assets/images/menu/".basename($_FILES['image']['name']);
    $id = $_POST['id'];
    $nama = $_POST['nama_menu'];
    $desc = $_POST['desc'];
    $jenis = $_POST['jenis'];
    $harga = $_POST['harga'];
    $gambar = $_FILES['image']['name'];

	$sql = "UPDATE tbl_menu SET nama_menu = '$nama', description = '$desc', jenis = '$jenis', harga = '$harga', 
            gambar = '$gambar' WHERE id = '$id'";
    $conn->query($sql);
    
    move_uploaded_file($_FILES['image']['tmp_name'],$path)
?>

<?php
    require_once "../conn.php";
    $id = $_POST['id'];

    $q = $conn->query("SELECT * FROM tbl_menu WHERE id = '$id'");
    $data = $q->fetch_assoc();
    $old_img = $data['gambar'];
    unlink("../../../assets/images/menu/".$old_img); //delete image

	$sql = "UPDATE tbl_menu SET deleted = 1 WHERE id = '$id'";
    $conn->query($sql);
?>
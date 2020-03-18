<?php
    require_once "../conn.php";
    $id = $_POST['id'];
	$sql = "UPDATE tbl_menu SET deleted = 1 WHERE id = '$id'";
    $conn->query($sql);
?>
<?php
    require_once "../conn.php";
    $id = $_POST['id'];
	$sql = "DELETE FROM tbl_user WHERE id = '$id'";
    $conn->query($sql);
?>
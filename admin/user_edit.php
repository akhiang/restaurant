<?php
	require_once "../conn.php";

	$id = $_POST['id'];
	$username = $_POST['username'];
	$pass = $_POST['password'];
	$role = $_POST['role'];

	$sql = "UPDATE tbl_user SET username = '$username', password = '$pass',
			role = '$role' WHERE id = '$id'";
	$conn->query($sql);
?>
<?php
include 'conn.php';
session_start();
if (isset($_POST['login'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];

	if(empty($username) || empty($password)){
		header('Location:../index.php?error=emptyfields');
		exit();
	}
	else {
		$sql = mysqli_query($conn, "SELECT * from tbl_user where username='$username' and password='$password'") or die(mysqli_error($con));
		$data = mysqli_fetch_assoc($sql);
		var_dump($data);
	}

	// if (mysqli_num_rows($sql) > 0) {
	// 	$data = mysqli_fetch_assoc($sql);
	// 	if ($data['role'] == "admin") {
	// 		$_SESSION['username'] = $data['username'];
	// 		$_SESSION['role'] = "admin";
	// 		header("location:admin/index.php");
	// 	} else if ($data['role'] == "pelayan") {
	// 		$_SESSION['username'] = $data['username'];
	// 		$_SESSION['role'] = "pelayan";
	// 		header("location:pelayan/index.php");
	// 	} else if ($data['role'] == "kasir") {
	// 		$_SESSION['username'] = $data['username'];
	// 		$_SESSION['role'] = "kasir";
	// 		header("location:kasir/index.php");
	// 	}
	// } else {
	// 	// header("location:index.php?pesan=gagal") or die(mysql_error());
	// }
}

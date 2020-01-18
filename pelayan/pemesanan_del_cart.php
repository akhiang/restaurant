<?php
    require_once "../conn.php";

    $user_id = $_POST['id'];
	$sql = "DELETE FROM tb_cart_detail WHERE user_id = '$user_id'";
    $conn->query($sql);
?>
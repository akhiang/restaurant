<?php
    require_once "../conn.php";

	$sql = "DELETE FROM tb_cart_detail";

    $conn->query($sql);
?>
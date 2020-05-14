<?php
    require_once "../conn.php";

    $orderNumber = $_POST['orderNumber'];
    $conn->query("UPDATE tb_order SET order_status = 'cancelled' WHERE order_number = '$orderNumber'");
?>
<?php 
    include "../conn.php";

    $order_number = $_POST['orderNumber'];
    $q = mysqli_query($conn, "SELECT customer_name, order_number FROM tb_order WHERE order_number = '$order_number'");
    $result = mysqli_num_rows($q);

    if($result > 0) {

        $row = mysqli_fetch_assoc($q);
        
        echo json_encode($row);
    }
?>
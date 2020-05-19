<?php 
    include "../conn.php";

    $cartId = $_POST['id'];
    $q = mysqli_query($conn, "SELECT id, note FROM tb_cart_detail WHERE id = '$cartId'");
    $result = mysqli_num_rows($q);

    if($result > 0) {

        $row = mysqli_fetch_assoc($q);
        
        echo json_encode($row);
    }
?>
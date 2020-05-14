<?php
    require_once "../conn.php";
    
    if (!empty($_POST)) {
        $user_id = $_POST['hidden_user_id'];
        $menu_id = $_POST['hidden_id'];
        $name = $_POST['hidden_name'];
        $qty = $_POST['hidden_qty'];
        $price = $_POST['hidden_price'];
        
        $sameItem = $conn->query("SELECT * FROM tb_cart_detail WHERE user_id = '$user_id' AND menu_id = '$menu_id'");

        if ($sameItem->num_rows > 0) {       
            $sql = "UPDATE tb_cart_detail SET qty = qty + $qty WHERE user_id = '$user_id' AND menu_id = '$menu_id'";
        } else {
            $sql = "INSERT INTO tb_cart_detail (user_id, menu_id, menu_name, qty, price, id) VALUES
                ('$user_id', '$menu_id', '$name', $qty, '$price', '')";
        }
        $conn->query($sql);
        $status = 'success';

    }

    echo $status;
?>
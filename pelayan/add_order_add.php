<?php
    require_once "../conn.php";
    $order_number = $_POST['num'];
    // $user_id = $_POST['hidden_user_id'];
    $kode = $_POST['hidden_kode_menu'];
    // $nama = $_POST['hidden_nama_menu'];
    $qty = $_POST['qty_menu'];
    $harga = $_POST['hidden_harga'];

    $sql = "INSERT INTO tb_order_detail_temp (order_number, kode_menu, qty, harga, id) VALUES
            ('$order_number', '$kode', '$qty', '$harga', '')";
    
    $sameItem = $conn->query("SELECT * FROM tb_order_detail_temp WHERE order_number = '$order_number' AND kode_menu = '$kode'");

    if($sameItem->num_rows > 0) {       
        $sql2 = "UPDATE tb_order_detail_temp SET qty = qty + 1 WHERE order_number = '$order_number' AND kode_menu = '$kode'";
        $conn->query($sql2);
    }
    else {
        $conn->query($sql);
    }
?>
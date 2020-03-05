<?php
    require_once "../conn.php";
    session_start();
    date_default_timezone_set("Asia/Bangkok");
    $user_id = $_POST['user_id'];
    $table_id = $_POST['meja_id'];
    $tipe = $_POST['tipe'];
    
    $q = $conn->query("SELECT MAX(order_number) as nomor from tb_order");
    $data = mysqli_fetch_assoc($q);
    $number = $data['nomor'];
    $number++;
    $kode = sprintf('%05s',$number);
    // var_dump($kode);

    $subtotal = 0;
    $tgl = date("Y-m-d");
    $waktu = date("h:i:sa");

    $sql = "INSERT INTO tb_order_detail (order_number, menu_id, menu_name, qty, price) 
            SELECT '$kode', menu_id, menu_name, qty, price FROM tb_cart_detail WHERE user_id = '$user_id'";
    $q = $conn->query($sql);

    $sql = "SELECT * FROM tb_order_detail WHERE order_number = '$kode'";
    $q = $conn->query($sql);
    foreach ($q as $row) {
        $amount = $row['price'] * $row['qty'];
        $subtotal += $amount;
    }
    $tax = $subtotal * 0.1;
    $total = $subtotal + $tax;

    $sql = "INSERT INTO tb_order VALUES ('', '$kode', 0, '$tipe', '$table_id',
                '$user_id','$tgl','$waktu','$subtotal','$tax','$total', 0)";    
    $q = $conn->query($sql);

    // echo json_encode($kode);
?>
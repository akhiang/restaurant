<?php
    require_once "../conn.php";
    session_start();
    date_default_timezone_set("Asia/Bangkok");
    $user_id = $_POST['user_id'];
    $kode_meja = $_POST['meja_id'];
    $tipe = $_POST['tipe'];
    
    $sqlCode = "SELECT MAX(order_number) as nomor from tb_order";
    $qCode = $conn->query($sqlCode);
    $data = mysqli_fetch_assoc($qCode);
    $auto = $data['nomor'];
    $auto++;
    $kode = sprintf('%05s',$auto);

    $subtotal = 0;
    $tgl = date("Y-m-d");
    $waktu = date("h:i:sa");

    $sql = "INSERT INTO tb_order_detail_temp (order_number, kode_menu, qty, harga) SELECT
            '$kode', kode_menu, qty, harga FROM tb_cart_detail WHERE user_id = '$user_id'";
    $q = $conn->query($sql);

    $sql = "SELECT * FROM tb_order_detail_temp WHERE order_number = '$kode'";
    $q = $conn->query($sql);
    foreach ($q as $row) {
        $amount = $row['harga'] * $row['qty'];
        $subtotal += $amount;
    }
    $tax = $subtotal * 0.1;
    $total = $subtotal + $tax;

    $sql = "INSERT INTO tb_order VALUES ('', '$kode', 0, '$tipe', '$kode_meja','$user_id','$tgl','$waktu','$subtotal','$tax','$total', 0)";
    $q = $conn->query($sql);

    echo json_encode($kode);
    // echo mysqli_error($conn);

    // $sameItem = $conn->query("SELECT * FROM tb_cart_detail WHERE kode_menu = '$kode'");

    // if($sameItem->num_rows > 0) {       
    //     echo 1;
    // }
    // else {
    //     $q = mysqli_query($conn,$sql);
    // }
?>
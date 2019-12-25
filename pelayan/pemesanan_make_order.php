<?php
    require_once "../conn.php";
    session_start();
    date_default_timezone_set("Asia/Bangkok");
    $user_id = $_SESSION['user_id'];
    $kode_meja = $_POST['meja_id'];

    $sqlCode = "SELECT MAX(no_transaksi) as nomor from tb_order";
    $qCode = $conn->query($sqlCode);
    $data = mysqli_fetch_assoc($qCode);
    $auto = $data['nomor'];
    $auto++;
    $kode = sprintf('%05s',$auto);

    $tgl = date("Y-m-d");
    $waktu = date("h:i:sa");

    $sql = "INSERT INTO tb_order_detail (no_transaksi, kode_menu, nama_menu, qty, harga) SELECT
            '$kode', kode_menu, nama_menu, qty, harga FROM tb_cart_detail" or die(mysqli_error($conn));
    $q = $conn->query($sql);

    $sql = "SELECT * FROM tb_order_detail WHERE no_transaksi = '$kode'";
    $q = $conn->query($sql);
    foreach ($q as $row) {
        $amount = $row['harga'] * $row['qty'];
        $subtotal += $amount;
    }
    $tax = $subtotal * 0.1;
    $total = $subtotal + $tax;

    $sql = "INSERT INTO tb_order VALUES ('$kode','$kode_meja','$user_id','$tgl','$waktu','$subtotal','$tax','$total')";
    $q = $conn->query($sql);

    $sql = "UPDATE tb_meja set status = 0 WHERE kode_meja = $kode_meja";
    $q = $conn->query($sql);
    // echo mysqli_error($conn);

    // $sameItem = $conn->query("SELECT * FROM tb_cart_detail WHERE kode_menu = '$kode'");

    // if($sameItem->num_rows > 0) {       
    //     echo 1;
    // }
    // else {
    //     $q = mysqli_query($conn,$sql);
    // }
?>
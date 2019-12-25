<?php
    require_once "../conn.php";
    
    $kode_meja = $_POST['hidden_kode_meja'];
    $kode = $_POST['hidden_kode_menu'];
    $nama = $_POST['hidden_nama_menu'];
    $qty = $_POST['qty_menu'];
    $harga = $_POST['hidden_harga'];

    $sql = "INSERT INTO tb_cart_detail (kode_meja, kode_menu, nama_menu, qty, harga) VALUES
            ('$kode_meja', '$kode','$nama','$qty','$harga')";

    $sameItem = $conn->query("SELECT * FROM tb_cart_detail WHERE kode_menu = '$kode'");

    if($sameItem->num_rows > 0) {       
        echo 1;
    }
    else {
        $q = mysqli_query($conn,$sql);
    }
?>
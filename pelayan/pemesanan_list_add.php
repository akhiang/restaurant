<?php
    require_once "../conn.php";

    $user_id = $_POST['hidden_user_id'];
    $kode = $_POST['hidden_kode_menu'];
    $nama = $_POST['hidden_nama_menu'];
    $qty = $_POST['qty_menu'];
    $harga = $_POST['hidden_harga'];

    $sql = "INSERT INTO tb_cart_detail (user_id, kode_menu, nama_menu, qty, harga) VALUES
            ('$user_id', '$kode','$nama','$qty','$harga')";

    $sameItem = $conn->query("SELECT * FROM tb_cart_detail WHERE user_id = '$user_id' AND kode_menu = '$kode'");

    if($sameItem->num_rows > 0) {       
        $q = "UPDATE tb_cart_detail SET qty = qty + 1 WHERE user_id = '$user_id' AND kode_menu = '$kode'";
        $conn->query($q);
    }
    else {
        $q = mysqli_query($conn,$sql);
    }
?>
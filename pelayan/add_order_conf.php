<?php  
    require_once "../conn.php";
    $no_trans = $_POST['no_trans'];

    $sql = "SELECT * FROM tb_order WHERE order_number = '$no_trans'";  
    $q = $conn->query($sql);
    $data = $q->fetch_assoc();
?>
        <input type="hidden" value="<?php echo $no_trans; ?>" name="number">
        <input type="hidden" value="<?php echo $data['tipe_pesanan_id']; ?>" name="tipe_id">
        <input type="hidden" value="<?php echo $data['kode_meja']; ?>" name="meja_id">
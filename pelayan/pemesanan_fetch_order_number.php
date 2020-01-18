<?php
    require_once "../conn.php";
// cek order number di tabel order
    $sql = "SELECT MAX(order_number) as number from tb_order";  
    $q = $conn->query($sql);
    $number = $q->fetch_assoc();
    $auto = $number['number'];
    $auto++;    // increment order number baru
    $new_number = sprintf('%05s',$auto);
?>
    <input type="text" value="<?php echo $new_number; ?>" id="order_number_auto" name="order_number_auto">
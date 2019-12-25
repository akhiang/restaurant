<?php
    include "../conn.php";
    
    $subtotal = 0;
    $tax = 0;
    $total = 0;
    $sql = "SELECT * FROM tb_cart_detail";
    $q = $conn->query($sql);
    $result = $q->num_rows;
    
    if ($result > 0) {
        while ($row = $q->fetch_assoc()) {
            $harga = number_format($row['harga'], 0, ',', '.');
            $amount = $row['harga'] * $row['qty'];
            $subtotal += $amount;
        }
        $tax = $subtotal * 0.1;
        $total = number_format($subtotal + $tax, 0, ',', '.');
    }
?>
    <tr class="fs-13">
        <td align="center">Item(s)</td>
        <td align="center" class="font-weight-bold"> <?php echo $result; ?></td>
        <td colspan="" align="center" class="">Subtotal</td>
        <td align="right"><?php echo number_format($subtotal, 0, ',', '.'); ?></td>
    </tr>
    <tr class="fs-13">
        <td></td>
        <td></td>
        <td align="center">Tax 10%</td>
        <td align="right">
            <span><?php echo number_format($tax, 0, ',', '.'); ?></span>
        </td>
    </tr>
    <tr class="fs-15">
        <td></td>
        <td></td>
        <td align="center" class="font-weight-bold" style="color:#007552;">Total</td>
        <td align="right" class="font-weight-bold">
            <span style="color:#007552;"><?php echo 'Rp '.$total; ?></span>
        </td>
    </tr>

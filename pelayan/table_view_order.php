<?php  
    require_once "../conn.php";
    $no_trans = $_POST['no_trans'];
    $nama_meja = $_POST['nama_meja'];
    $subtotal = 0;
    $sql = "SELECT * FROM tb_order WHERE order_number = '$no_trans'";  
    $q = $conn->query($sql);
    $data = $q->fetch_assoc();

    $sql = "SELECT * FROM tb_order_detail od
            JOIN tbl_menu M ON od.menu_id = M.id
            WHERE order_number = '$no_trans'";  
    $q = $conn->query($sql);
    $result = $q->num_rows;

    if($result > 0) {

?>
        <table class="table">
            <div class="caption p-3">
                <div class="row">
                    <div class="col-4">
                        <span class="fs-12 d-block">Order Number</span>
                        <?php echo '#'.$no_trans; ?>
                    </div>
                    <div class="col-4 text-center">
                        <span class="fs-12 d-block">Table</span>
                        <?php echo $nama_meja; ?>
                    </div>
                    <div class="col-4 text-right">
                        <span class="fs-12 d-block"><?php echo $data['date']; ?></span>
                        <span class="fs-12"><?php echo $data['time']; ?></span>
                    </div>
                </div>
            <tbody>
    <?php

        while ($row = $q->fetch_assoc()) 
        {
            $harga = number_format($row['harga'], 0, ',', '.');
            $amount = $row['harga'] * $row['qty'];
            $subtotal += $amount;
    ?>
            <tr>
                <td> 
                    <span class="font-weight-bold d-block"><?php echo $row['nama_menu'] ?></span>
                    <span class="text-muted fs-12"><?php echo ucwords($row['description']) ?></span>
                </td>
                <td align="center"> 
                    <?php echo $row['qty'] ?>
                </td>
                <td align="right"> 
                    <span class="font-weight-bold"><?php echo number_format($amount, 0, ',', '.'); ?></span>
                </td>
            </tr>
            
    <?php
        }
        $tax = $subtotal * 0.1;
        $total = number_format($subtotal + $tax, 0, ',', '.');
        ?>
            </tbody>
            <tfoot>
                <tr class="fs-13">
                    <td align="center" class="font-weight-bold">Item(s) <span class="badge badge-success ml-3 p-1"><?php echo $result; ?></span></td>
                    <td align="center" class="">Subtotal</td>
                    <td align="right"><?php echo number_format($subtotal, 0, ',', '.'); ?></td>
                </tr>
                <tr class="fs-13">
                    <td></td>
                    <td align="center">Tax 10%</td>
                    <td align="right">
                        <span><?php echo number_format($tax, 0, ',', '.'); ?></span>
                    </td>
                </tr>
                <tr class="fs-15">
                    <td></td>
                    <td align="center" class="font-weight-bold" style="color:#007552;">Total</td>
                    <td align="right" class="font-weight-bold">
                        <span style="color:#007552;"><?php echo 'Rp '.$total ?></span>
                    </td>
                </tr>
            </tfoot>
        </table> 
    <?php
    }
?>
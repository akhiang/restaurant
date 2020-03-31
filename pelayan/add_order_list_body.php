<?php
    include "../conn.php";
    $total = 0;
    $order_number = $_POST["num"];
    $sql = "SELECT * FROM tb_order_detail od
            JOIN tbl_menu M ON od.menu_id = M.id
            WHERE order_number = '$order_number' ORDER BY od.id ASC";  
    $q = mysqli_query($conn,$sql);
    $result = mysqli_num_rows($q);

    if ($result > 0) {
        while ($row = mysqli_fetch_assoc($q)) {
            $harga = number_format($row['price'], 0, ',', '.');
            $amount = $row['price'] * $row['qty'];
            // $total += $amount;
    ?>
        
        <tr>
            <td align="center"><a class="del-order fa fa-times" data-menu-id="<?php echo $row['menu_id'] ?>" data-order="<?php echo $order_number; ?>" ></a></td>
            <td> 
                <span class="font-weight-bold d-block"><?php echo ucwords($row['menu_name']) ?></span>
                <span class="text-muted fs-12"><?php echo ucwords($row['description']) ?></span>
            </td>
            <td align="center"> 
                <span><?php echo $row['qty'] ?></span>
            </td>
            <td align="right"> 
                <span class="font-weight-bold"><?php echo number_format($amount, 0, ',', '.'); ?></span>
            </td>
        </tr>

    <?php
        }
    }
?>
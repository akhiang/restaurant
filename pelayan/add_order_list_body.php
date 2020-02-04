<?php
    include "../conn.php";
    $total = 0;
    $order_number = $_POST["num"];
    $sql = "SELECT *, nama_menu FROM tb_order_detail_temp O
            JOIN tbl_menu M ON O.kode_menu = M.kode_menu
            WHERE order_number = '$order_number' ORDER BY O.id ASC";  
    $q = mysqli_query($conn,$sql);
    $result = mysqli_num_rows($q);

    if ($result > 0) {
        while ($row = mysqli_fetch_assoc($q)) {
            $harga = number_format($row['harga'], 0, ',', '.');
            $amount = $row['harga'] * $row['qty'];
            // $total += $amount;
    ?>
        
        <tr>
            <td align="center"><a class="del-order fa fa-times" data-menu-id="<?php echo $row['kode_menu'] ?>" data-order="<?php echo $order_number; ?>" ></a></td>
            <td> 
                <span class="font-weight-bold d-block"><?php echo $row['nama_menu'] ?></span>
                <span class="text-muted fs-12"><?php echo 'Rp ' .$harga ?></span>
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
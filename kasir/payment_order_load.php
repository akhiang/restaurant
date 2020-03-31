<?php
    include "../conn.php";

    $no_trans = $_POST['no_trans'];
    $total = 0;
    // $sql = "SELECT * FROM tb_order_detail_temp WHERE order_number = '$no_trans'";
    $sql = "SELECT *, nama_menu FROM tb_order_detail O
        JOIN tbl_menu M ON O.menu_id = M.id
        WHERE order_number = '$no_trans'";  
    $q = mysqli_query($conn,$sql);
    $result = mysqli_num_rows($q);

    if ($result > 0) {
        while ($row = mysqli_fetch_assoc($q)) {
            $harga = number_format($row['price'], 0, ',', '.');
            $amount = $row['price'] * $row['qty'];
            // $total += $amount;
    ?>
        <tr class="w-100">
            <td> 
                <span class="font-weight-bold d-block"><?php echo ucwords($row['nama_menu']) ?></span>
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
    } else {
        ?>
            <div class="w-100 h-100 d-flex flex-column align-items-center justify-content-center">
                <div class="rounded-circle d-flex flex-column align-items-center justify-content-center mb-2" style="background-color: #007c57; width: 120px; height: 120px; opacity: 0.8">
                    <object data="../assets/images/fork.svg" type="image/svg+xml"  style="width: 70px; height: 70px; filter: invert(100%);"></object>
                </div>
                <h5>Belum Ada Order</h5>
            </div>
        <?php
    }
?>
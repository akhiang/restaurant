<?php
    include "../conn.php";
    session_start();
    $total = 0;
    $user_id = $_SESSION["user_id"];
    $sql = "SELECT * FROM tb_cart_detail WHERE user_id = '$user_id'";
    $q = mysqli_query($conn,$sql);
    $result = mysqli_num_rows($q);

    if ($result > 0) {
        while ($row = mysqli_fetch_assoc($q)) {
            $harga = number_format($row['harga'], 0, ',', '.');
            $amount = $row['harga'] * $row['qty'];
            // $total += $amount;
    ?>
        
        <tr>
            <td align="center"><a class="del-cart fa fa-times" data-menu-id="<?php echo $row['kode_menu'] ?>" data-user-id="<?php echo $user_id ?>"></a></td>
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
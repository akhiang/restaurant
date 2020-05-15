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
            $menuId = $row['menu_id'];
            $id = $row['id'];
            $harga = number_format($row['price'], 0, ',', '.');
            $amount = $row['price'] * $row['qty'];
    ?>
        
        <tr>
            <td align="center" width="5%"><a class="del-menu-cart fa fa-times" data-cart-id="<?= $id ?>" data-user-id="<?php echo $user_id ?>"></a></td>
            <td> 
                <span class="font-weight-bold d-block"><?php echo ucwords($row['menu_name']); ?></span>
                <?php
                    $sql2 = "SELECT description FROM tbl_menu WHERE id = '$menuId'";
                    $q2 = $conn->query($sql2);
                    $r = $q2->fetch_assoc();                                          
                ?>
                <span class="text-muted fs-11"><?php echo ucwords($r['description']); ?></span><br>                
            </td>
            <td align="center" width="15%"> 
                <span><?php echo number_format($row['price'], 0, ',', '.'); ?></span>
            </td>
            <td align="center" width="15%">
                <input type="number" class="qty-menu-cart form-control" value="<?= $row['qty'] ?>" min="1" data-menu-id="<?= $id ?>" data-user-id="<?php echo $user_id ?>" />
            </td>
            <td align="right" width="20%"> 
                <span class="font-weight-bold"><?php echo number_format($amount, 0, ',', '.'); ?></span>
            </td>
        </tr>
    <?php
        }
    } else {
?>
    <tr class="text-center">
        <td colspan="5">Your cart is empty</td>
    </tr>
<?php
    
    }
?>
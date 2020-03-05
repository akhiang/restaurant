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
            // $total += $amount;
    ?>
        
        <tr>
            <td align="center"><a class="del-menu-cart fa fa-times" data-menu-id="<?php echo $id ?>" data-user-id="<?php echo $user_id ?>"></a></td>
            <td> 
                <span class="font-weight-bold d-block"><?php echo $row['menu_name'] ?></span>
                <?php
                    $sql2 = "SELECT description FROM tbl_menu WHERE id = '$menuId'";
                    $q2 = $conn->query($sql2);
                    $r = $q2->fetch_assoc();
                    
                    // if($r['jenis'] == 'bakso') {
                    //     $sql3 = "SELECT modifier_id, m.name FROM tb_cart_detail_modifier cm
                    //             LEFT JOIN tb_modifier m ON
                    //                 cm.modifier_id = m.id
                    //             WHERE user_id = '$user_id' AND menu_id = '$kode' AND cart_item_id = '$id'";
                    //     $q3 = $conn->query($sql3);
                    //     while ($mod = $q3->fetch_assoc()) {                        
                ?>
                    <span class="text-muted fs-11"><?php echo ucwords($r['description']); ?></span><br>
                <?php   
                    //     } 
                    // }
                ?>
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
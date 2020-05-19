<?php
    include "../conn.php";
    session_start();

    $subtotal = 0;
    $tax = 0;
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
            $subtotal += $amount;
    ?>
        <tr>            
            <td data-title="Menu">
                <div class="andro_cart-product-wrapper">
                    <div class="andro_cart-product-body">
                        <h6> <?= ucwords($row['menu_name']); ?> </h6>
                        <?php
                            $sql2 = "SELECT description FROM tbl_menu WHERE id = '$menuId'";
                            $q2 = $conn->query($sql2);
                            $r = $q2->fetch_assoc();                                          
                        ?>
                        <span class="text-muted fs-13"><?= ucwords($r['description']); ?></span><br>
                        <a href="#" class="checkout-menu-pen" data-toggle="modal" data-target="#exampleModal" data-cart-id="<?= $row['id'] ?>"><i class="fa fa-pen"></i></a>
                    </div>
                </div>
            </td>
            <td data-title="Quantity" align="center"><?= $row['qty'] ?></td>
            <td data-title="Menu Total" align="right"> <strong><?= number_format($amount, 0, ',', '.'); ?></strong> </td>            
        </tr>
        
    <?php
        }
        $tax = $subtotal * 0.01;
        $total = $subtotal + $tax;
    } else {
        ?>
            <tr class="text-center">
                <td colspan="3">No menu available</td>
            </tr>
        <?php
    }
?>
        
        <tr class="bg-light">
            <td class="space" colspan="3"></td>
        </tr>
        <tr class="total">
            <td colspan="2">
                <h6 class="mb-0">Sub Total</h6>
            </td>
            <td align="right"><?= number_format($subtotal, 0, ',', '.'); ?> </td>
        </tr>
        <tr class="total">
            <td colspan="2">
                <h6 class="mb-0">Tax (10%)</h6>
            </td>
            <td align="right"> <?= number_format($tax, 0, ',', '.'); ?></td>
        </tr>
        <tr class="total">
            <td colspan="2">
                <h6 class="mb-0">Grand Total</h6>
            </td>
            <td align="right"> <strong><?= 'Rp '.number_format($total, 0, ',', '.'); ?></strong> </td>
        </tr>
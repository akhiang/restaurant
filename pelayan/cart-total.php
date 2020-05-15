<?php
    include "../conn.php";
    session_start();

    $subtotal = 0;
    $user_id = $_SESSION["user_id"];
    
    $sql = "SELECT * FROM tb_cart_detail WHERE user_id = '$user_id'";
    $q = mysqli_query($conn,$sql);
    $result = mysqli_num_rows($q);
?>
    <table class="table table-bordered">
        <tbody>
<?php
    if ($result > 0) {
        while ($row = mysqli_fetch_assoc($q)) {
            $menuId = $row['menu_id'];
            $id = $row['id'];
            $amount = $row['price'] * $row['qty'];
            $subtotal += $amount;
        }
        $tax = $subtotal * 0.01;
        $total = $subtotal + $tax;
    ?>
        
            <tr>
                <td>Subtotal</td>
                <td align="right"> 
                    <span class="font-weight-bold"><?= number_format($subtotal, 0, ',', '.'); ?></span>
                </td>
            </tr>
            <tr>
                <td>Tax (10%)</td>
                <td align="right"> 
                    <span class="font-weight-bold"><?= number_format($tax, 0, ',', '.'); ?></span>
                </td>
            </tr>
            <tr>
                <td>Grand Total</td>
                <td align="right"> 
                    <span class="font-weight-bold"><?= 'Rp '.number_format($total, 0, ',', '.'); ?></span>
                </td>
            </tr>
        </tbody>
    </table>
    <button data-toggle="modal" data-target="#checkoutModal" class="btn btn-success btn-block">Checkout</button>
<?php
    } else {
?>
    <h3>Your cart is empty</h3>
<?php
    }
?>
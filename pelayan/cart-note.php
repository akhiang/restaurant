<?php
    include "../conn.php";
    $cartId = $_POST['id'];
    
    $note = $conn->query("SELECT note FROM tb_cart_detail WHERE id = '$cartId'")->fetch_assoc();
?>

<div class="form-group">
    <label for="note">Menu Note</label>
    <textarea class="note form-control" data-cart-id="<?= $cartId; ?>"><?= trim($note['note']); ?></textarea>
</div>
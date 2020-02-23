<?php
    require_once "../conn.php";

    $name = $_POST['name'];
    $unit = $_POST['unit'];
    $qty = $_POST['qty'];
    $sql = "INSERT INTO tb_bahan (id, name, unit, qty) VALUES ('','$name','$unit', $qty)";
    $q = $conn->query($sql);
?>
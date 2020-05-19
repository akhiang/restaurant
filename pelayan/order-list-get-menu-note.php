<?php 
    include "../conn.php";

    $id = $_POST['id'];
    $q = mysqli_query($conn, "SELECT id, note FROM tb_order_detail WHERE id = '$id'");
    $result = mysqli_num_rows($q);

    if($result > 0) {

        $row = mysqli_fetch_assoc($q);
        
        echo json_encode($row);
    }
?>
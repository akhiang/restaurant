<?php
    $conn = mysqli_connect("localhost", "root", "", "restaurant");
    if(!$conn) {
        die("Connecttion failed: ".mysqli_connect_error());
    }

    function updateTable($table_id){
        global $conn;
        if($table_id !== ''){
        // echo 'tidak kosong';
            $q = $conn->query("UPDATE tb_meja set status = 1 WHERE kode_meja = $table_id");
        }  
    }

    function updateOrderTotal(){
        // update total di tb_order
        global $conn;
        $sql = "SELECT * FROM tb_order_detail WHERE order_number = '$order_number'";
        $q = $conn->query($sql);
        while ($row = $q->fetch_assoc()) {
                // $harga = number_format($row['harga'], 0, ',', '.');
                $amount = $row['price'] * $row['qty'];
                $subtotal += $amount;
            }
        $tax = $subtotal * 0.1;
        $total = $subtotal + $tax;
        
        $sql = "UPDATE tb_order SET subtotal = '$subtotal',
                tax = '$tax', total = '$total'
                WHERE order_number = '$order_number'";
        $q = $conn->query($sql);
    }
?>
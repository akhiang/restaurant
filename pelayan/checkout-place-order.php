<?php
    require_once "../conn.php";
    session_start();
    date_default_timezone_set("Asia/Bangkok");

    $status = '';
    $subtotal = 0;
    $user_id =  $_SESSION['user_id'];
    $tgl = date("Y-m-d");
    $waktu = date("h:i:sa");

    if (!empty($_POST)) {
        if (isset($_POST['orderRadio'])) {
            $orderOption = $_POST['orderRadio'];
            if ($orderOption == 'new') {
                if (isset($_POST['orderTableSelect'])) {
                    $orderTable = $_POST['orderTableSelect'];
                } else {
                    $orderTable = '';
                }
                $customer1 = $_POST['customer1'];
                $orderType = $_POST['orderTypeSelect'];

                $q = $conn->query("SELECT MAX(order_number) as nomor from tb_order");
                $data = mysqli_fetch_assoc($q);
                $number = $data['nomor'];
                $number++;
                $kode = sprintf('%06s',$number);

                $sql = "INSERT INTO tb_order_detail (order_number, menu_id, menu_name, qty, price, cancel) 
                        SELECT '$kode', menu_id, menu_name, qty, price, 0 FROM tb_cart_detail WHERE user_id = '$user_id'";
                $q = $conn->query($sql);

                $sql = "SELECT * FROM tb_order_detail WHERE order_number = '$kode'";
                $q = $conn->query($sql);
                foreach ($q as $row) {
                    $amount = $row['price'] * $row['qty'];
                    $subtotal += $amount;
                }
                $tax = $subtotal * 0.1;
                $total = $subtotal + $tax;

                $sql = "INSERT INTO tb_order VALUES ('', '$kode', 'unpaid', '$orderType', '$orderTable',
                            '$user_id', '$customer1', '$tgl','$waktu','$subtotal','$tax','$total')";    
                $q = $conn->query($sql);

                $conn->query("DELETE FROM tb_cart_detail WHERE user_id = '$user_id'");

                if ($orderType == 1) {                    
                    $conn->query("UPDATE tb_meja set status = 0 WHERE kode_meja = $orderTable");
                }

                $status = 'success';
            } else if ($orderOption == 'exist') {
                if (isset($_POST['orderNumber'])) {
                    $orderNumber = $_POST['orderNumber'];
                    $q = $conn->query("SELECT * FROM tb_cart_detail WHERE user_id = '$user_id'");
                    if ($q->num_rows > 0) {
                        foreach ($q as $key => $cart) {
                            $cartMenuId = $cart['menu_id'];
                            $cartMenuQty = $cart['qty'];
                            $cartMenuName = $cart['menu_name'];
                            $cartMenuPrice = $cart['price'];

                            $sameItem = $conn->query("SELECT * FROM tb_order_detail WHERE menu_id = '$cartMenuId' AND cancel = 0");
                            if ($sameItem->num_rows > 0) {       
                                $sql = "UPDATE tb_order_detail SET qty = qty + $cartMenuQty WHERE menu_id = '$cartMenuId'";
                            } else {
                                $sql = "INSERT INTO tb_order_detail (id, order_number, menu_id, menu_name, qty, price, cancel) VALUES
                                    ('', '$orderNumber', '$cartMenuId', '$cartMenuName', $cartMenuQty , '$cartMenuPrice', 0)";
                            }
                            $conn->query($sql);
                        }                        
                        $q = $conn->query("SELECT * FROM tb_order_detail WHERE order_number = '$orderNumber' AND cancel = 0");
                        foreach ($q as $row) {
                            $amount = $row['price'] * $row['qty'];
                            $subtotal += $amount;
                        }
                        $tax = $subtotal * 0.1;
                        $total = $subtotal + $tax;

                        $conn->query("UPDATE tb_order SET subtotal = '$subtotal', tax = '$tax', total = '$total' WHERE order_number = '$orderNumber'");
                        $conn->query("DELETE FROM tb_cart_detail WHERE user_id = '$user_id'");
                        
                        $status = 'success';
                    }         
                } else {
                    
                }
            }
        }
    }
    
    echo $status;
?>
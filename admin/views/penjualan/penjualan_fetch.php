<?php
    require_once "../conn.php";

    $data = array();
    $sql = "SELECT *, m.nama_meja, u.username FROM tb_order o
            LEFT JOIN tb_meja m ON o.table_id = m.kode_meja
            LEFT JOIN tbl_user u ON o.user_id = u.id 
            WHERE order_id IS NOT NULL ";
        
        if ($_POST['is_date'] == 'true') {
            $sql .= "AND date BETWEEN '".$_POST['from']."' AND '".$_POST['to']."' ";
        }
        
        if (isset($_POST['type'])) {
            if ($_POST['type'] != '') {
                $type_id = ($_POST['type'] == 'dine') ? 1 : 2;
                $sql .= "AND order_type_id = '$type_id' ";
            }
        }

        if (isset($_POST['status'])) {
            if ($_POST['status'] != '') {
                $sql .= "AND order_status = '".$_POST['status']."' ";
            }
        }
    
    $sql .= "ORDER BY o.order_number DESC";
    $result = $conn->query($sql);

    foreach ($result as $key => $row) {
        $sub_array = array();
        // $sub_array[] = $key + 1;
        $sub_array[] = $row['order_number'];
        $sub_array[] = $row['order_type_id'] == 1 ? '<span class="badge badge-primary">Dine In</span>' : '<span class="badge badge-info">Take Away</span>';
        $sub_array[] = orderStatus($row['order_status']);
        $sub_array[] = $row['table_id'] == 0 ? '-' : $row['nama_meja'];
        $sub_array[] = $row['customer_name'];
        $sub_array[] = $row['date'];
        $sub_array[] = number_format($row['total'], 0, ',', '.');
        $sub_array[] = '
            <a href="./penjualan_detail.php?no='.$row['order_number'].'" class="trans-detail badge badge-info mr-2"><i class="far fa-eye p-1"></i></a>
            <a href="./penjualan_print.php?o='.$row['order_number'].'" class="trans-detail badge badge-danger mr-2"><i class="fa fa-print p-1"></i></a>
        ';
        $data[] = $sub_array;
    }
    $output = array(
        "data" => $data
    );
    echo json_encode($output);
?>
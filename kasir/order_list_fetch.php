<?php
    require_once "../conn.php";

    $data = array();
    $from = $_POST['from'];
    $to = $_POST['to'];
    if($_POST['is_date'] == 'yes') {
        $sql = "SELECT *, m.nama_meja, u.username FROM tb_order o
                LEFT JOIN tb_meja m ON o.table_id = m.kode_meja
                LEFT JOIN tbl_user u ON o.user_id = u.id
                WHERE date BETWEEN '$from' AND '$to'
                ORDER BY o.order_number DESC";
    } else {
        $sql = "SELECT *, m.nama_meja, u.username FROM tb_order o
                LEFT JOIN tb_meja m ON o.table_id = m.kode_meja
                LEFT JOIN tbl_user u ON o.user_id = u.id
                ORDER BY o.order_number DESC";
    }
    $result = $conn->query($sql);

    foreach ($result as $key => $row) {
        $sub_array = array();
        // $sub_array[] = $key + 1;
        $sub_array[] = $row['order_number'];
        $sub_array[] = $row['order_type_id'] == 1 ? '<span class="badge badge-primary">Dine In</span>' : '<span class="badge badge-info">Take Away</span>';
        $sub_array[] = orderStatus($row['order_status']);
        $sub_array[] = $row['table_id'] == 0 ? '-' : $row['nama_meja'];
        $sub_array[] = $row['date'];
        $sub_array[] = number_format($row['total'], 0, ',', '.');
        $sub_array[] = '
            <a href="#" class="order-detail badge badge-info mr-2" data-order-number="'.$row['order_number'].'" data-toggle="modal" data-target="#order-list-modal"><i class="far fa-eye p-1"></i></a>
            <a href="invoice/invoice.php?o='.$row['order_number'].'" class="trans-detail badge badge-danger mr-2" target="_blank"><i class="fa fa-print p-1"></i></a>
        ';
        $data[] = $sub_array;
    }
    $output = array(
        "data" => $data
    );
    echo json_encode($output);
?>
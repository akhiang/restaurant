<?php
    require_once "../conn.php";

    $data = array();
    // $sql = "SELECT * FROM tb_order";
    $sql = "SELECT tb_order.no_transaksi, tb_meja.nama_meja, tbl_user.username, tb_order.tgl, tb_order.waktu,
            tb_order.subtotal, tb_order.tax, tb_order.total FROM ((tb_order
            INNER JOIN tb_meja ON tb_order.kode_meja = tb_meja.kode_meja)
            INNER JOIN tbl_user ON tb_order.user_id = tbl_user.id) ORDER BY tb_order.no_transaksi DESC";
    $result = $conn->query($sql);

    foreach ($result as $row) {
        $sub_array = array();
        $sub_array[] = $row['no_transaksi'];
        $sub_array[] = $row['nama_meja'];
        $sub_array[] = $row['username'];
        $sub_array[] = $row['tgl'];
        // $sub_array[] = $row['waktu'];
        // $sub_array[] = $row['subtotal'];
        // $sub_array[] = $row['tax'];
        $sub_array[] = number_format($row['total'], 0, ',', '.');
        $sub_array[] = '
            <a href="./penjualan_detail.php?no='.$row['no_transaksi'].'" class="trans-detail badge badge-info mr-2"><i class="far fa-eye p-1"></i></a>
        ';
        $data[] = $sub_array;
    }
    
    $output = array(
        "data" => $data
    );
    echo json_encode($output);
?>
<?php
    include "../conn.php";

    $no_trans = $_POST['no_trans'];
    $sql = "SELECT order_id, order_number, order_status, date, time, order_type_id, table_id, customer_name, name
            FROM tb_order O 
            LEFT JOIN tb_tipe_pesanan T ON O.order_type_id = T.id 
            WHERE order_number = '$no_trans'";
    $q = $conn->query($sql);
    $result = mysqli_num_rows($q);

    if ($result > 0) {
        $row = $q->fetch_assoc();
        $kode_meja = $row['table_id'];
        if($kode_meja == 0){
            $nama_meja = '-';
        } else { 
            $sql2 = "SELECT * FROM tb_meja WHERE kode_meja = '$kode_meja'";
            $q2 = $conn->query($sql2); 
            $row2 = $q2->fetch_assoc();
            $nama_meja =  $row2['nama_meja'];
        }
    ?>
        <div class="row">
            <div class="col-4">
                <span class="fs-12 d-block">Order Number</span>
                <span class="font-weight-bold"><?php echo $row['order_number']; ?></span>
            </div>
            <div class="col-4 text-center">
                <span class="fs-12 d-block">Table</span>
                <span class="font-weight-bold"><?php echo $nama_meja; ?></span>
            </div>
            <div class="col-4 text-right">
                <span class="font-weight-bold fs-12 d-block"><?php echo $row['date']; ?></span>
                <span class="font-weight-bold fs-12"><?php echo $row['time']; ?></span>
            </div>
        </div>
<?php
    } else {
        ?>
            <div class="w-100 h-100 d-flex flex-column align-items-center justify-content-center">
                <span class="fs-12 d-block">No Meja</span>
                <span class="font-weight-bold"><?php ; ?></s>
            </div>
        <?php
    }
?>
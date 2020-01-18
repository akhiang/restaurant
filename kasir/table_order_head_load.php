<?php
    include "../conn.php";

    $no_trans = $_POST['no_trans'];
    $sql = "SELECT order_id, order_number, paid, tgl, waktu, tipe_pesanan_id, kode_meja, name
            FROM tb_order O 
            LEFT JOIN tb_tipe_pesanan T ON O.tipe_pesanan_id = T.id 
            WHERE order_number = '$no_trans'";
    $q = $conn->query($sql);
    $result = mysqli_num_rows($q);

    if ($result > 0) {
        $row = $q->fetch_assoc();
    ?>
        <div class="row">
            <div class="col-4">
                <span class="fs-12 d-block">No Transaksi</span>
                <span class="font-weight-bold"><?php echo $row['order_number']; ?></span>
            </div>
            <div class="col-4 text-center">
                <span class="fs-12 d-block">No Meja</span>
                <span class="font-weight-bold"><?php echo $row['kode_meja']; ?></span>
            </div>
            <div class="col-4 text-right">
                <span class="font-weight-bold fs-12 d-block"><?php echo $row['tgl']; ?></span>
                <span class="font-weight-bold fs-12"><?php echo $row['waktu']; ?></span>
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
<?php
    include "../conn.php";

    $kode_meja = $_POST['kode_meja'];
    $nama_meja = $_POST['nama_meja'];
    $no_trans = $_POST['no_trans'];
    
    $sql = "SELECT tb_order.*, tb_meja.nama_meja FROM tb_order INNER JOIN
            tb_meja ON tb_order.kode_meja = tb_meja.kode_meja
            WHERE no_transaksi = '$no_trans'";  
    // $sql = "SELECT * FROM tb_order WHERE kode_meja = '$kode_meja'";  
    $q = $conn->query($sql);
    $result = mysqli_num_rows($q);

    if ($result > 0) {
        $row = $q->fetch_assoc();
    ?>
        <div class="row">
            <div class="col-4">
                <span class="fs-12 d-block">No Transaksi</span>
                <span class="font-weight-bold"><?php echo $row['no_transaksi']; ?></span>
            </div>
            <div class="col-4 text-center">
                <span class="fs-12 d-block">No Meja</span>
                <span class="font-weight-bold"><?php echo $row['nama_meja']; ?></span>
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
                <span class="font-weight-bold"><?php echo $nama_meja; ?></s>
            </div>
        <?php
    }
?>
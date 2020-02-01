<?php 
    include "../conn.php";

    $sql = "SELECT order_id, order_number, paid, tipe_pesanan_id, kode_meja, name
            FROM tb_order O 
            LEFT JOIN tb_tipe_pesanan T ON O.tipe_pesanan_id = T.id
            WHERE paid = 0 ORDER BY order_number DESC";
    $q = mysqli_query($conn,$sql);
    $result = mysqli_num_rows($q);

    if($result > 0) {

        while ($row = mysqli_fetch_assoc($q)) {
            $kode_meja = $row['kode_meja'];
            if($kode_meja == 0){
                $nama_meja = '-';
            } else { 
                $sql2 = "SELECT * FROM tb_meja WHERE kode_meja = '$kode_meja'";
                $q2 = $conn->query($sql2); 
                $row2 = $q2->fetch_assoc();
                $nama_meja =  $row2['nama_meja'];
            }
    ?>
        <div class="card" data-no-trans="<?php echo $row['order_number'] ?>"> 
            <div class="card-header d-flex align-items-center">
                <div>
                    <span class="text-muted fs-12">Order Number</span>
                    <h6 class="m-0"><?php echo $row['order_number'] ?></h6>                            
                </div>
            </div>
            <div class="card-body row">
                <div class="col-6">
                    <span class="text-muted fs-12">Order Type</span>
                    <h6><?php echo ucwords($row['name']); ?></h6>
                </div>
                <div class="col-6">
                    <span class="text-muted fs-12">Meja</span>
                    <h6><?php echo $nama_meja; ?></h6>
                </div>
            </div>
        </div>
    <?php
        }
    } else {
    ?>
        <div class="no-order d-flex flex-column align-items-center justify-content-center">
            <div class="mb-2">
                <object data="../assets/images/food.svg" type="image/svg+xml"  style="width: 120px; height: 120px;"></object>
            </div>
            <h5>No Order Found</h5>
        </div>
    <?php
}
?>
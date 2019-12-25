<?php 
    include "../conn.php";

    $sql = "SELECT * FROM tb_meja LEFT JOIN tb_order ON tb_meja.kode_meja = tb_order.kode_meja ORDER BY tb_meja.kode_meja ASC";

    $q = mysqli_query($conn,$sql);
    while ($row = mysqli_fetch_assoc($q)) {
?>
    <div class="table-card <?php if($row['status']==0){echo "fill";}else{echo "empty";} ?>" 
        data-table-id="<?php echo $row['kode_meja'];?>" data-table-name="<?php echo $row['nama_meja'] ?>" data-no-trans="<?php echo $row['no_transaksi']; ?>">
        <div class="table-card-container d-flex flex-column h-100 justify-content-center align-items-center">
            <div class="table-card-content">
                <div class="table-card-inf">
                    <h6 class="m-0 p-0"> <?php echo $row['nama_meja'] ?> </h6>
                </div>
            </div>
        </div>
    </div>
<?php
}
?>
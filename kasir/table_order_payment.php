<?php
    include "../conn.php";

    $kode_meja = $_POST['kode_meja'];
    $nama_meja = $_POST['nama_meja'];
    $no_trans = $_POST['no_trans'];
    
    $sql = "SELECT * FROM tb_order WHERE no_transaksi = '$no_trans'";  
    $q = $conn->query($sql);
    $result = mysqli_num_rows($q);

    if ($result > 0) {
        $row = $q->fetch_assoc();
    ?>
        
        <div class="form-group row">
            <label for="no-transaksi" class="col-4 offset-1 col-form-label text-right">No Transaksi</label>
            <div class="col-4"> 
                <input type="text" readonly name="no_trans" class="form-control-plaintext font-weight-bold" id="no-transaksi" value="<?php echo $row['no_transaksi']; ?>">
            </div>
        </div>
            <input type="hidden" name="kode_meja" value="<?php echo $kode_meja ?>">
            <input type="hidden" name="total_hidden" value="<?php echo $row['total'] ?>">
        <div class="form-group row">
            <label for="meja" class="col-4 offset-1 col-form-label text-right">Meja</label>
            <div class="col-4">
                <input type="text" readonly class="form-control-plaintext font-weight-bold" id="meja" value="<?php echo $nama_meja; ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="total" class="col-4 offset-1 col-form-label text-right text-danger">Total</label>
            <div class="col-4">
                <input type="text" readonly name="total" class="form-control text-right currency font-weight-bold" id="total" value="<?php echo number_format($row['total'], 0, ',', '.'); ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="bayar" class="col-4 offset-1 col-form-label text-right">Bayar</label>
            <div class="col-4">
                <input type="text" name="bayar" class="form-control text-right font-weight-bold" id="bayar">
                <!-- <span class="error" style="color: red; display: none">Only Numeric</span> -->
            </div>
        </div>
        <div class="form-group row">
            <label for="kembalian" class="col-4 offset-1 col-form-label text-right">Kembalian</label>
            <div class="col-4">
                <input type="text" readonly name="kembalian" class="form-control text-right font-weight-bold" id="kembalian">
            </div>
        </div>
<?php
    }
?>
<?php
    include "../conn.php";
    require_once "../header.php";
    date_default_timezone_set("Asia/Bangkok");

    $user_id = $_SESSION["user_id"];

    if (isset($_POST["submit"])) {
        // var_dump($_POST);
        $tipe = $_POST['tipe_id'];
        $sql = "SELECT * FROM tb_tipe_pesanan WHERE id = '$tipe'";  
        $q = $conn->query($sql);
        $data = $q->fetch_assoc();

        if($tipe == 2){
            $kode_meja = '';
            $nama_meja = '-';
        } else {
            $kode_meja = $_POST['id_meja'];
            $sql = "SELECT * FROM tb_meja WHERE kode_meja = '$kode_meja'";  
            $q = $conn->query($sql);
            $meja = $q->fetch_assoc();
            $nama_meja = $meja['nama_meja'];
        }
    }
?>

    <main class="wrapper-all">
        <div class="container-fluid" onload="clock()">
            <div class="row">
                <div class="col-lg-5 bg-light py-4">
                    <div class="order-list-container bg-white rounded p-3">
                        <div class="order-list-head pb-2">
                            <div class="row">
                                <div class="col-4">
                                    <span class="text-muted fs-13 d-block">Tipe pesanan</span>
                                    <span class="font-weight-bold"><?php echo ucwords($data['name']); ?></span>
                                </div>
                                <div class="col-3 text-center">
                                    <span class="text-muted fs-13 d-block">Meja</span>
                                    <span class="font-weight-bold"><?php echo $nama_meja; ?></span>
                                </div>
                                <div class="col-5 d-flex flex-column">
                                    <span class="text-muted fs-13 ml-auto"><?php echo date("l, d-m-Y"); ?></span>
                                    <span class="text-muted fs-13 ml-auto" id="clock"></span>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-sm table-fixed" id="table-order-list">         
                                <tbody class="order-list-body mb-3" id="order-list-body"></tbody>
                                <tfoot class="order-list-foot" id="order-list-foot">
                                </tfoot> 
                            </table>
                            <div class="order-list-option d-flex p-2">
                                <button class="btn btn-danger ml-auto" data-toggle="modal" data-target="#cancelOrder">Cancel</button>
                                <button class="make-order btn btn-success ml-3" data-user-id="<?php echo $user_id ?>"
                                    data-tipe="<?php echo $tipe; ?>" data-meja-id="<?php echo $kode_meja; ?>">Place Order</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 bg-light py-4">
                    <div class="menu-container text-center rounded bg-white py-4 px-2"  style="height: calc(100vh - 7.5rem); overflow: auto;">
                        <ul class="menu-filter">
                            <li><span data-filter="*" class="current">All</span></li>
                            <li><span data-filter=".Makanan">Foods</span></li>
                            <li><span data-filter=".Minuman">Drinks</span></li>
                        </ul>
                        <div class="menu-item d-flex flex-wrap justify-content-center col-12">
                            <?php 
                                $sql = "SELECT * FROM tbl_menu";
                                $q = mysqli_query($conn,$sql);

                                while ($row = mysqli_fetch_assoc($q)) {
                            ?>
                                
                                <div class="card m-2 <?php echo $row['jenis']; ?>" style="width: 13.3rem;">
                                    <img src=" <?php echo '../assets/images/menu/'.$row['gambar']; ?>" class="card-img-top img-responsive">
                                    <div class="card-body">
                                        <h6> <?php echo $row['nama_menu']; ?> </h6>
                                        <h6 class="text-danger"> <?php echo $row['harga']; ?> </h6>
                                        <form class="menu-card<?php echo $row['id'] ?>">
                                            <input type="hidden" name="hidden_user_id" value="<?php echo $user_id; ?>" />
                                            <input class="form-control form-control-sm spinner" type="number" name="qty_menu" id="qty<?php echo $row['id'] ?>" min="1" value="1"/>
                                            <input type="hidden" name="hidden_kode_menu" id="kode<?php echo $row['id'] ?>" value="<?php echo $row["kode_menu"]; ?>" />
                                            <input type="hidden" name="hidden_nama_menu" id="nama<?php echo $row['id'] ?>" value="<?php echo $row["nama_menu"]; ?>" />
                                            <input type="hidden" name="hidden_harga" id="harga<?php echo $row['id'] ?>" value="<?php echo $row["harga"]; ?>" />
                                            <button type="button" onclick="addToCart(<?php echo $row['id'] ?>)"
                                            class="add-cart btn btn-success btn-sm btn-block mt-2" data-menu-id="<?php echo $row['id'] ?>">Add<i class="fas fa-shopping-cart ml-2"></i></button>
                                        </form>
                                    </div>
                                </div> 

                            <?php
                                }
                            ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Modal -->
    <div class="modal fade" id="cancelOrder" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Batalkan pemesanan?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="cancel-order btn btn-danger" data-meja-id="<?php echo $kode_meja ?>" data-user-id="<?php echo $user_id; ?>" data-dismiss="modal">Ya</button>
                    <button type="button" class="btn btn-success" data-dismiss="modal">Tidak</button>
                </div>
            </div>
        </div>
    </div>

<?php
    require_once "../footer.php"
?>
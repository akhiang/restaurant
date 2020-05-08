<?php
    include "../conn.php";
    require_once "../header-order.php";
    date_default_timezone_set("Asia/Bangkok");

    $user_id = $_SESSION["user_id"];

    if (isset($_POST["_token"])) {
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
                <div class="col-lg-5 bg-light py-4 d-none d-lg-block">
                    <div class="order-list-container bg-white rounded p-3">
                        <div class="order-list-head pb-2">
                            <div class="row">
                                <div class="col-4">
                                    <span class="text-muted fs-13 d-block">Order Type</span>
                                    <span class="font-weight-bold"><?php echo ucwords($data['name']); ?></span>
                                </div>
                                <div class="col-3 text-center">
                                    <span class="text-muted fs-13 d-block">Table</span>
                                    <span class="font-weight-bold"><?php echo $nama_meja; ?></span>
                                    <input type="hidden" class="input_table" value="<?= $kode_meja; ?>">
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
                                <button class="btn btn-success ml-3" data-toggle="modal" data-target="#placeOrder">Place Order</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 bg-light py-4">
                    <div class="menu-container text-center rounded bg-white py-4 px-2"  style="height: calc(100vh - 7.5rem); overflow: auto;">
                        <ul class="menu-filter">
                            <li><span data-filter="*" class="current">All</span></li>
                            <li><span data-filter=".bakso">Bakso</span></li>
                            <li><span data-filter=".mie">Noodle</span></li>
                            <li><span data-filter=".snack">Snack</span></li>
                            <li><span data-filter=".Minuman">Drink</span></li>
                        </ul>
                        <div class="menu-item d-flex flex-wrap justify-content-center col-12">
                            <?php 
                                $sql = "SELECT * FROM tbl_menu WHERE ready = 1 AND deleted = 0 ORDER BY sequence ASC";
                                $q = mysqli_query($conn,$sql);
                                while ($row = mysqli_fetch_assoc($q)) {
                            ?>
                                
                                <div class="card m-2 <?php echo $row['jenis']; ?>" style="width: 13.3rem;">
                                    <img src=" <?php echo '../assets/images/menu/'.$row['gambar']; ?>" class="card-img-top img-responsive">
                                    <div class="card-body">
                                        <h6 class="p-0 mb-2"> <?php echo ucwords($row['nama_menu']); ?> </h6>
                                        <h6 class="fs-12 text-muted">
                                            <?php
                                                if($row['description'] == ''){
                                                    echo "<div class='invisible'>.</div>";
                                                } else 
                                                echo ucwords($row['description']);
                                            ?> 
                                        </h6>
                                        <h6 class="text-danger my-3"> <?php echo number_format($row['harga'], 0, ',', '.'); ?> </h6>
                                        <form class="menu-card<?php echo $row['id'] ?>">
                                            <input type="hidden" name="hidden_user_id" class="input_user" value="<?php echo $user_id; ?>" />
                                            <input type="hidden" name="hidden_id_menu" id="id<?php echo $row['id'] ?>" value="<?php echo $row["id"]; ?>" />
                                            <input type="hidden" name="hidden_nama_menu" id="nama<?php echo $row['id'] ?>" value="<?php echo $row["nama_menu"]; ?>" />
                                            <input type="hidden" name="hidden_harga" id="harga<?php echo $row['id'] ?>" value="<?php echo $row["harga"]; ?>" />
                                            <input type="hidden" name="hidden_jenis" value="<?php echo $row["jenis"]; ?>" />
                                            <button type="button" onclick="addToCart(<?php echo $row['id'] ?>)" class="add-cart btn btn-success btn-sm btn-block mt-2" 
                                            data-menu-id="<?php echo $row['id'] ?>">Add<i class="fas fa-shopping-cart ml-2"></i></button>
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
                    <h5 class="modal-title" id="exampleModalCenterTitle">Cancel Order</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to cancel this order?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" id="cancel-order" onclick="cancelListOrder()">Yes, cancel order</button>
                    <button type="button" class="btn btn-success" data-dismiss="modal">No, keep the order</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="placeOrder" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Place Order</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to place this order?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-success" id="place-order" data-user-id="<?php echo $user_id ?>"
                        data-tipe="<?php echo $tipe; ?>" data-meja-id="<?php echo $kode_meja; ?>" data-dismiss="modal">Place order</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="baksoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Mie</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="modifier-form">
                <div class="modal-body">
                    <input type="hidden" name="hidden_user_id" value="<?php echo $user_id; ?>" />
                    <input type="hidden" name="hidden_menu_id" id="menu_id">
                    <input type="hidden" name="hidden_menu_kode" id="menu_kode">
                    <input type="hidden" name="hidden_menu_nama" id="menu_nama">
                    <input type="hidden" name="hidden_menu_qty" id="menu_qty">
                    <input type="hidden" name="hidden_menu_harga" id="menu_harga">
                    <div class="form-check mb-3">
                        <input class="form-check-input" name="mie[]" type="checkbox" value="1" id="mie_kuning">
                        <label class="form-check-label" for="mie_kuning">
                            Mie Kuning
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" name="mie[]" type="checkbox" value="2" id="mie_putih">
                        <label class="form-check-label" for="mie_putih">
                            Mie Putih
                        </label>
                    </div>
                    <label for="mie[]" class="error mt-2" style="display: none">Your error message will be display here.</label>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Confirm</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    <script>
        window.onbeforeunload = confirmExit;
        function confirmExit() {
            return "You have attempted to leave this page. Are you sure?";
        }
    </script>
<?php
    require_once "../footer.php"
?>
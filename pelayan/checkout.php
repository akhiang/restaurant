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
        <div class="container-fluid">
            <form action="" id="checkout-form">
                <div class="row">
                    <div class="col-xl-7 p-4">
                        <h3>Checkout</h3>
                        <div class="order-list-container p-3">
                            <div class="row">
                                <div class="col-xl-12">
                                    <label for="">Order Option <span class="text-danger">*</span></label>
                                </div>
                                <div class="form-group col-xl-12 radio-group">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="radioNewOrder" name="orderRadio" class="order-radio custom-control-input" value="new" required>
                                        <label class="custom-control-label" for="radioNewOrder">New Order</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="radioExistOrder" name="orderRadio" class="order-radio custom-control-input" value="exist" required>
                                        <label class="custom-control-label" for="radioExistOrder">Existing Order</label>
                                    </div>                                
                                </div>                                
                                <div class="col-12 d-none" id="new-order-form">
                                    <div class="form-group col-xl-12 px-0">
                                        <label>Customer <span class="text-danger">*</span></label>
                                        <input type="text" placeholder="Name" name="customer1" class="form-control" required>
                                    </div>        
                                    <div class="form-group col-xl-12 px-0">
                                        <label>Order Type <span class="text-danger">*</span></label>
                                        <select class="form-control" name="orderTypeSelect" id="order-type-select" required>                                
                                            <option value="" disabled>Select Order Type</option>
                                            <?php 
                                                $sql = "SELECT * FROM tb_tipe_pesanan";  
                                                $q = $conn->query($sql);
                                                while ($row = $q->fetch_assoc()) { ?>
                                                    <option value="<?= $row['id'] ?>"><?php echo ucwords($row['name']) ?></option>
                                            <?php
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-xl-12 px-0">
                                        <label>Table <span class="text-danger">*</span></label>
                                        <select class="form-control" name="orderTableSelect" id="order-table-select" disabled="true">                                
                                            <option value="" disabled>Select a Table</option>
                                            <?php 
                                                $sql = "SELECT * FROM tb_meja WHERE status = 1";  
                                                $q = $conn->query($sql);
                                                while ($row = $q->fetch_assoc()) { ?>
                                                    <option value="<?= $row['kode_meja'] ?>"><?= $row['nama_meja'] ?></option>
                                            <?php
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 d-none" id="exist-order-form">
                                    <div class="form-group col-xl-12 px-0">
                                        <label>Select Existing Order <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Order Number" name="orderNumber" aria-label="Order Number" readonly>
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-success" type="button" id="button-addon" data-toggle="modal" data-target="#existOrderModal">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>                                    
                                    </div>
                                    <div class="form-group col-xl-12 px-0">
                                        <label>Customer <span class="text-danger">*</span></label>
                                        <input type="text" placeholder="Name" name="customer2" class="form-control" readonly required>
                                    </div>                                           
                                </div>
                            </div>                        
                        </div>
                    </div>
                    <div class="col-xl-5 checkout-billing p-4">
                        <h3>Order Details</h3>
                        <div class="order-list-container p-3">
                            <table class="table table-bordered andro_responsive-table" id="checkout-order-table" style="width: 100%">
                                <thead class="text-center">
                                    <tr>
                                        <th>Menu</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody id="checkout-order-table-body"></tbody>
                            </table>                            
                            <button type="submit" class="btn btn-success btn-block">Place Order</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Menu Note</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
            <label for="note">Menu Note</label>
                <textarea class="note form-control" id="checkout-menu-note"></textarea>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="existOrderModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Existing Order</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body cards"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>                
            </div>
            </div>
        </div>
    </div>

<?php
    require_once "../footer.php"
?>
<?php
    include "../conn.php";
    require_once "../header.php";
    date_default_timezone_set("Asia/Bangkok");

    $user_id = $_SESSION["user_id"];
?>

    <main class="wrapper-all">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8 p-4">
                    <h3>Cart</h3>
                    <div class="order-list-container p-3">                        
                        <div class="table-responsive">
                            <table class="table table-bordered" id="cart-table">         
                                <thead class="text-center">
                                    <tr>
                                        <th class="remove"></th>
                                        <th>Menu</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody id="cart-body"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 p-4">
                    <h3>Cart Total</h3>
                    <div class="order-list-container p-3">
                        <table class="table table-bordered">
                            <tbody id="cart-total"></tbody>
                        </table>
                        <button data-toggle="modal" data-target="#checkoutModal" class="btn btn-success btn-block">Checkout</button>
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
    <div class="modal fade" id="checkoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Checkout</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to proceed to checkout ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <a href="./checkout.php" class="btn btn-success">Proceed to checkout</a>
                    <!-- <button type="button" class="btn btn-success" id="place-order" data-user-id="<?php echo $user_id ?>"
                        data-tipe="<?php echo $tipe; ?>" data-meja-id="<?php echo $kode_meja; ?>" data-dismiss="modal">Place order</button> -->
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
        // window.onbeforeunload = confirmExit;
        // function confirmExit() {
        //     return "You have attempted to leave this page. Are you sure?";
        // }
    </script>
<?php
    require_once "../footer.php"
?>
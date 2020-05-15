<?php
    include "../conn.php";
    require_once "../header-order.php";

    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
		if ($_SESSION['role'] == "kasir") {
			header("location: ../kasir/index.php");
		}
		else if ($_SESSION['role'] == "admin") {
			header("location: ../admin/index.php");
		}
	}
	else {
		header('location: ../index.php');
	}
?>

    <main class="wrapper-all">
        <div class="container-fluid">
            
                <div class="col-lg-12 bg-light p-5">
                    <ul class="menu-filter">
                        <li><span data-filter="*" class="current active">All</span></li>
                        <li><span data-filter=".bakso">Bakso</span></li>
                        <li><span data-filter=".mie">Noodle</span></li>
                        <li><span data-filter=".snack">Snack</span></li>
                        <li><span data-filter=".Minuman">Drink</span></li>
                    </ul>
                    <div class="menu-container px-4" style="height: calc(100vh - 7.5rem); overflow: auto;">                        
                        <div class="row menu-item">                            
                                <?php 
                                    $sql = "SELECT * FROM tbl_menu WHERE ready = 1 AND deleted = 0 ORDER BY sequence ASC";
                                    $q = mysqli_query($conn,$sql);
                                    while ($row = mysqli_fetch_assoc($q)) {
                                ?>                                    
                                <div class="col-lg-6 <?php echo $row['jenis'] ?>">
                                    <div class="andro_product andro_product-list">                            
                                        <div class="andro_product-thumb">
                                            <img src="<?php echo '../assets/images/menu/'.$row['gambar']; ?>" class="rounded">
                                        </div>
                                        <div class="andro_product-body px-3">                                        
                                            <h5 class="andro_product-title"><?php echo ucwords($row['nama_menu']); ?></h5>
                                            <p class="m-0">
                                                <?php
                                                    if($row['description'] == ''){
                                                        echo "<div class='invisible'>.</div>";
                                                    } else 
                                                    echo "<span class='text-muted fs-15'>".ucwords($row['description'])."</span>";
                                                ?> 
                                            </p>
                                            <div class="andro_product-price mb-3">
                                                <span><?php echo 'Rp '.number_format($row['harga'], 0, ',', '.'); ?></span>                                
                                            </div>                                            
                                            <div class="andro_product-footer">
                                                <div class="spinner-wrap">                                                    
                                                    <input type="number" class="spinner<?=$row['id'] ?> spin form-control-sm" min="1" value="1" oninput="setQty(<?=$row['id'] ?>)">                                                    
                                                </div>
                                                <div class="btn-group">
                                                    <form class="menu-form<?php echo $row['id'] ?>">                                                                                                  
                                                        <input type="hidden" name="hidden_user_id" value="<?php echo $user_id ?>" />
                                                        <input type="hidden" name="hidden_id" id="id<?php echo $row['id'] ?>" value="<?php echo $row["id"]; ?>" />
                                                        <input type="hidden" name="hidden_name" id="name<?php echo $row['id'] ?>" value="<?php echo $row["nama_menu"]; ?>" />
                                                        <input type="hidden" name="hidden_price" id="harga<?php echo $row['id'] ?>" value="<?php echo $row["harga"]; ?>" />
                                                        <input type="hidden" name="hidden_qty" id="qty<?=$row['id'] ?>" value="1" />                                                        
                                                        <button type="button" onclick="addCart(<?php echo $row['id'] ?>)" class="add-cart btn btn-success btn-sm" 
                                                            data-menu-id="<?php echo $row['id'] ?>">Add<i class="fas fa-shopping-cart ml-2"></i></button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>                                                    
                                </div>
                            <?php
                                }
                            ?>                             
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
        
    </script>
<?php
    require_once "../footer.php"
?>
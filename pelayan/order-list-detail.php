<?php
    include "../conn.php";
	include "../header.php";
	
	// session_start();
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
		<div class="container-fluid p-5">
			<div class="order-list-container p-3">
                <div id="clock" class="d-none"></div>
                
                <?php
                    if (isset($_GET['o'])) {
                        $orderNumber = $_GET['o'];
                        $subtotal = 0;
                        $sql = "SELECT *, T.name, M.nama_meja FROM tb_order O 
                            LEFT JOIN tb_tipe_pesanan T ON O.order_type_id = T.id
                            LEFT JOIN tb_meja M ON O.table_id = M.kode_meja
                            WHERE order_status = 'unpaid' AND order_number = '$orderNumber'";
                        $q = mysqli_query($conn, $sql);
                        $result = mysqli_num_rows($q);
                        if($result > 0) {
                            $row = $q->fetch_assoc();
                ?>
                            <table class="table table-bordered">
                                <div class="caption p-3">
                                    <div class="row">
                                        <div class="col-4">
                                            <span class="fs-14 d-block">Order Number</span>
                                            <span class="font-weight-bold"><?php echo '#'.$row['order_number']; ?></span>
                                        </div>
                                        <div class="col-4 text-center">
                                            <span class="fs-14 d-block">Table</span>
                                            <?php echo $row['nama_meja']; ?>
                                        </div>
                                        <div class="col-4 text-right">
                                            <span class="fs-14 d-block">Customer</span>
                                            <span class="font-weight-bold"><?= $row['customer_name']; ?></span>
                                        </div>
                                    </div>
                                </div>
                                <thead class="text-center">
                                    <tr>
                                        <th></th>
                                        <th>Menu</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                <?php
                                $sql = "SELECT *, od.id FROM tb_order_detail od
                                        JOIN tbl_menu M ON od.menu_id = M.id
                                        WHERE order_number = '$orderNumber' AND cancel = 0";  
                                $q = $conn->query($sql);
                                if ($q->num_rows > 0) {
                                    foreach ($q as $key => $row2) {
                                        $harga = number_format($row2['harga'], 0, ',', '.');
                                        $amount = $row2['harga'] * $row2['qty'];
                                        $subtotal += $amount;
                ?>
                                    <tr>
                                        <td align="center" width="5%" class="dropright">
                                            <a href="#" class="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">                                                
                                                <i class="fa fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu text-left" aria-labelledby="dropdownMenuLink">
                                                <a class="option-order-item dropdown-item" href="#" data-id="<?= $row2['id'] ?>" data-order-num="<?= $orderNumber ?>">Cancel menu</a>                                                
                                            </div>                        
                                        </td>
                                        <td> 
                                            <span class="font-weight-bold d-block"><?php echo $row2['nama_menu'] ?></span>
                                            <span class="text-muted fs-12"><?php echo ucwords($row2['description']) ?></span>
                                        </td>
                                        <td align="center"> 
                                            <?php echo $row2['qty'] ?>
                                        </td>
                                        <td align="right"> 
                                            <span class="font-weight-bold"><?php echo number_format($amount, 0, ',', '.'); ?></span>
                                        </td>
                                    </tr>
                <?php
                                    }
                                    $tax = $subtotal * 0.1;
                                    $total = number_format($subtotal + $tax, 0, ',', '.');
                ?>
                                    </tbody>
                                    <tfoot>
                                        <tr class="fs-13">
                                            <td></td>                                            
                                            <td></td>                                            
                                            <td align="center" class="font-weight-bold">Subtotal</td>
                                            <td align="right"><?php echo number_format($subtotal, 0, ',', '.'); ?></td>
                                        </tr>
                                        <tr class="fs-13">
                                            <td></td>
                                            <td></td>
                                            <td align="center" class="font-weight-bold">Tax 10%</td>
                                            <td align="right">
                                                <span><?php echo number_format($tax, 0, ',', '.'); ?></span>
                                            </td>
                                        </tr>
                                        <tr class="fs-15">
                                            <td></td>
                                            <td></td>
                                            <td align="center" class="font-weight-bold" style="color:#007552;">
                                                <h5>Grand Total</h5>
                                            </td>
                                            <td align="right" class="font-weight-bold">
                                                <h5 style="color:#007552;"><?php echo 'Rp '.$total ?></h5>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            <button type="button" class="btn btn-danger btn-sm" id="cancel-order-btn" data-order-num="<?= $orderNumber ?>">Cancel Order</button>
                            <a href="./order-list.php" class="btn btn-success btn-sm">Back</a>
                <?php
                                }
                        } else {
                            // if no order found
                        }                                            
                ?>
                        
                <?php
                        
                    } else {
                        //if wrong order number
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
                </div>		
			</div>
		</div>
	</main>

    <!-- Modal -->
    <div class="modal fade" id="pesananList" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Order List</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="table-view-order"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<?php
    require_once "../footer.php"
?>
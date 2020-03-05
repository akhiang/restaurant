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
		<div class="container-fluid px-5">
			<div class="action-card-container py-5">
                <div id="clock" class="d-none"></div>
                <div class="cards pesanan">
                <?php 
                    $sql = "SELECT order_id, order_number, paid, order_type_id, table_id, name
                            FROM tb_order O 
                            LEFT JOIN tb_tipe_pesanan T ON O.order_type_id = T.id 
                            WHERE paid = 0 ORDER BY order_number DESC";
                    $q = mysqli_query($conn,$sql);
                    while ($row = mysqli_fetch_assoc($q)) {
                        $kode_meja = $row['table_id'];
                        if($kode_meja == 0){
                            $nama_meja = '-';
                        } else { 
                            $sql2 = "SELECT * FROM tb_meja WHERE kode_meja = '$kode_meja'";
                            $q2 = $conn->query($sql2); 
                            $row2 = $q2->fetch_assoc();
                            $nama_meja =  $row2['nama_meja'];
                        }
                ?>
                    <div class="card">
                        <div class="card-header d-flex align-items-center">
                            <div>
                                <span class="text-muted fs-12">Order Number</span>
                                <h6 class="m-0"><?php echo $row['order_number'] ?></h6>                            
                            </div>
                            <div class="ml-auto">
                                <a href="#" class="view-order btn btn-success btn-sm" data-meja-name="<?php echo $nama_meja; ?>" data-no-trans="<?php echo $row['order_number'] ?>" data-toggle="modal" data-target="#pesananList"><i class="fa fa-eye"></i></a>
                                <a href="#" class="add-order btn btn-success btn-sm mx-1" data-no-trans="<?php echo $row['order_number'] ?>" data-toggle="modal" data-target="#addOrderModal"><i class="fa fa-cart-plus"></i></a>
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

    <!-- Modal -->
    <div class="modal fade" id="addOrderModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Order</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="add-order-form" method="POST" action="add_order.php">
                    <div class="modal-body">
                        Add more order to this placed order ?
                        <div id="add-order-conf"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" name="submit" class="btn btn-success" id="btn-submit-add">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php
    require_once "../footer.php"
?>
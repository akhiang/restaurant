<?php
    include "../conn.php";
    require_once "../header.php";
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
            <div class="row">
                <div class="col-md-12 py-4">
                    <div class="table-container rounded px-5 py-1">
                        <h5 class="mb-2">Meja</h5>
                        <div id="clock" class="d-none"></div>
                        <div class="list-table bg-white">
                            <?php 
                                $sql = "SELECT * FROM tb_meja ORDER BY kode_meja ASC";
                                $q = mysqli_query($conn,$sql);
                                while ($row = mysqli_fetch_assoc($q)) {
                                    $status = $row['status']; 
                                    $kode_meja = $row['kode_meja'];
                                    $sql2 = "SELECT * FROM tb_order WHERE kode_meja = '$kode_meja' AND paid = '0'";
                                    $q2 = $conn->query($sql2); 
                                    $row2 = $q2->fetch_assoc(); 
                            ?>
                                <div class="table-card">
                                    <div class="table-card-container">
                                        <div class="number-table-card <?php if($status==0){echo "fill";}else{echo "empty";} ?>">
                                            <h6 class="m-0 p-0"> <?php echo $row['nama_meja'] ?> </h6>
                                        </div>
                                        <div class="table-card-content">
                                            <div class="table-card-head d-flex py-1">
                                                <?php if($status==0){
                                                        echo "<h5 class='text-danger'>Terisi</h5>";
                                                    }else {
                                                        echo "<h5>Tersedia</h5>";} ?>
                                                <span class="ml-3 ml-auto">
                                                    <?php if($row['status'] == 0) { ?>  
                                                        <a href="#" class="view-order btn btn-sm" data-meja-name="<?php echo $row['nama_meja'] ?>" data-no-trans="<?php echo $row2['order_number']; ?>" data-toggle="modal" data-target="#orderListModal"><i class="fa fa-eye"></i></a>
                                                    <?php } ?>
                                                </span>
                                            </div>
                                            <hr class="mt-0 mb-2">
                                            <div class="table-card-inf">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="order-number">
                                                            <span class="text-muted d-block title">Order Number</span>
                                                            <span class="font-weight-bold">
                                                                <?php echo '#'.$row2['order_number'];?>
                                                            </span>
                                                        </div>
                                                    </div>                          
                                                    <div class="col-6">
                                                        <div class="order-action">
                                                            <?php 
                                                                if ($status == 0) {
                                                            ?>
                                                                <form action="add_order.php" method="post" class="d-flex" id="table-add-form">
                                                                    <input type="hidden" name="meja_id" value="<?php echo $row['kode_meja'] ?>">
                                                                    <input type="hidden" name="tipe_id" value="<?php echo $row2['tipe_pesanan_id'] ?>">
                                                                    <input type="hidden" name="number" value="<?php echo $row2['order_number'] ?>">
                                                                    <button type="submit" name="submit" class="btn btn-add-order btn-sm ml-auto">Add Order</button>
                                                                </form>
                                                            <?php
                                                                } else {
                                                            ?>
                                                                <form action="pemesanan.php" method="post" class="d-flex" id="table-new-form-<?= $row['kode_meja'] ?>">
                                                                    <button type="button" class="btn btn-new-order btn-sm ml-auto" data-table="<?= $row['kode_meja'] ?>" data-toggle="modal" data-target="#newOrderModal">New Order</button>   
                                                                </form>
                                                            <?php
                                                                }
                                                            ?> 
                                                        </div>
                                                    </div>                          
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
            </div>
        </div>
    </main>

    <!-- Modal -->
    <div class="modal fade" id="orderListModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Order List</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <?php echo $row['nama_meja'] ?>
                <div id="table-view-order"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="newOrderModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Order</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="pemesanan.php" id="table-new-order-form">
                    <div class="modal-body">
                        Add new order ?
                        <div id="table-new-order-conf"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-success" id="btn-new-order-modal">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
<?php
    require_once "../footer.php";
?>



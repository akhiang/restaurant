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
                        <h5 class="mb-2">Table</h5>
                        <div id="clock" class="d-none"></div>
                        <div class="list-table bg-white">
                            <?php 
                                $sql = "SELECT * FROM tb_meja ORDER BY kode_meja ASC";
                                $q = mysqli_query($conn,$sql);
                                while ($row = mysqli_fetch_assoc($q)) {
                                    $status = $row['status']; 
                                    $kode_meja = $row['kode_meja'];
                                    $sql2 = "SELECT * FROM tb_order WHERE table_id = '$kode_meja' AND order_status = 'unpaid'";
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
                                                        echo "<h5 class='text-danger'>Filled</h5>";
                                                    }else {
                                                        echo "<h5>Available</h5>";} ?>
                                                <span class="ml-3 ml-auto">
                                                    <?php if($row['status'] == 0) { ?>  
                                                        <a href="#" class="view-order btn btn-sm" data-meja-name="<?php echo $row['nama_meja'] ?>" data-no-trans="<?php echo $row2['order_number']; ?>"><i class="fa fa-eye"></i></a>
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
                                                        <div class="order-number">
                                                            <span class="text-muted d-block title">Customer</span>
                                                            <span class="font-weight-bold">
                                                                <?= $row2['customer_name'];?>
                                                            </span>
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

<?php
    require_once "../footer.php";
?>



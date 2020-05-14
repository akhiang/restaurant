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
                    $sql = "SELECT order_id, order_number, order_status, order_type_id, table_id, customer_name, name
                            FROM tb_order O 
                            LEFT JOIN tb_tipe_pesanan T ON O.order_type_id = T.id 
                            WHERE order_status = 'unpaid' ORDER BY order_number DESC";
                    $q = mysqli_query($conn,$sql);
                    $result = mysqli_num_rows($q);

                    if($result > 0) {
                        while ($row = mysqli_fetch_assoc($q)) {
                            $kode_meja = $row['table_id'];
                            if($kode_meja == 0){
                                $nama_meja = '-';
                            } else { 
                                $sql2 = "SELECT * FROM tb_meja WHERE kode_meja = '$kode_meja'";
                                $q2 = $conn->query($sql2); 
                                $row2 = $q2->fetch_assoc();
                                $nama_meja = $row2['nama_meja'];
                            }
                ?>
                        <div class="card">
                            <div class="card-header d-flex align-items-center">
                                <div>
                                    <span class="text-muted fs-12">Order Number</span>
                                    <h6 class="m-0"><?php echo $row['order_number'] ?></h6>                            
                                </div>
                                <div class="ml-auto">
                                    <a href="#" class="view-order btn btn-success btn-sm" data-meja-name="<?php echo $nama_meja; ?>" data-no-trans="<?php echo $row['order_number'] ?>"><i class="fa fa-eye"></i></a>                                    
                                </div>
                            </div>
                            <div class="card-body row">
                                <div class="col-6">
                                    <span class="text-muted fs-12">Customer</span>
                                    <h6><?php echo ucwords($row['customer_name']); ?></h6>
                                </div>
                                <div class="col-6">
                                    <span class="text-muted fs-12">Meja</span>
                                    <h6><?php echo $nama_meja; ?></h6>
                                </div>
                            </div>
                        </div>
                <?php
                        }
                    } else {
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
<?php
    require_once "../footer.php"
?>
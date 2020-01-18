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
                    $sql = "SELECT order_id, order_number, paid, tipe_pesanan_id, kode_meja, name
                            FROM tb_order O 
                            LEFT JOIN tb_tipe_pesanan T ON O.tipe_pesanan_id = T.id 
                            WHERE paid = 0 ORDER BY order_number DESC";
                    $q = mysqli_query($conn,$sql);
                    while ($row = mysqli_fetch_assoc($q)) {
                        $kode_meja = $row['kode_meja'];
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
                            <a href="#" class="view-order btn btn-success btn-sm ml-auto" data-meja-name="<?php echo $nama_meja; ?>" data-no-trans="<?php echo $row['order_number'] ?>" data-toggle="modal" data-target="#pesananList"><i class="fa fa-eye"></i></a>
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
                <?php echo $row['nama_meja'] ?>
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
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
				<div class="cards">
					<div class="card text-center">
						<div class="card-img">
							<object data="../assets/images/order.svg" type="image/svg+xml"  style="width: 70px; height: 90px;"></object>
						</div>
						<div class="card-body">
							<a href="#" class="btn btn-success btn-sm" data-toggle="modal" data-target="#pemesanan-modal">New Order</a>
						</div>
					</div>
					<div class="card text-center">
						<div class="card-img">
							<object data="../assets/images/chair.svg" type="image/svg+xml"  style="width: 100px; height: 90px;"></object>
						</div>
						<div class="card-body">
							<a href="table.php" class="btn btn-success btn-sm">Table</a>
						</div>
					</div>
					<div class="card text-center">
						<div class="card-img">
							<object data="../assets/images/food.svg" type="image/svg+xml"  style="width: 100px; height: 90px;"></object>
						</div>
						<div class="card-body">
							<a href="pesanan.php" class="btn btn-success btn-sm">Order List</a>
						</div>
					</div>
					<div class="card text-center">
						<div class="card-img">
							<object data="../assets/images/menu.svg" type="image/svg+xml"  style="width: 100px; height: 90px;"></object>
						</div>
						<div class="card-body">
							<a href="#" class="btn btn-success btn-sm">Menu List</a>
						</div>
					</div>
					<div class="card text-center">
						<div class="card-img">
							<object data="../assets/images/menu.svg" type="image/svg+xml"  style="width: 100px; height: 90px;"></object>
						</div>
						<div class="card-body">
							<a href="#" class="btn btn-success btn-sm">Transaction</a>
						</div>
					</div>
				</div>		
			</div>
		</div>
	</main>

	<!-- Modal -->
	<div class="modal fade" id="pemesanan-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Pemesanan</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="form-pesanan" method="POST" action="pemesanan.php">
					<div class="form-group">
						<label for="tipepesanan">Tipe pesanan</label>
						<select class="form-control" id="tipepesanan" name="tipepesanan">
							<option value="" selected>Pilih tipe pesanan</option>
							<?php 
								$sql = "SELECT * FROM tb_tipe_pesanan";  
								$q = $conn->query($sql);
								while ($row = $q->fetch_assoc()) { ?>
								<option value="<?php echo $row['id'] ?>"><?php echo ucwords($row['name']) ?></option>
							<?php
								}
							?>
						</select>
					</div>
					<div class="form-group" id="meja-div">
						<label for="meja" class="col-form-label">Meja</label>
						<select disabled="true" name="id_meja" class="form-control" id="meja">
							<option value="" selected>Pilih meja</option>
							<?php 
								$sql = "SELECT * FROM tb_meja WHERE status = 1";  
								$q = $conn->query($sql);
								while ($row = $q->fetch_assoc()) { ?>
									<option value="<?php echo $row['kode_meja'] ?>"><?php echo $row['nama_meja'] ?></option>
							<?php
								}
							?>
						</select>
					</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="submit" name="submit" id="submit-pesanan" class="btn btn-success">Submit</button>
				</form>
			</div>
			</div>
		</div>
	</div>

<?php
    require_once "../footer.php"
?>
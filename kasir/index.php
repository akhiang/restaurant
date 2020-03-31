<?php
    include "../conn.php";
	require_once "../header_kasir.php";

	if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
		if ($_SESSION['role'] == "pelayan") {
			header("location: ../pelayan/index.php");
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
					<div class="card">
						<div class="card-body">
							<?php
								date_default_timezone_set("Asia/Bangkok");
								$tgl = date("Y-m-d");
								$q = $conn->query("SELECT * FROM tb_order WHERE date = '$tgl'");
								$a = $q->num_rows;
								echo '<h3>'.$a.'</h3>';
							?>
							<p>Today's Orders</p>
						</div>
						<div class="card-bottom w-100">
							<a href="./payment.php" class="d-flex justify-content-center align-items-center">More info <i class="fas fa-arrow-circle-right ml-2"></i></a>
						</div>
						<div class="card-img">
							<object data="../assets/images/order.svg" type="image/svg+xml"  style="width: 70px; height: 90px;"></object>
						</div>
					</div>
					<div class="card">
						<div class="card-body">
							<?php
								$q = $conn->query("SELECT * FROM tb_order WHERE date = '$tgl' AND order_status = 'paid'");
								$a = $q->num_rows;
								echo '<h3>'.$a.'</h3>';
							?>
							<p>Finished Orders</p>
						</div>
						<div class="card-bottom w-100">
							<a href="./payment.php" class="d-flex justify-content-center align-items-center">More info <i class="fas fa-arrow-circle-right ml-2"></i></a>
						</div>
						<div class="card-img">
							<object data="../assets/images/checklist.svg" type="image/svg+xml"  style="width: 100px; height: 90px;"></object>
						</div>
					</div>
					<div class="card">
						<div class="card-body">
							<?php
								$tgl = date("Y-m-d");
								$q = $conn->query("SELECT * FROM tb_meja WHERE status = 1");
								$a = $q->num_rows;
								echo '<h3>'.$a.'</h3>';
							?>
							<p>Available Table</p>
						</div>
						<!-- <div class="card-bottom w-100">
							<a href="./table.php" class="d-flex justify-content-center align-items-center">More info <i class="fas fa-arrow-circle-right ml-2"></i></a>
						</div> -->
						<div class="card-img">
							<object data="../assets/images/chair.svg" type="image/svg+xml"  style="width: 100px; height: 90px;"></object>
						</div>
					</div>
				</div>		
			</div>
		</div>
	</main>

<?php
    require_once "../footer_kasir.php"
?>
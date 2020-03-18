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
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg py-4">
					
				</div>
			</div>
		</div>
	</main>

<?php
    require_once "../footer_kasir.php"
?>
<?php
    include "../conn.php";
	require_once "../header_kasir.php";
	
	session_start();
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
					<h1>Kasir</h1>
					<?php echo $_SESSION['user_id']; ?>
					<?php echo $_SESSION['username']; ?>
					<form action="../logout.php" method="post">
						<button type="submit" href="#" class="dropdown-item dropdown-footer">Logout</button>
					</form>
				</div>
			</div>
		</div>
	</main>

<?php
    require_once "../footer_kasir.php"
?>
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
		<div class="container-fluid" onload="clock()">
            <span class="text-muted fs-13 ml-auto d-none" id="clock"></span>
            <div class="text-center rounded bg-white py-4 px-2">
                <ul class="menu-filter">
                    <li><span data-filter="*" class="current">All</span></li>
                    <li><span data-filter=".Makanan">Bakso</span></li>
                    <li><span data-filter=".mie">Noodle</span></li>
                    <li><span data-filter=".snack">Snack</span></li>
                    <li><span data-filter=".Minuman">Drink</span></li>
                </ul>
                <div class="menu-item justify-content-center">
                <!-- <div class="menu-item row row-cols-1 row-cols-md-2"> -->
                    <?php 
                        $sql = "SELECT * FROM tbl_menu";
                        $q = mysqli_query($conn,$sql);
                        while ($row = mysqli_fetch_assoc($q)) {
                    ?>
                        <div class="col-lg-3 col-md-4 col-sm-6 mb-4 <?php echo $row['jenis']; ?>">
                            <div class="card">
                                <img src=" <?php echo '../assets/images/menu/'.$row['gambar']; ?>" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $row['nama_menu']; ?></h5>
                                    <h6 class="card-text text-danger"><?php echo number_format($row['harga'], 0, ',', '.'); ?></h6>
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

<?php
    require_once "../footer.php"
?>
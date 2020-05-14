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
            <div class="text-center rounded bg-white py-5 px-2">
                <ul class="menu-filter">
                    <li><span data-filter="*" class="current">All</span></li>
                    <li><span data-filter=".bakso">Bakso</span></li>
                    <li><span data-filter=".mie">Noodle</span></li>
                    <li><span data-filter=".snack">Snack</span></li>
                    <li><span data-filter=".Minuman">Drink</span></li>
                </ul>
                <div class="menu-item justify-content-center">
                <!-- <div class="menu-item row row-cols-1 row-cols-md-2"> -->
                    <?php 
                        $sql = "SELECT * FROM tbl_menu WHERE deleted = 0 ORDER BY sequence ASC";
                        $q = mysqli_query($conn,$sql);
                        while ($row = mysqli_fetch_assoc($q)) {
                    ?>
                        <div class="col-lg-2 col-md-3 col-sm-4 mb-4 <?php echo $row['jenis']; ?>">
                            <div class="card">
                                <img src=" <?php echo '../assets/images/menu/'.$row['gambar']; ?>" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h6 class="card-title m-0"><?php echo ucwords($row['nama_menu']); ?></h6>
                                    <span class="fs-12 text-muted mb-1">
                                        <?php
                                            if($row['description'] == ''){
                                                echo "<div class='invisible mb-1'>.</div>";
                                            } else 
                                            echo ucwords($row['description']);
                                        ?> 
                                    </span>
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
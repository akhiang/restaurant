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
	<main class="wrapper-all bg-light">
		<div class="container-fluid p-5">
            <div class="card p-3">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="form-check mb-3">
                            <div class="pretty p-svg p-curve">
                            <input type="checkbox" id="date-check">
                            <div class="state p-primary">
                                <!-- svg path -->
                                <svg class="svg svg-icon" viewBox="0 0 20 20">
                                    <path d="M7.629,14.566c0.125,0.125,0.291,0.188,0.456,0.188c0.164,0,0.329-0.062,0.456-0.188l8.219-8.221c0.252-0.252,0.252-0.659,0-0.911c-0.252-0.252-0.659-0.252-0.911,0l-7.764,7.763L4.152,9.267c-0.252-0.251-0.66-0.251-0.911,0c-0.252,0.252-0.252,0.66,0,0.911L7.629,14.566z" style="stroke: white;fill:white;"></path>
                                </svg>
                                <label></label>
                            </div>
                            </div>
                        </div>              
                        <div class="col-md-3 mb-3">
                            <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text">From</span>
                            </div>
                            <input type="text" class="date form-control" id="from-date" disabled>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text">To</span>
                            </div>
                            <input type="text" class="date form-control" id="to-date" value="" disabled>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <button type="button" id="filter" class="btn btn-outline-primary btn-sm">Filter</button>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="order-table" class="table table-sm table-hover text-center w-100">
                        <thead>
                            <tr>
                            <!-- <th scope="col">#</th> -->
                            <th scope="col">Order Number</th>
                            <th scope="col">Order Type</th>
                            <th scope="col">Order Status</th>
                            <th scope="col">Table</th>
                            <th scope="col">Date</th>
                            <th scope="col">Total</th>
                            <th scope="col">Action</th>
                            </tr>
                        </thead>
                        </table>
                    </div>
                </div>
            </div>
		</div>
    </main>
    
    <!-- Modal -->
    <div class="modal fade" id="order-list-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Order List</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="order-list-view"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

<?php
    require_once "../footer_kasir.php"
?>
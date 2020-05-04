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
                <div class="col-md-12 col-lg-6 py-4 px-3 bg-light border d-none d-lg-block">
                    <div class="table-container rounded py-3 px-4 bg-white">
                        <h5 class="mb-2">Order List</h5>
                        <div id="clock" class="d-none"></div>
                        <div class="list-table">
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-6 py-4 px-3 bg-light border">
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-success mb-3 d-lg-none d-xl-none" data-toggle="modal" data-target="#orderListModalScrollable">
                            <i class="fa fa-clipboard-list"></i>
                        </button>
                    </div>
                    <div class="order-list-container rounded py-3 px-5 bg-white">
                        <div class="order-list-content">
                            <table class="table table-sm table-fix" id="table-order-list"> 
                                <thead class="order-list-head"></thead>        
                                <tbody class="order-list-body mb-3"></tbody>
                                <tfoot class="order-list-foot"></tfoot> 
                            </table>
                            <div class="order-list-action p-2">
                                <div class="row">
                                    <div class="col-12">
                                        <button id="btn-payment" class="btn btn-success btn-block ml-3" style="visibility:hidden"
                                            data-toggle="modal" data-target="#payment-modal">Payment</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Modal -->
    <div class="modal fade" id="payment-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Payment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="payment-modal-body">
                <form method="POST" id="payment-form">
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Submit</button>
                </form>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <a onclick="pdf()" target="_blank" data-order-number="" id="btn-print" class="btn btn-warning d-none">Print</a>
            </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="orderListModalScrollable" tabindex="-1" role="dialog" aria-labelledby="orderListModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="orderListModalScrollableTitle">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="list-table">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    
<?php
    require_once "../footer_kasir.php";
?>



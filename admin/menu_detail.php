<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Menu Detail</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <link rel="stylesheet" href="dist/css/style.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
  <?php
    session_start();
  ?>

<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fa fa-user-circle"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">User Info</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-user mr-3"></i><?php echo $_SESSION['username']; ?>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-user-cog mr-3"></i><?php echo $_SESSION['role']; ?>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">Profile</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Restaurant</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <!-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div> -->

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
              with font-awesome or any other icon font library -->
          <li class="nav-item mt-3">
            <a href="index.php" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-utensils"></i>
              <p>
                Menu
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="meja.php" class="nav-link">
              <i class="nav-icon fas fa-chair"></i>
              <p>
                Table
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="./penjualan.php" class="nav-link">
              <i class="nav-icon fas fa-money-bill-wave"></i>
              <p>
                Penjualan
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="./user.php" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                User
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="./supplier.html" class="nav-link">
              <i class="nav-icon fas fa-truck-loading"></i>
              <p>
                Supplier
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="./report.html" class="nav-link">
              <i class="nav-icon far fa-file-alt"></i>
              <p>
                Report
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Menu Detail</h1>
            <?php 
              if(isset($_GET["no"])) {
                  $data = $_GET["no"];
              }
            ?>
						<input type="hidden" value="<?php echo $data ?>" id="menu_id">
          </div><!-- /.col -->
          <!-- <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div> -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">

          <div class="col-5">
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-12">
                    <a href="./menu.php" class="btn btn-primary btn-sm mb-3">Back</a><h4>Menu</h4>
                    <table id="table-menu-detail" class="table table-hover table-sm w-100">
                      <tbody>
												<?php
													require_once "../conn.php";
													$sql = "SELECT * FROM tbl_menu WHERE id = '$data'";
													$q = $conn->query($sql);
													$result = $q->num_rows;
													if($result > 0) {
														$row = $q->fetch_assoc();
												?>
                        <tr>
                          <td>Number</td>
                          <td class="font-weight-bold"><?php echo $row['kode_menu']; ?></td>
                        </tr>
                        <tr>
                          <td>Name</td>
                          <td class="font-weight-bold"><?php echo ucwords($row['nama_menu']); ?></td>
                        </tr>
                        <tr>
                          <td>Description</td>
                          <td class="font-weight-bold"><?php echo ucwords($row['description']); ?></td>
                        </tr>
                        <tr>
                          <td>Category</td>
                          <td class="font-weight-bold"><?php echo ucwords($row['jenis']); ?></td>
                        </tr>
                        <tr>
                          <td>Price</td>
                          <td class="font-weight-bold"><?php echo 'Rp '. number_format($row['harga'], 0, ',', '.');; ?></td>
                        </tr>
                        <tr>
                          <td>Image</td>
                          <td class="font-weight-bold"><img src="../assets/images/menu/<?php echo $row['gambar'] ?>" class="img-fluid img-thumbnail"></td>
                        </tr>
                        <?php 
                          } 
                        ?>
                      </tbody>
                    </table>
                  </div>
                </div>         
              </div>
            </div>
          </div>
					<div class="col-7">
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-12">
                    <h4>Ingredients</h4>
                    <button class="btn btn-info btn-sm mb-3" data-toggle="modal" data-target="#add-menu-detail-modal"><i class="fa fa-plus mr-2"></i>Create</button>
                    <table id="table-ing-detail" class="table table-hover table-sm w-100 text-center">
                      <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Unit</th>
                            <th scope="col">Qty</th>
                            <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <!-- <footer class="main-footer">
    <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.0.0
    </div>
  </footer> -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<div class="modal fade" id="add-menu-detail-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Create</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="add-menu-detail-form" id="add-menu-detail-form">
        <div class="modal-body">
          <input type="hidden" value="<?php echo $data ?>" name="menu_id">
          <div class="form-group">
            <label for=nama_menu" class="col-form-label">Name</label>
            <select class="form-control" name="ingredient_id">
							<option value="" selected>Select Name</option>
							<?php 
								$sql = "SELECT * FROM tb_bahan";  
								$q = $conn->query($sql);
								while ($row = $q->fetch_assoc()) { ?>
								<option value="<?php echo $row['id'] ?>"><?php echo ucwords($row['name']) ?></option>
							<?php
								}
							?>
						</select>
          </div>
          <div class="form-group">
            <label for="" class="col-form-label">Qty</label>
            <input type="text" class="form-control form-control-sm" name="use_qty" autocomplete="off">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn-add-menu-detail btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="edit-menu-detail-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="edit-menu-detail-form" id="edit-menu-detail-form">
        <div class="modal-body">
          <input type="hidden" name="id">
          <input type="hidden" value="<?php echo $data ?>" name="menu_id">
          <div class="form-group">
            <label for=nama_menu" class="col-form-label">Name</label>
            <select class="form-control" name="ingredient_id">
							<option value="" selected>Select Name</option>
							<?php 
								$sql = "SELECT * FROM tb_bahan";  
								$q = $conn->query($sql);
								while ($row = $q->fetch_assoc()) { ?>
								<option value="<?php echo $row['id'] ?>"><?php echo ucwords($row['name']) ?></option>
							<?php
								}
							?>
						</select>
          </div>
          <div class="form-group">
            <label for="" class="col-form-label">Qty</label>
            <input type="text" class="form-control form-control-sm" name="use_qty" autocomplete="off">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn-edit-menu-detail btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>



<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<!-- <script src="plugins/sparklines/sparkline.js"></script> -->
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="dist/js/app.js"></script>
<script>

</script>
</body>
</html>

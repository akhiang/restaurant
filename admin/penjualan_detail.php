<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | Dashboard</title>
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
</head>
<body class="hold-transition sidebar-mini layout-fixed">
  <?php session_start(); ?>
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
            <i class="fas fa-user-cog mr-3"></i><?php echo $_SESSION['username']; ?>
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
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
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
            <a href="./index.php" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href=" menu.php" class="nav-link">
              <i class="nav-icon fas fa-utensils"></i>
              <p>
                Menu
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="./meja.php" class="nav-link">
              <i class="nav-icon fas fa-chair"></i>
              <p>
                Table
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="./penjualan.php" class="nav-link active">
              <i class="nav-icon fa fa-money-bill-wave"></i>
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
            <h1 class="m-0 text-dark">Transaction Detail</h1>
            <?php 
                if(isset($_GET["no"])) {
                    $data = $_GET["no"];
                }
            ?>
          </div><!-- /.col -->
          <div class="col-sm-6">
          
            <!-- <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol> -->
          </div>
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
                    <a href="penjualan.php" class="btn btn-primary btn-sm mb-3">Back</a>
                    <h4>Transaction</h4>
                    <table id="table-trans-detail" class="table table-hover table-sm w-100">
                      <tbody>
                      <?php
                        require_once "../conn.php";
                        $sql = "SELECT *, m.nama_meja, u.username, t.name FROM tb_order o
                                LEFT JOIN tb_meja m ON o.kode_meja = m.kode_meja
                                LEFT JOIN tbl_user u ON o.user_id = u.id
                                LEFT JOIN tb_tipe_pesanan t ON o.tipe_pesanan_id = t.id
                                WHERE o.order_number = '$data'";
                        $q = $conn->query($sql);
                        $result = $q->num_rows;
                        if($result > 0) {
                          $row = $q->fetch_assoc();
                          $date = date('j F Y', strtotime($row['tgl']));
                      ?>
                        <tr>
                          <td>Order Number</td>
                          <td class="font-weight-bold"><?php echo $row['order_number']; ?></td>
                        </tr>
                        <tr>
                          <td>Order Type</td>
                          <td class="font-weight-bold"><?php echo ucwords($row['name']); ?></td>
                        </tr>
                        <tr>
                          <td>Table</td>
                          <td class="font-weight-bold"><?php echo $row['nama_meja'] == '' ? '-' : $row['nama_meja']; ?></td>
                        </tr>
                        <tr>
                          <td>Waiter</td>
                          <td class="font-weight-bold"><?php echo ucwords($row['username']); ?></td>
                        </tr>
                        <tr>
                          <td>Date</td>
                          <td class="font-weight-bold"><?php echo $date; ?></td>
                        </tr>
                        <tr>
                          <td>Time</td>
                          <td class="font-weight-bold"><?php echo $row['waktu']; ?></td>
                        </tr>
                        <tr>
                          <td>Total</td>
                          <td class="font-weight-bold"><?php echo 'Rp '. number_format($row['total'], 0, ',', '.');; ?></td>
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
                    <h4>Menu</h4>
                    <table id="table-menu-detail" class="table table-hover table-sm w-100">
                      <thead class="text-center">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Menu</th>
                            <th scope="col">Qty</th>
                            <th scope="col">Price</th>
                            <th scope="col">Total</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                            $numb = 1;
                            $subtotal = 0;
                            $total = 0;
                            $sql = "SELECT *, nama_menu FROM tb_order_detail_temp od
                                    LEFT JOIN tbl_menu m on od.kode_menu = m.kode_menu
                                    WHERE order_number = $data";  
                            $q = $conn->query($sql);
                            $result = $q->num_rows;
                            if($result > 0){
                                while ($row = mysqli_fetch_assoc($q)) {
                                    $amount = $row['harga'] * $row['qty'];
                                    $subtotal += $amount;
                            ?>
                                <tr>
                                    <td align="center" width="10%"><?php echo $numb; ?></td>
                                    <td><span><?php echo $row['nama_menu'] ?></span></td>
                                    <td align="center"><span><?php echo $row['qty'] ?></span></td>
                                    <td align="right"><?php echo number_format($row['harga'], 0, ',', '.'); ?>
                                    <td align="right"><span class="font-weight-bold"><?php echo number_format($amount, 0, ',', '.'); ?></span>
                                    </td>
                                </tr>
                                
                            <?php  
                                $numb++;
                                }
                                $tax = $subtotal * 0.1;
                                $total = $subtotal + $tax;
                            ?>
                                <tr>
                                    <td colspan="4"  align="center">Subtotal</td>
                                    <td align="right"><span class="font-weight-bold"><?php echo 'Rp ' .number_format($subtotal, 0, ',', '.'); ?></span>
                                </tr>
                                <tr>
                                    <td colspan="4"  align="center">Tax</td>
                                    <td align="right"><span class="font-weight-bold"><?php echo 'Rp ' .number_format($tax, 0, ',', '.'); ?></span>
                                </tr>
                                <tr>
                                    <td colspan="4"  align="center">Total</td>
                                    <td align="right"><span class="font-weight-bold"><?php echo 'Rp ' .number_format($total, 0, ',', '.'); ?></span>
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
<script src="plugins/sparklines/sparkline.js"></script>
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
<script src="dist/js/app.js" type="text/javascript"></script>
</body>
</html>

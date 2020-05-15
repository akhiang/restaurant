<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Transaction</title>
  <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.css">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href="../../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <!-- <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css"> -->
    <!-- Theme style -->
    <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="../../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="../../plugins/daterangepicker/daterangepicker.css">
    <!-- Checkbox -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pretty-checkbox@3.0/dist/pretty-checkbox.min.css">
    <!-- summernote -->
    <link rel="stylesheet" href="../../plugins/summernote/summernote-bs4.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <link rel="stylesheet" href="../../dist/css/style.css">
    <style>
      .limit {
        width: 0 !important;
      }
    </style>
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
          <button type="button" class="dropdown-item dropdown-footer" data-toggle="modal" data-target="#logoutModal">Logout</button>
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
    <a href="../../index.php" class="brand-link">
      <img src="../../dist/img/bakso-logo.png" class="brand-image img-circle elevation-3">
      <span class="brand-text font-weight-light">Bakso Mas Ari</span>
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
            <a href="../../index.php" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../menu/menu.php" class="nav-link">
              <i class="nav-icon fas fa-utensils"></i>
              <p>
                Menu
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../bahan/bahan.php" class="nav-link">
              <i class="nav-icon fas fa-egg"></i>
              <p>
                  Ingredient
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../meja/meja.php" class="nav-link">
              <i class="nav-icon fas fa-chair"></i>
              <p>
                Table
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link active">
              <i class="nav-icon fa fa-money-bill-wave"></i>
              <p>
                Transaction
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../user/user.php" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                User
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
            <h1 class="m-0 text-dark">Transaction</h1>
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
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                
                <div class="row">
                  <div class="my-2">
                    <div class="form-check">
                      <div class="pretty p-svg p-curve">
                        <input type="checkbox" class="form-check-input" id="date-check" name="date-check">
                        <div class="state p-primary">
                            <!-- svg path -->
                            <svg class="svg svg-icon" viewBox="0 0 20 20">
                                <path d="M7.629,14.566c0.125,0.125,0.291,0.188,0.456,0.188c0.164,0,0.329-0.062,0.456-0.188l8.219-8.221c0.252-0.252,0.252-0.659,0-0.911c-0.252-0.252-0.659-0.252-0.911,0l-7.764,7.763L4.152,9.267c-0.252-0.251-0.66-0.251-0.911,0c-0.252,0.252-0.252,0.66,0,0.911L7.629,14.566z" style="stroke: white;fill:white;"></path>
                            </svg>
                            <label></label>
                        </div>
                      </div>
                    </div> 
                  </div>                               
                  <div class="col-md-4 mb-3">
                    <div class="input-group input-group-sm">
                      <div class="input-group-prepend">
                        <span class="input-group-text">From</span>
                      </div>
                      <input type="text" class="date form-control" id="from-date" disabled>
                    </div>
                  </div>
                  <div class="col-md-4 mb-3">
                    <div class="input-group input-group-sm">
                      <div class="input-group-prepend">
                        <span class="input-group-text">To</span>
                      </div>
                      <input type="text" class="date form-control" id="to-date" value="" disabled>
                    </div>
                  </div>
                  
                </div>

                <form class="form-row">
                  <div class="col-md-6 mb-3">
                    <label class="" for="order-type">Order Type</label>
                    <select class="form-control form-control-sm" id="order-type">
                      <option value="" selected>Choose...</option>
                      <option value="dine">Dine In</option>
                      <option value="take">Take Away</option>
                    </select>
                  </div>
                  
                  <div class="col-md-6 mb-3">
                    <label class="" for="order-status">Order Status</label>
                    <select class="form-control form-control-sm" id="order-status">
                      <option value="" selected>Choose...</option>
                      <option value="paid">Paid</option>
                      <option value="unpaid">Unpaid</option>
                      <option value="cancelled">Cancelled</option>
                    </select>
                  </div>
                </form>

                <div class="mb-4">
                    <button type="button" id="filter" class="btn btn-outline-primary btn-sm">Filter</button>
                    <button type="button" id="report" class="btn btn-outline-info btn-sm mx-1">Report</button>
                  </div>

                <div class="table-responsive">
                  <table id="table-penjualan" class="table table-hover text-center table-sm w-100">
                    <thead>
                      <tr>
                        <!-- <th scope="col">#</th> -->
                        <th scope="col">Order Number</th>
                        <th scope="col">Order Type</th>
                        <th scope="col">Order Status</th>
                        <th scope="col">Table</th>
                        <th scope="col">Customer</th>
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

<!-- Modal -->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Confirm Logout</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="../../../logout.php" method="post">
        <div class="modal-body">
          Are you sure you want to Logout?
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-danger">Logout</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../../plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables -->
<script src="../../plugins/datatables/jquery.dataTables.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<!-- DatePicker -->
<script src="../../plugins/daterangepicker/moment.min.js"></script>
<script src="../../plugins/daterangepicker/daterangepicker.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.js"></script>

<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="../../dist/js/app.js"></script>
<script>
  $(function() {
    var e = document.getElementById("order-type");
    var element = document.getElementById("order-status");

    $('#date-check').click(function() {
      if ($(this).is(':checked')) {
        $('.date').prop('disabled', false);
      } else {
        $('.date').prop('disabled', true);
      }
    });

    $('.date').daterangepicker({
      singleDatePicker: true,
      // showDropdowns: true,
      minYear: 2000,
      clearBtn: true,
      maxYear: parseInt(moment().format('YYYY'),10,),
      locale: {
        format: 'YYYY-MM-D'
      }
    });

    $('#filter').on('click', function() {
      if ($('#date-check').is(':checked')) {
        var is_date = true;
      } else {
        is_date = false;
      }

      var type = (e.options[e.selectedIndex].value);
      var status = (element.options[element.selectedIndex].value);
      
      $('#table-penjualan').DataTable({
        "destroy": true,
        "ajax": {
          type: "POST",
          url: 'penjualan_fetch.php',
          data: {
            is_date: is_date,
            from: $('#from-date').val(),
            to: $('#to-date').val(),
            type: type,
            status: status,
          }
        },
        "order": [[0, "desc"]]
      });
    });

    $('#report').on('click', function() {
      let url = `penjualan_report.php?`;
      var type = (e.options[e.selectedIndex].value);
      var status = (element.options[element.selectedIndex].value);

      if ($('#date-check').is(':checked')) {
        var from = $('#from-date').val(), to = $('#to-date').val();
        url += `from=${from}&to=${to}`;
      } 

      url += type != '' ? `&type=${type}` : '';
      url += status != '' ? `&status=${status}` : '';
  
      window.open(url, `_blank`);
    });
  });
</script>
</body>
</html>

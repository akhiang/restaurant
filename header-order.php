<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" type="text/css" href="../assets/fontawesome/css/all.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">

    <link rel="stylesheet" href="../assets/css/simplebar.css">
    <link href="../assets/css/jquery.nice-number.css" rel="stylesheet">

    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/meja.css">

    <style>
        .error {
            color: red;
        }
    </style>

    <title>Restaurant</title>
</head>
<body>
    <?php session_start(); ?>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container px-3">
                <a class="navbar-brand p-0">
                    <object class="d-inline-block align-top" data="../assets/images/background/bakso.svg" type="image/svg+xml"  style="width: 50px; height: 50px;"></object>
                </a>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a href="./cart.php" class="nav-link">
                            <i class="fa fa-shopping-cart fa-1x"></i>
                            <!-- <span class="badge badge-light">9</span> -->
                        </a>
                    </li>  
                </ul>

                <!-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button> -->

                <!-- <div class="collapse navbar-collapse" id="navbarSupportedContent">       
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link">
                                <i class="fa fa-shopping-cart fa-1x"></i>
                            </a>
                        </li>  
                        <li class="nav-item dropdown">
                            <a class="nav-link" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-user-circle fa-1x"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user mr-3"></i><?php echo $_SESSION['username']; ?>
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user-cog mr-3"></i><?php echo $_SESSION['role']; ?>
                                </a>
                                <div class="dropdown-divider"></div>
                                <button class="dropdown-item" data-toggle="modal" data-target="#logoutModal"><i class="fas fa-sign-out-alt mr-3"></i>Logout</button>
                            </div>
                        </li>
                    </ul>
                </div> -->
            </div>
        </nav>
    </header>



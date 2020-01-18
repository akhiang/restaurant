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
            <div class="container">
                <a class="navbar-brand" href="#">Restaurant</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link active" href="./index.php">Beranda<span class="sr-only"></span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./table.php">Meja<span class="sr-only">(current)</span></a>
                        </li> 
                        <!-- <li class="nav-item">
                            <a class="nav-link" href="pemesanan.php">Pemesanan<span class="sr-only">(current)</span></a>
                        </li>           -->
                    </ul>

                    <ul class="navbar-nav ml-auto">
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
                                <a href="#" class="dropdown-item">
                                    <form action="../logout.php" method="post">
                                        <!-- <i type="submit" class="fas fa-sign-out-alt"></i> -->
                                        <button type="submit" href="#" class="dropdown-item dropdown-footer">Logout</button>
                                    </form>
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>



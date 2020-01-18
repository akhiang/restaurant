<?php
	session_start();
	if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    	if ($_SESSION['role'] == "admin") {
			header("location:admin/index.php");
		}
		else if ($_SESSION['role'] == "kasir") {
			header("location:kasir/index.php");
		}
		else if ($_SESSION['role'] == "pelayan") {
			header("location:pelayan/index.php");
		}
    	exit;
	}
	require_once "conn.php";
	$username = $password = "";
	$username_err = $password_err = "";

	if($_SERVER["REQUEST_METHOD"] == "POST"){
		if(empty(trim($_POST["username"]))){
			$username_err = "Please enter username.";
		} 
		else{
			$username = trim($_POST["username"]);
		}

		if(empty(trim($_POST["password"]))){
			$password_err = "Please enter your password.";
		} 
		else {
			$password = trim($_POST["password"]);
		}
			
		if(empty($username_err) && empty($password_err)){
			$sql = "SELECT * FROM tbl_user WHERE username = '$username'";
			$q = mysqli_query($conn, $sql);

			if (mysqli_num_rows($q) == 1) {
				$data = mysqli_fetch_assoc($q);
					
				if($data['password'] == $password) {
					session_start();
					$_SESSION["loggedin"] = true;
					$_SESSION["user_id"] = $data['id'];
					$_SESSION["username"] = $username;
					$_SESSION["role"] = $data['role'];

					if ($_SESSION['role'] == "admin") {
						header("location:admin/index.php");
					}
					else if ($_SESSION['role'] == "kasir") {
						header("location:kasir/index.php");
					}
					else if ($_SESSION['role'] == "pelayan") {
						header("location:pelayan/index.php");
					}
				}
				else{
					$password_err = "The password you entered was not valid.";
				}
			}
			else{
				$username_err = "No account found with that username.";
			}
		}
		else {
			$field_err = "Please fill both the username and password field!";
		}
	}

?>


<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Warung Bakso</title>
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<!--Custom Font-->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

	<style>
		body {
			background: url(assets/images/background/bg_login.jpg) no-repeat center center fixed;
			-webkit-background-size: cover;
			-moz-background-size: cover;
			-o-background-size: cover;
			background-size: cover;
		}

    .wrapper {
      background-color: rgb(21, 89, 73, 0.8);
      width: 100%;
      height: 100vh;
    }

		.loginbox {
			width: 350px;
			height: 410px;
			background: white;
			top: 50%;
			left: 50%;
			position: absolute;
			transform: translate(-50%, -50%);
			box-sizing: border-box;
			padding: 30px 30px;
			border-radius: 5px;
		}

    .btn {
      background: #207561;
      color: white;
    }
    .btn:hover {
    	background: #155949;
    	color: white;
    }
	.help-block {
		color: red;
		font-size: 12px;
	}
	</style>
</head>

<body>
	<div class="wrapper">
		<?php

		if (isset($_GET['pesan'])) {
			if ($_GET['pesan'] == "gagal") {

				echo '
		<div class="alert alert-danger alert-dismissible">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<strong>Peringatan!</strong><br> Username atau Password Salah.
		</div>';

			}
		}
		?>
<div class="loginbox">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <h3 class="text-center mb-5">Logo Here</h3>
    <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" class="form-control" placeholder="Username" autocomplete="off">
		<div class="help-block"><?php echo $username_err; ?></div>
    </div>
    <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" class="form-control" placeholder="Password" autocomplete="off">
		<span class="help-block"><?php echo $password_err; ?></span>
    </div>
    <input type="submit" name="login" value="Login" class="btn btn-block mt-4">
    </form>
</div>
</body>
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>

	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->
	<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script> -->
	<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script> -->
</html>
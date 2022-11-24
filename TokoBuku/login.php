<?php 
	session_start();
	$koneksi = new mysqli("localhost","root","","tokobuku");

?>
<!DOCTYPE html>
<html>
<head>
	<title>Halaman Login</title>
	<link rel="stylesheet" type="text/css" href="admin/assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/login.css">

</head>
<body>
    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/style.css" rel="stylesheet">

    <style>

    h1{
      padding-top: 0px;
    }
    article {
      background-color: white;
    }
  </style>


	<nav class="navbar navbar-default" style="background: black;">
			<ul class="nav navbar-nav" >
				<?php if (isset($_SESSION['pelanggan'])): ?>
				<li><a href="logout.php" onclick="return confirm('Apakah Anda Yakin ?')">Logout</a></li>
				<?php else: ?>
				<li><a href="login.php">Login</a></li>
				<li><a href="daftar.php">Register</a></li>
				<?php endif ?>				
				<li><a href="index.php">Home</a></li>
			</ul>
	</nav>
	<div class="col-md-4"></div>

	<div class="container col-md-4" style="background: #8a8a8a; margin-top: 127px;" >
		<div class="row" >
			<div class="col-md-12">
				<div class="pane panel-default">
					<div class="panel-heading" style="background: #8a8a8a;">
						<h2 class="panel-title">Login</h2>
					</div>
					<div class="panel-body">
						<form method="post">
							<div class="form-group">
								<label>Email</label>
								<input type="email" name="gmail" class="form-control">
							</div>
							<div class="form-group">
								<label>Password</label>
								<input type="password" name="password" class="form-control">
							</div>
							<button class="btn btn-success" name="login">Login</button>
							<p style="margin-top: 10px; cursor: default;">Belum Punya Akun ? <a href="daftar.php" style="color: white;">Register</a></p>
							
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php
	if (isset($_POST["login"])) {
		$ambil = $koneksi->query("SELECT * FROM pelanggan WHERE gmail_pelanggan='$_POST[gmail]' AND password_pelanggan='$_POST[password]'");
		$akunyangcocok = $ambil->num_rows;
		if ($akunyangcocok==1) {
			$_SESSION['pelanggan'] = $ambil->fetch_assoc();
			echo "<script> alert('Login Berhasil'); </script>";
			echo "<script> location='index.php'; </script>";
		}
		else {
			echo "<script> alert('Login Gagal, Tekan Ok Untuk Coba Lagi'); </script>";
			echo "<script> location='login.php'; </script>";
		}
	}
?>
</body>
</html>
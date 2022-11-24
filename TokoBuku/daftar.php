<?php 
session_start();
 $koneksi = new mysqli("localhost","root","","tokobuku");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Halaman Register</title>
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
	<div class="container col-md-4" style="background: #8a8a8a; margin-top: 85px;">
		<div class="row">
			<div class="col-md-12">
				<div class="pane panel-default">
					<div class="panel-heading" style="background: #8a8a8a;">
						<h3 class="panel-title">Register</h3>
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
							<div class="form-group">
								<label>Nama</label>
								<input type="text" name="nama" class="form-control">
							</div>
							<div class="form-group">
								<label>Telepon</label>
								<input type="text" name="telepon" class="form-control">
							</div>
							<button class="btn btn-success" name="daftar">Daftar</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>

<?php  
	if (isset($_POST['daftar'])) {
		$nama = $_POST['nama'];
		$password = $_POST['password'];
		$email = $_POST['gmail'];
		$telepon = $_POST['telepon'];
		$ambil = $koneksi->query("SELECT * FROM pelanggan WHERE gmail_pelanggan='$email'");
		$yangcocok = $ambil->num_rows;
		if ($yangcocok==1) {
			echo "<script> alert('Pendaftaran Gagal Karena Gmail Sudah Digunakan');</script>";
			echo "<script> location='daftar.php' </script>";
		}
		else {
			$koneksi->query("INSERT INTO pelanggan (gmail_pelanggan, password_pelanggan,nama_pelanggan,telepon_pelanggan) VALUES ('$email','$password','$nama','$telepon')");
			echo "<script> alert('Pendaftaran Sukses, Silahkan Login');</script>";
			echo "<script> location='login.php' </script>";
		}
		echo "<script> alert('Data Tersimpan, Silakan Login') </script>";
		echo "<meta http-equiv='refresh' content='1;url=login.php?hal=produk'>";
	}

?>

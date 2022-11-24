<?php 
	session_start();
	$koneksi = new mysqli("localhost","root","","tokobuku");

	if (!isset($_SESSION['pelanggan']) OR empty($_SESSION['pelanggan'])) {
	echo "<script> alert('Silahkan Login Terlebih Dahulu'); </script>";
	echo "<script> location='login.php' </script>";
	exit();
	}

	$id_pem = $_GET['id'];
	$ambil = $koneksi->query("SELECT * FROM pembelian WHERE id_pembelian='$id_pem'");
	$detpem = $ambil->fetch_assoc();

	$id_pelanggan_beli = $detpem['id_pelanggan'];
	$id_pelanggan_login = $_SESSION['pelanggan']['id_pelanggan'];

	if ($id_pelanggan_login !== $id_pelanggan_beli) {
		echo "<script> alert('Tidak Dapat Mengakses'); </script>";
		echo "<script> location='riwayat.php' </script>";
		exit();

	}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Halaman Pembayaran</title>
	<link rel="stylesheet" type="text/css" href="admin/assets/css/bootstrap.css">
</head>
<body>
	<body>
    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/style.css" rel="stylesheet">
    <style>

    h1{
      padding-top: 0px;
    }
    h2{
    	text-align: center;
    	color: white;
    }
    article {
      background-color: white;
    }

    p{
    	cursor: default;
    	color: white;
    	font-size: 20px;
    }

  </style>
<nav class="navbar navbar-default" style="background: green;" >
<h2><img src="img/logo.png" height="100px" style="border-radius: 50%">TOKO BUKU</h2>
		<div class="container" style="background: black;">
			<ul class="nav navbar-nav">				
				<li><a href="index.php">Home</a></li>
				<li><a href="rekomendasi.php">Best Seller</a></li>
				<?php if(!isset($_SESSION["keranjang"])) : ?>
					<li><a href="keranjang.php">Keranjang<strong>(0)</strong></a></li>
				<?php else : ?>
				<hide>
						<?php $jml=0; ?>
						<?php foreach ($_SESSION["keranjang"] as $id_produk => $jumlah): ?>
						<?php $ambildata = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'"); ?>
						<?php $pecah = $ambildata->fetch_assoc(); ?>
						<tr>
							<td><?php $jumlah ?></td>
						</tr>
						<?php $jml += $jumlah; ?>
						<?php endforeach ?>
				</hide>
				<li><a href="keranjang.php">Keranjang<strong>(<?php echo $jml ?>)</strong></a></li>
			<?php endif ?>
				<li><a href="bayar.php">Pembayaran</a></li>
				<?php if (isset($_SESSION['pelanggan'])): ?>
				<li><a href="riwayat.php">Riwayat</a></li>
				<li><a href="logout.php" onclick="return confirm('Apakah Anda Yakin ?')">Logout</a></li>
				<?php else: ?>
				<li><a href="riwayat.php">Riwayat</a></li>
				<li><a href="login.php">Login</a></li>
				<?php endif ?>			
			</ul>
			<form action="pencarian.php" method="get" class="navbar-form navbar-right">
				<input type="text" name="keyword" class="form-control" placeholder="Pencarian">
				<button class="btn btn-primary">Cari</button>
			</form>
		</div>
	</nav>
</body>
</html>


<?php
	session_start();
	$koneksi = new mysqli("localhost","root","","tokobuku");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Buku Terbaru</title>
	<link rel="stylesheet" type="text/css" href="admin/assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/index.css">
</head>
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

	<section class="konten" style="margin-top: 80px">
		<div class="container">
      <div class="meta-post">
			<div class="row">
				<?php $ambil = $koneksi->query("SELECT * FROM produk");?>
				<?php while($perproduk = $ambil->fetch_assoc()) { ?>
				<div class="col-md-3">
					<div class="thumbnail">
						<img src="foto_produk/<?php echo $perproduk['foto_produk']; ?>">
						<div class="caption">
							<h3> <?php echo $perproduk['nama_produk']; ?></h3>
							<h5>Stok 
								<?php if($perproduk['stok_produk']>=1){
									echo $perproduk['stok_produk'];
								}
								else
									echo "<strong>Habis</strong>";
								 ?>
							</h5>
							<h5> Rp. <?php echo number_format($perproduk['harga_produk']); ?></h5>
							<?php if($perproduk['stok_produk']>=1) : { ?>
							<a href="beli.php?id=<?php echo $perproduk['id_produk']; ?>" class="btn btn-primary">Beli</a>
							<a href="detail.php?id=<?php echo $perproduk['id_produk']; ?>" class="btn btn-danger">Lihat</a>
						<?php  } ?>
						<?php else  :{ ?>
							<p style="color: red;">HABIS</p>
						<?php } ?>
						<?php endif ?>
						</div>
					</div>
				</div>
				<?php } ?>
			</div>
		</div>
	</div>
	</section>
</body>
</html>
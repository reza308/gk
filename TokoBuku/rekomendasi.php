<?php
	session_start();
	$koneksi = new mysqli("localhost","root","","tokobuku");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Rekomendasi Best Seller</title>
	<link rel="stylesheet" type="text/css" href="admin/assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/index.css">
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    h2{
      text-align: center;
      color: white;
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
<section class="myCarousel" id="myCarousel">
        <div class="myCarousel">
            <div class="row">
                <div class="col-sm-12 text-center">
                    <h1><b>Buku Rekomendasi Best Seller</b></h1>
                    <h3>Toko Buku</h3>
                    <hr>
                </div>
            </div>
        </div>
      </div>
    </section>
</body>
</html>
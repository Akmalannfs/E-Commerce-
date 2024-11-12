<?php include'db.php'?>
<?php
         $keyword = $_GET["keyword"];

         $semuadata=array();
         $ambil = $conn->query("SELECT * FROM produk WHERE nama_produk LIKE '%$keyword%'");
         while($pecah = $ambil->fetch_assoc()){
          $semuadata[]=$pecah;
         }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GoodPrint</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;500;700&display=swap" rel="stylesheet">

    <!-- icons -->
    <script src="https://unpkg.com/feather-icons"></script>

    <!-- css -->
    <link href="css/style2.css" rel="stylesheet" />
</head>
<body>


<!-- navbar start -->
<nav class="navbar">
    <a href="#" class="navbar-logo">GoodPr<span>i</span>nt.</a>

    <div class="navbar-nav">
        <a href="index.php">Home</a>
        <a href="produk.php">Produk</a>
        <a href="tentang-kami.php">Tentang Kami</a>
        <?php if (isset($_SESSION["pelanggan"])):?>
        <a href="riwayat.php">Riwayat Pembelian</a>
        <a href="logout.php">Logout</a>
        <?php else: ?>
        <a href="login.php">Login</a>
        <?php endif ?>

    </div>

    <div class="navbar-extra">
        <a href="#" id="search-button"><i data-feather="search"></i></a>
        <a href="keranjang.php" id="shopping-cart"><i data-feather="shopping-cart"></i></a>
        <a href="#" id="hamburger-menu"><i data-feather="menu"></i></a>
    </div>

    <!-- form search -->
    <div class="search-form">
    <form action="pencarian.php" method="GET">
        <input type="search" id="search-box" placeholder="Cari Produk..." name="keyword">
        <button for="search-box"><i data-feather="search"></i></button>
        </form>
    </div>
    <!-- form end -->

</nav>
<!-- navbar end -->

<!-- Produk start-->
    <section class="produk">
        <div class="cont">
         <h2>Hasil Pencarian : <?php echo $keyword ?></h2>

         <div class="row">

                <?php foreach ($semuadata as $key => $value):?>

                <a href="detail-produk.php?id=<?php echo $value['id_produk'] ?>">
				        <div class="col-md-3">
                    <div class="thumbnail">
                        <img src="foto_produk/<?php echo $value['foto_produk']; ?>" alt="">
                        <h4><?php echo $value['nama_produk']; ?></h4>
                        <h3>Rp. <?php echo number_format($value['harga_produk']); ?></h3>
                    </div>
                </div>
              </a>
			</div>
            <?php endforeach ?>
    </div>
    </section>
<!-- Produk end -->

<!-- Footer -->
<footer>
  <div class="footer">
    <div class="footer-info">
      <p>Alamat         : Jl Kebun Kosong Raya, G.Mantri III No.159,</p>
      <p>                  Kemayoran, Senen, Jakarta Pusat</p>
      <p>Email          : masgoodprint@gmail.com</p>
      <p>No. Telepon    : (021) 2242 1886</p>
    </div>
    <div class="footer-copyright">
      <p>&copy; 2023 GoodPrint. Hak Cipta Dilindungi.</p>
    </div>
  </div>
</footer>
<!-- Footer end -->

    <!-- icons -->
    <script>
      feather.replace()
    </script>

    <!-- Javascript -->
    <script src="js/script.js"></script>
</body>
</html>
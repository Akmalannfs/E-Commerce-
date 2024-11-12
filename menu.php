<?php 
	$hostname = 'localhost';
	$username = 'root';
	$password = '';
	$dbname   = 'db_goodprint';

	$conn = mysqli_connect($hostname, $username, $password, $dbname) or die ('Gagal terhubung ke data base');

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
    <a href="index.php" class="navbar-logo">GoodPr<span>i</span>nt.</a>

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

    <!-- icons -->
    <script>
      feather.replace()
    </script>

    <!-- Javascript -->
    <script src="js/script.js"></script>
</body>
</html>
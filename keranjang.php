<?php
session_start();

$conn = new mysqli("localhost", "root", "", "db_goodprint");

if (empty ($_SESSION["keranjang"]) OR !isset($_SESSION["keranjang"])) {
    echo "<script>alert('Keranjang kosong, silahkan belanja dulu');</script>";
    echo "<script>location='index.php';</script>";
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

<!-- konten -->
<section class="keranjang">
    <div class="cont">
        <h1>Keranjang Belanja</h1>
        <hr>
        <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Produk</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Sub harga</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php $nomor=1; ?>
            <?php foreach ($_SESSION["keranjang"] as $id_produk => $jumlah): ?>
                <?php
                $ambil = $conn->query("SELECT * FROM produk WHERE id_produk='$id_produk'" );
                $pecah = $ambil->fetch_assoc();
                $subharga = $pecah["harga_produk"]* $jumlah;
                 ?>
            <tr>
                <td><?php echo $nomor; ?></td>
                <td><?php echo $pecah['nama_produk']; ?></td>
                <td>Rp. <?php echo number_format($pecah['harga_produk']); ?></td>
                <td><?php echo $jumlah; ?></td>
                <td>Rp. <?php echo number_format($subharga); ?></td>
                <td>
                    <a href="hapuskeranjang.php?id=<?php echo $id_produk ?>" id="trash-2"><i data-feather="trash-2"></i></a>
                </td>
            </tr>
            <?php $nomor++; ?>
            <?php endforeach ?>
        </tbody>
        </table>
        <a href="produk.php" class="btn-lanjut">Lanjutkan Belanja</a>
        <a href="checkout.php" class="btn-co">Checkout</a>
    </div>
</section>
<!-- konten end -->


<!-- Footer -->
<!-- Footer end -->

    <!-- icons -->
    <script>
      feather.replace()
    </script>

    <!-- Javascript -->
    <script src="js/script.js"></script>
</body>
</html>
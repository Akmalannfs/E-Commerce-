<?php
session_start();

$conn = new mysqli("localhost", "root", "", "db_goodprint");

$id_pembelian = $_GET["id"];

$ambil = $conn->query("SELECT * FROM pembayaran 
LEFT JOIN pembelian ON pembayaran.id_pembelian=pembelian.id_pembelian 
WHERE pembelian.id_pembelian='$id_pembelian'");
$detbay = $ambil->fetch_assoc();

//jika gaada data pembayaran
if (empty($detbay)) 
{
    echo "<script>alert('Belum ada pembayaran');</script>";
    echo "<script>location='riwayat.php';</script>";
}

//pembayaran harus sesuai dgn yg login
if ($_SESSION["pelanggan"]["id_pelanggan"]!==$detbay["id_pelanggan"]) 
{
    echo "<script>alert('Tidak ada pembelian');</script>";
    echo "<script>location='riwayat.php';</script>";
}

//jika blm login
if (!isset($_SESSION["pelanggan"])){
    echo "<script>alert('silahkan login');</script>";
    echo "<script>location='login.php';</script>";
}
?>
<?php require "menu.php"; ?>

<!-- konten -->
<section class="konten">
<div class="container">
    <h2>Lihat Pembayaran</h2>
    <div class="lht-byr">
        <strong>
            <p>Nama : <?php echo $detbay["nama"] ?></p>
            <br>
            <p>Bank : <?php echo $detbay["bank"] ?></p>
            <br>
            <p>Tanggal : <?php echo $detbay["tanggal"] ?></p>
            <br>
            <p>Jumlah : Rp. <?php echo number_format($detbay["jumlah"]) ?></p>
            <br>
        </strong>
    </div>
        <img src="bukti-pembayaran/<?php echo $detbay["bukti"] ?>" alt="" width="30%">
</div>
</section>
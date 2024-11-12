<?php
session_start();

$conn = new mysqli("localhost", "root", "", "db_goodprint");

if (!isset($_SESSION["pelanggan"])){
    echo "<script>alert('silahkan login');</script>";
    echo "<script>location='login.php';</script>";
}
?>
<?php require "menu.php"; ?>

<!-- konten -->

<section class="konten">
    <div class="container">


    <h2>Detail Pembelian</h2>

<?php 
$ambil=$conn->query("SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_pelanggan WHERE pembelian.id_pembelian='$_GET[id]'" );
$detail = $ambil->fetch_assoc();
?>

<?php
//mendapatkan id_pelanggan yang beli
$idpelangganbeli = $detail["id_pelanggan"];

//mendapatkan id pelanggan yang login
$idpelangganlogin = $_SESSION["pelanggan"]["id_pelanggan"];

if ($idpelangganbeli!==$idpelangganlogin)
{
    echo "<script>alert('Produk tidak ada');</script>";
    echo "<script>location='riwayat.php';</script>";
    exit();
}
?>

<div class="detail-pembeli">
<strong>Nama : <?php echo $detail['nama_pelanggan']; ?></strong><br>
<p>
   No.Pembelian : <?php echo $detail['id_pembelian']; ?> <br>
   No.Telp : <?php echo $detail['telp_pelanggan']; ?> <br>
   Email :  <?php echo $detail['email_pelanggan'];?> <br>
   Alamat :  <?php echo $detail['alamat_pelanggan'];?> <br>
   Kode Pos :  <?php echo $detail['kode_pos'];?>

</p>

<p>
Tanggal : <?php echo $detail['tanggal_pembelian']; ?> <br>
Total : <?php echo $detail['total_pembelian']; ?>
</p>
</div>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Produk</th>
            <th>Jumlah</th>
            <th>Harga</th> 
            <th>Subtotal</th>
            <th>Desain</th>
        </tr>
    </thead>
    <tbody>
        <?php $nomor=1; ?>
        <?php $ambil=$conn->query("SELECT * FROM pembelian_produk WHERE id_pembelian='$_GET[id]'");?>
        <?php while($pecah = $ambil->fetch_assoc()){?>
        <tr>
            <td><?php echo $nomor; ?></td>
            <td><?php echo $pecah['nama']; ?></td>
            <td><?php echo $pecah['jumlah']; ?></td>
            <td>Rp. <?php echo number_format($pecah['harga']); ?></td>
            <td>Rp. <?php echo number_format($pecah['subharga']); ?></td>
            <td>
            <img src="./desain/<?php echo $pecah['desain_pembelian']; ?>" width="50px">
            </td>
        </tr>
        <?php $nomor++; ?>
        <?php } ?>
    </tbody>
</table>

<div class="row">
    <div class="col-md-7">
            <p>
                Silahkan melakukan pembayaran Rp. <?php echo number_format($detail['total_pembelian']); ?> ke <br>
                <strong>BANK BCA 2370304591 AN. NANDIKA BAYU ARDANA</strong>
            </p>
    </div>
</div>
    </div>
</section>
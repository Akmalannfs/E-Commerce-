<?php 
session_start();
    //jika blm login
    if (!isset($_SESSION["pelanggan"]) OR empty($_SESSION["pelanggan"]))
    {
        echo "<script>alert('silahkan login');</script>";
        echo "<script>location='login.php';</script>";
    }
?>
<?php require "menu.php"; ?>
<!-- konten -->
<section class="riwayat">
    <div class="cont">
        <h1>Riwayat Belanja <?php echo $_SESSION["pelanggan"]["nama_pelanggan"]?></h1>
        <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Status</th>
                <th>Total</th>
                <th>Opsi</th>
            </tr>
        </thead>
        <tbody>
                <?php
                $nomor=1;
                //mendapatkan id pelanggan
                $id_pelanggan = $_SESSION["pelanggan"]['id_pelanggan'];

                $ambil = $conn->query("SELECT * FROM pembelian WHERE id_pelanggan='$id_pelanggan' ");
                while ($pecah = $ambil->fetch_assoc()) {
                 ?>
            <tr>
                <td><?php echo $nomor; ?></td>
                <td><?php echo $pecah['tanggal_pembelian']; ?></td>
                <td>
                    <strong><?php echo $pecah['status_pembelian']; ?></strong>
                    <br>
                    <?php if (!empty($pecah['resi_pengiriman'])): ?>
                        Resi : <?php echo $pecah['resi_pengiriman']; ?>
                        <?php endif ?>
                </td>
                <td>Rp. <?php echo number_format($pecah['total_pembelian']); ?></td>
                <td>
                    <a href="nota.php?id=<?php echo $pecah["id_pembelian"]?>">Nota</a>

                    <?php if ($pecah['status_pembelian']=="Menunggu pembayaran") :?>
                    <a href="pembayaran.php?id=<?php echo $pecah["id_pembelian"]?>"> || Bayar</a>
                    <?php else:?>
                        <a href="lihat-pembayaran.php?id=<?php echo $pecah["id_pembelian"]?>"> || Lihat pembayaran</a>
                    <?php endif ?>

                    <?php if ($pecah['status_pembelian']=="Dalam pengiriman") :?>
                    <a href="produk-diterima.php?id=<?php echo $pecah['id_pembelian'] ?>" onclick="return confirm('Yakin produk sudah diterima ?')">|| Produk Diterima</a>
                    <?php endif ?>
                </td>
            </tr>
            <?php $nomor++; ?>
            <?php } ?>
        </tbody>
    </div>
</section>
<!-- konten end-->
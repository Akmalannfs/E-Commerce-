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
<section class="keranjang">
    <div class="cont">
        <h1>Checkout</h1>
        <hr>
        <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Produk</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Sub harga</th>
            </tr>
        </thead>
        <tbody>
        <?php $nomor=1; ?>
        <?php $totalbelanja = 0;?>
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
            </tr>
            <?php $nomor++; ?>
            <?php $totalbelanja+=$subharga; ?>
            <?php endforeach ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="4">Total Belanja</th>
                <th>Rp. <?php echo number_format($totalbelanja) ?></th>
            </tr>
        </tfoot>
        </table>
        <div class="container">
        <div class="checkout">
            <form action="" method=POST enctype="multipart/form-data">
            <h1>Formulir Pembelian</h1>
            <hr>
            <label for="">Nama</label>
            <input type="text" name="nama" readonly value="<?php echo $_SESSION['pelanggan']['nama_pelanggan']?>">
            <label for="">No.telp</label>
            <input type="text" name="telp" readonly value="<?php echo $_SESSION['pelanggan']['telp_pelanggan']?>">
            <label for="">Email</label>
            <input type="text" name="email" readonly value="<?php echo $_SESSION['pelanggan']['email_pelanggan']?>">
            <label for="">Alamat</label>
            <input type="text" name="alamat" readonly value="<?php echo $_SESSION['pelanggan']['alamat_pelanggan']?>">
            <label for="">Kode Pos</label>
            <input type="text" name="kodepos" readonly value="<?php echo $_SESSION['pelanggan']['kode_pos']?>">
            <label for="">Upload Desain</label>
            <input type="file" name="foto">
            <button class="btn-co2" name="beli">Checkout</button>
            </form>
            
        <?php
        if (isset($_POST["beli"]))
        {
            $id_pelanggan = $_SESSION["pelanggan"]["id_pelanggan"];

            $total_pembelian = $totalbelanja;


            //menyimpan data ke tb pembelian
            $conn->query("INSERT INTO  pembelian (id_pelanggan, total_pembelian, tanggal_pembelian) 
            VALUES ('$id_pelanggan', '$total_pembelian', null)"
            );

            //mendapatkan id_pembelian terbaru
            $id_pembelian_terbaru = $conn->insert_id;

            foreach ($_SESSION["keranjang"] as $id_produk => $jumlah) 
            {
                //mendapatkan data produk berdasarkan id_produk
                $ambil = $conn->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
                $perproduk = $ambil->fetch_assoc();

                $nama = $perproduk['nama_produk'];
                $harga = $perproduk['harga_produk'];

                $name = $_FILES['foto']['name'];
                $lokasi = $_FILES['foto']['tmp_name'];
    
                move_uploaded_file($lokasi, "./desain/".$name);

                $subharga = $perproduk['harga_produk']*$jumlah;
                
                $conn->query("INSERT INTO pembelian_produk (id_pembelian, id_produk, desain_pembelian, jumlah, nama, harga, subharga, tanggal_pembelian)
                VALUES ('$id_pembelian_terbaru', '$id_produk', '$name', '$jumlah', '$nama', '$harga', '$subharga', null )");
            }

            //mengkosongkan keranjang belanja

            unset($_SESSION["keranjang"]);

            //halaman pindah ke halaman nota
            echo "<script>alert('Pembelian Sukses');</script>";
            echo "<script>location='nota.php?id=$id_pembelian_terbaru';</script>";

        }
        ?>
        </div>
        </div>
    </div>
</section>
<!-- konten end -->
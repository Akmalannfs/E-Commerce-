<?php
session_start();
?>
<?php 
	include 'db.php';
    ?>
<?php
//mendapatkan id produk dari url
    $id_produk = $_GET["id"];

    //query ambil data
    $ambil = $conn->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
    $detail = $ambil->fetch_assoc();
?>

<?php require "menu.php"; ?>

<!-- detail -->
<section id="konten" class="konten">
        <div class="row">
            <div class="detail-img">
                <img src="foto_produk/<?php echo $detail['foto_produk']; ?>" alt="" width="100%">
            </div>
            <div class="col-md-6">
                <h2><?php echo $detail['nama_produk']; ?></h2>
                <h4>Rp. <?php echo number_format($detail['harga_produk']); ?></h4><br>
                <p>Deskripsi : <br>
                    <?php echo $detail['deskripsi_produk'];?></p><br>

                <form method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <div class="input-group">
                            <label>Qty</label>
                            <input type="number" min="1" class="form-control" name="jumlah">
                        </div>
                    </div>
                    <div>
                   <button class="btn" name="beli">Beli Sekarang</button>
                   </div>
                </form>

                <?php
                //jika di klik tombol beli
                if (isset ($_POST["beli"])) {

                //mendapatkan jumlah
                $jumlah = $_POST["jumlah"];

                   //masukkan dikeranjang belanja
                   $_SESSION["keranjang"][$id_produk] = $jumlah;                                                                                      

                   echo "<script>alert('Produk telah masuk ke keranjang belanja');</script>";
                   echo "<script>location='keranjang.php';</script>";
                }
                ?>
            </div>
    </div>
</section>

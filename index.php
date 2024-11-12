<?php require "menu.php"; ?>
<!-- banner start -->

<section class="banner" id="home">
    <main class="content">
        <h1>Mari Desain</h1>
        <p>DIGITAL PRINT || OFFSET PRINT || DESIGN</p>
        <a href="produk.php" class="cta">Pesan Sekarang</a>

    </main>

</section>
<!-- banner end -->

<!-- Produk start-->
    <section class="newproduk">
        <div class="cont">
         <h2>Produk Terbaru</h2>

         <div class="row">
         <?php $ambil = $conn->query("SELECT * FROM produk ORDER BY id_produk DESC LIMIT 4"); ?>
            <?php while($perproduk = $ambil->fetch_assoc()) { ?>
                <a href="detail-produk.php?id=<?php echo $perproduk['id_produk'] ?>"> </a>
				<div class="col-md-3">
                    <div class="thumbnail">
                        <img src="foto_produk/<?php echo $perproduk['foto_produk']; ?>" alt="">
                        <h4><?php echo $perproduk['nama_produk']; ?></h4>
                        <h3>Rp. <?php echo number_format($perproduk['harga_produk']); ?></h3>
                    </div>
                </div>
            <?php } ?>
		</div>
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
<?php

$ambil = $conn->query("SELECT * FROM produk WHERE id_produk='$_GET[id]'" );
$pecah = $ambil->fetch_assoc();
$fotoproduk = $pecah['foto_produk'];
if (file_exists("../foto_produk/$fotoproduk"))
{
    unlink("../foto_produk/$fotoproduk");
}


$conn->query("DELETE FROM produk WHERE id_produk='$_GET[id]'");

echo "<script>location='admin.php?halaman=produk';</script>";
?>
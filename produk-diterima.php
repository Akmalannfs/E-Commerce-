<?php
include'db.php';

$idpem = $_GET["id"];
$ambil = $conn->query("SELECT * FROM pembelian WHERE id_pembelian='$idpem'");
$detpem = $ambil->fetch_assoc();


$conn->query("UPDATE pembelian SET status_pembelian='Selesai' WHERE id_pembelian='$idpem'");

    echo "<script>location='riwayat.php';</script>";
?>
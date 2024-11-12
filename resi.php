<h2>Input Resi</h2>
<?php
$ambil = $conn->query("SELECT * FROM pembelian WHERE id_pembelian='$_GET[id]'");
$pecah = $ambil->fetch_assoc();
?>
<form method="post" enctype="multipart/form-data">
<div class="form-group">
        <Label>No Resi Pengiriman</Label>
        <input type="text" class="form-control" name="resi">
    </div>
    <button class="btn btn-primary" name="tambah">Tambah</button>
</form>



<?php
if (isset($_POST['tambah']))
{
    $resi = $_POST['resi'];

   $conn->query("UPDATE pembelian SET resi_pengiriman='$_POST[resi]' 
    WHERE id_pembelian='$_GET[id]'");


    echo "<script>alert('Input Resi Berhasil');</script>";
    echo "<script>location='admin.php?halaman=pembelian';</script>";
}
?>
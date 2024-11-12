<h2>Edit Data Produk</h2>
<?php
$ambil = $conn->query("SELECT * FROM produk WHERE id_produk='$_GET[id]'");
$pecah = $ambil->fetch_assoc();
?>

<form method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label>Nama Produk</label>
        <input type="text" name="nama" class="form-control" value="<?php echo $pecah['nama_produk']; ?>">
    </div>
    <div class="form-group">
        <label>Harga Produk</label>
        <input type="number" class="form-control" name="harga" value="<?php echo $pecah['harga_produk']; ?>">
    </div>
    <div>
        <img src="../foto_produk/<?php echo $pecah['foto_produk']?>" width="200">
    </div>
    <div class="form-group">
        <label>Ganti Foto</label>
        <input type="file" name="foto" class="form-control">
    </div>
    <div class="form-group">
        <label>Deskripsi</label>
        <textarea name="deskripsi" class="form-control" rows="10">
            <?php echo $pecah['deskripsi_produk']; ?>
        </textarea>
    </div>
    <button class="btn btn-primary" name="ubah">Edit</button>
</form>

<?php
if (isset($_POST['ubah']))
{
    $namafoto=$_FILES ['foto']['name'];
    $lokasifoto = $_FILES ['foto']['tmp_name'];
    if (!empty($lokasifoto))
    {
        move_uploaded_file($lokasifoto, "../foto_produk/$namafoto");

        $conn->query("UPDATE produk SET nama_produk='$_POST[nama]',
        harga_produk='$_POST[harga]',
        foto_produk='$namafoto',
        deskripsi_produk='$_POST[deskripsi]' 
        WHERE id_produk='$_GET[id]'");
    }
    else{
        $conn->query("UPDATE produk SET nama_produk='$_POST[nama]',
        harga_produk='$_POST[harga]',
        deskripsi_produk='$_POST[deskripsi]' WHERE id_produk='$_GET[id]'");
    }
    echo "<script>alert('Data Produk Telah Diubah');</script>";
    echo "<script>location='admin.php?halaman=produk';</script>";
}
?>
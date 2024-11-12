<h2>Data Produk</h2>

<table class="table table-bordered">
<p><a href="admin.php?halaman=tambahproduk"class="btn-primary btn">Tambah Produk</a></p>
    <thead>
        <tr>
        <div class="text-bg-dark p-3">
            <th width="30px">No</th>
            <th>Nama Produk</th>
            <th>Harga</th>
            <th width="150px">Foto</th>
            <th width="150px">Aksi</th>
        </div>
        </tr>
    </thead>
    <tbody>
        <?php $nomor=1; ?>
        <?php $ambil=$conn->query("SELECT * FROM produk");?>
        <?php while($pecah = $ambil->fetch_assoc()){?>
        <tr>
            <td><?php echo $nomor; ?></td>
            <td><?php echo $pecah['nama_produk']; ?></td>
            <td>Rp. <?php echo number_format ($pecah['harga_produk']); ?></td>
            <td>
                <img src="../foto_produk/<?php echo $pecah['foto_produk']; ?>" width="50px">
            </td>
            <td>
                <a href="admin.php?halaman=ubahproduk&id=<?php echo $pecah['id_produk'] ?>" class="btn-warning btn">Edit</a>
                <a href="admin.php?halaman=hapusproduk&id=<?php echo $pecah['id_produk'] ?>" onclick="return confirm('Yakin ingin hapus ?')" class="btn-danger btn">Hapus</a>
            </td>
        </tr>
        <?php $nomor++; ?>
        <?php } ?>
    </tbody>
</table>
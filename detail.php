<h2>Detail Pembelian</h2>

<?php 
$ambil=$conn->query("SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_pelanggan WHERE pembelian.id_pembelian='$_GET[id]'" );
$detail = $ambil->fetch_assoc();
?>

<strong>Nama : <?php echo $detail['nama_pelanggan']; ?></strong><br>
<p>
   No.Telp : <?php echo $detail['telp_pelanggan']; ?> <br>
   Email :  <?php echo $detail['email_pelanggan'];?> <br>
   Alamat :  <?php echo $detail['alamat_pelanggan'];?> <br>
   Kode Pos :  <?php echo $detail['kode_pos'];?>
</p>

<p>
Tanggal : <?php echo $detail['tanggal_pembelian']; ?> <br>
Total : <?php echo $detail['total_pembelian']; ?>
</p>

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
        <?php $ambil=$conn->query("SELECT * FROM pembelian_produk JOIN produk ON pembelian_produk.id_produk=produk.id_produk
        WHERE pembelian_produk.id_pembelian='$_GET[id]'");?>
        <?php while($pecah = $ambil->fetch_assoc()){?>
        <tr>
            <td><?php echo $nomor; ?></td>
            <td><?php echo $pecah['nama']; ?></td>
            <td><?php echo $pecah['jumlah']; ?></td>
            <td><?php echo $pecah['harga']; ?></td>
            <td><?php echo $pecah['subharga']; ?></td>
            <td>
            <img src="../desain/<?php echo $pecah['desain_pembelian']; ?>" width="50px">
            </td>
        </tr>
        <?php $nomor++; ?>
        <?php } ?>
    </tbody>
</table>

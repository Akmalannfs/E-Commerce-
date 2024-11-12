<h2>Data Pembelian</h2>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Pelanggan</th>
            <th>Tanggal</th>
            <th>Total</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $nomor=1; ?>
        <?php $ambil=$conn->query("SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_pelanggan");?>
        <?php while($pecah = $ambil->fetch_assoc()){?>
        <tr>
            <td><?php echo $nomor; ?></td>
            <td><?php echo $pecah['nama_pelanggan']; ?></td>
            <td><?php echo $pecah['tanggal_pembelian']; ?></td>
            <td><?php echo $pecah['total_pembelian']; ?></td>
            <td><?php echo $pecah['status_pembelian']; ?></td>
            <td>
                <a href="admin.php?halaman=detail&id=<?php echo $pecah['id_pembelian']?>" class="btn-info btn">Detail</a>

                <?php if ($pecah['status_pembelian']!=="Menunggu pembayaran") :?>
                <a href="admin.php?halaman=pembayaran&id=<?php echo $pecah['id_pembelian'] ?>" class="btn-success btn">Pembayaran</a>
                <?php endif ?>

                <?php if ($pecah['status_pembelian']=="Dalam pengiriman") :?>
                <a href="admin.php?halaman=resi&id=<?php echo $pecah['id_pembelian'] ?>" class="btn-warning btn">Input Resi</a>
                <?php endif ?>
            </td>
        </tr>
        <?php $nomor++; ?>
        <?php } ?>
    </tbody>
</table>
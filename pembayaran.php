<h2>Data Pembayaran</h2>

<?php
//mendapatkan id pembelian
$id_pembelian = $_GET['id'];

//mengambil data pembayaran berdasarkan id pembelian
$ambil = $conn->query("SELECT * FROM pembayaran WHERE id_pembelian='$id_pembelian'");
$detail = $ambil->fetch_assoc();
?>

<div class="row">
    <div class="col-md-6">
        <table class="table">
            <tr>
                <th>Nama</th>
                <td><?php echo $detail['nama'] ?></td>
            </tr>
            <tr>
                <th>Bank</th>
                <td><?php echo $detail['bank'] ?></td>
            </tr>
            <tr>
                <th>Jumlah</th>
                <td>Rp. <?php echo number_format($detail['jumlah']) ?></td>
            </tr>
            <tr>
                <th>Tanggal</th>
                <td><?php echo $detail['tanggal'] ?></td>
            </tr>
        </table>
    </div>
    <div class="col-md-6">
        <img src="../bukti-pembayaran/<?php echo $detail['bukti'] ?>" alt="" class="img-responsive">
    </div>
</div>

<form method="post">
    <?php
    $ambil = $conn->query("SELECT * FROM pembelian");
    $detail = $ambil->fetch_assoc();
    ?>

    <div class="form-group">
        <label>Status</label>
        <select class="form-control" name="status">
        <option value="">Pilih Status</option>
        <option value="pembayaran gagal">Pembayaran gagal</option>
        <option value="Sedang proses">Sedang Proses</option>
        <option value="Dalam pengiriman">Dalam Pengiriman</option>
        <option value="Selesai">Selesai</option>
        </select>
    </div>
    <button class="btn btn-primary" name="proses">Proses</button>
</form>

<?php
if (isset($_POST["proses"])) 
{
    $status = $_POST["status"];
    $conn->query("UPDATE pembelian SET status_pembelian='$status'
    WHERE id_pembelian='$id_pembelian'");

    echo "<script>alert(Data Pembelian Terupdate);</script>";
    echo "<script>location='admin.php?halaman=pembelian';</script>";
}
?>
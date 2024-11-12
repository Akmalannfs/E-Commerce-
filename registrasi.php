<?php
session_start();

include 'db.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GoodPrint</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;500;700&display=swap" rel="stylesheet">

    <!-- icons -->
    <script src="https://unpkg.com/feather-icons"></script>

    <!-- css -->
    <link href="css/style2.css" rel="stylesheet" />
</head>
<body>
    <div class="container">
        <div class="login">
            <form action="" method=POST>
            <h1>Registrasi</h1>
            <hr>
            <label for="">Nama</label>
            <input type="text" name="nama" placeholder="nama" required>
            <label for="">Email</label>
            <input type="email" name="email" placeholder="Email" required>
            <label for="">Password</label>
            <input type="password" name="pass" placeholder="Password" required>
            <label for="">No.telp</label>
            <input type="text" name="telp" placeholder="Nomor Telepon" required>
            <label for="">Alamat Lengkap</label>
            <input type="text" name="alamat" placeholder="Alamat Lengkap" required>
            <label for="">Kode Pos</label>
            <input type="text" name="kodepos" placeholder="Kode Pos" required>
            <button type="submit" name="daftar">Daftar</button>
            <p>Sudah punya akun?
                <a href="login.php">Login Sekarang</a>
            </p>
            </form>
            <?php
            if (isset($_POST["daftar"])) 
            {
                //mengambil input form
                $nama = $_POST['nama'];
                $email = $_POST['email'];
                $pass = $_POST['pass'];
				$telp = $_POST['telp'];
				$alamat = $_POST['alamat'];
				$kodepos = $_POST['kodepos'];

                //cek apakah email sudah digunakan
                $ambil = $conn->query("SELECT * FROM pelanggan WHERE email_pelanggan='$email'");
                $emailcocok = $ambil->num_rows;
                if ($emailcocok==1) 
                {
                   echo "<script>alert('Pendaftaran gagal, email sudah digunakan');</script>";
                   echo "<script>location='registrasi.php';</script>";
                }
                else
                {
                    //insert ke database
                    $conn->query("INSERT INTO pelanggan (email_pelanggan, password_pelanggan, nama_pelanggan, telp_pelanggan, alamat_pelanggan, kode_pos) 
                    VALUES ('$email', '$pass', '$nama', '$telp', '$alamat', '$kodepos' ) ");

                    echo "<script>alert('Pendaftaran berhasil');</script>";
                    echo "<script>location='login.php';</script>";
                }
            }
            ?>
        </div>
    </div>

    <?php
    //jika tombol login dilik
    if (isset($_POST['submit']))
    {

        $email = $_POST["email"];
        $pass = $_POST["pass"];
        //lakukan pengecekan akun
        $ambil = $conn->query("SELECT * FROM pelanggan WHERE email_pelanggan='$email' AND password_pelanggan='$pass'");

        //menghitung akun yang terambil
        $akuncocok = $ambil->num_rows;

        //jika cocok, berhasil login
        if ($akuncocok==1){
            //anda berhasil login
            // mendapatkan akun dalam bentuk array
            $akun = $ambil->fetch_assoc();
            //simpan di session pelanggan
            $_SESSION["pelanggan"] = $akun;
            echo "<script>alert('Behasil Login')</script>";
            echo "<script>location='checkout.php';</script>";
        }
        else{
            //anda gagal login
            echo "<script>alert('Email atau Password salah')</script>";
            echo "<script>location='login.php';</script>";
        }
    }
    ?>
</body>
</html>
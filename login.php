<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device, initial-scale=1">
	<title>ADMIN GOODPRINT</title>
	<link href="assets/css/style.css" rel="stylesheet" />
	<link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
</head>
<body id="bg-login">
	<div class="box-login">
		<h2>LOGIN ADMIN</h2>
		<form action="" method=POST>
			<input type="text" name="user" placeholder="Username" class="input-control">
			<input type="password" name="pass" placeholder="Password" class="input-control">
			<input type="submit" name="submit" value="Login" class="btn">
		</form>
		<?php 
			if(isset($_POST['submit'])){
				session_start();
				include 'db.php';

				$user = mysqli_real_escape_string($conn, $_POST['user']);
				$pass = mysqli_real_escape_string($conn, $_POST['pass']);


				$cek = mysqli_query($conn, "SELECT * FROM admin WHERE username = '".$user."' AND password = '".MD5($pass)."' ");
				if(mysqli_num_rows($cek) > 0){
					$d = mysqli_fetch_object($cek);
					$_SESSION['status_login'] = true;
					$_SESSION['a_global'] = $d;
					$_SESSION['id'] = $d->id_admin;	
					echo '<script>window.location="admin.php?halaman=home"</script>';
				}else{
					echo '<script>alert("Username atau Password Anda Salah!")</script>';
				}

			}
		 ?>
	</div>
</body>
</html>
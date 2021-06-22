<?php  
session_start();
include("koneksi.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Daftar</title>
	<link rel="stylesheet" type="text/css" href="daftar_css.css">
</head>
<body>
	<form method="post">
		<div class="daftar">
	<table align="center" border="2" cellpadding="8" cellspacing="1" class="tabel_daftar">
		<tr align="center">
			<td>
				<svg class="ikon" style="width:50px;height:50px " viewBox="0 0 24 24">
			    <path fill="black" d="M12,19.2C9.5,19.2 7.29,17.92 6,16C6.03,14 10,12.9 12,12.9C14,12.9 17.97,14 18,16C16.71,17.92 14.5,19.2 12,19.2M12,5A3,3 0 0,1 15,8A3,3 0 0,1 12,11A3,3 0 0,1 9,8A3,3 0 0,1 12,5M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12C22,6.47 17.5,2 12,2Z" />
				</svg><p class="judul"><b>Daftar</b></p>
				<input type="text" name="username" placeholder="Nama Pengguna" required="required" style="width: 200px; height: 25px;"><br><br>			
				<input type="text" name="ttl" placeholder="Tempat, Tanggal Lahir" required="required" style="width: 200px; height: 25px;"><br> <br>
				<input type="email" name="email" placeholder="Email" required="required" style="width: 200px; height: 25px;"><br> <br>
				<input type="text" name="no_telepon" placeholder="Nomor Telepon" required="required" style="width: 200px; height: 25px;"><br> <br>
				<input type="text" name="alamat" placeholder="Alamat" required="required" style="width: 200px; height: 25px;"><br><br>
				<input type="text" name="status" placeholder="Penjual/Pembeli" required="required" style="width: 200px; height: 25px;"><br> <br>
				<input type="password" name="password" placeholder="Sandi" required="required" style="width: 200px; height: 25px;"><br> <br>
				<input type="password" name="konfirmasi" placeholder=" Konfirmasi Sandi"required="required" style="width: 200px; height: 25px;"><br> <br>  
				<div class="login">
					<input type="submit" name="daftar" class="button" value="Daftar"><br><br>
					<a>Punya Akun ?</a><a href="login.php" class="link"> Login</a>
				</div>
			</td>
		</tr>
	</table>
	</div>
	</form>
	

<?php
if (isset($_POST['daftar'])) {
            $username = $_POST['username'];
			$ttl = $_POST['ttl'];
			$email = $_POST['email'];
			$no_telepon=$_POST['no_telepon'];
			$alamat = $_POST['alamat'];
			$status = $_POST['status'];
			$password = $_POST['password'];
			$konfirmasi = $_POST['konfirmasi'];

			if (is_numeric($no_telepon)== true) {
              
              if (mysqli_error($koneksi)) {
                echo "<script>alert('Data gagal di simpan!');</script>";
              }else {
              	if ($_POST['password']!=$konfirmasi) {
              	echo "<script>alert('Password dan Konfirmasi Password Tidak Sama');location.replace('daftar.php');</script>";
              }else{
              	$query = "INSERT INTO tb_akun SET username='$username', ttl='$ttl', email='$email', alamat='$alamat', status='$status', password='$password', konfirmasi='$konfirmasi'";
              mysqli_query($koneksi, $query);
              	echo "<script>alert('Data berhasil di simpan!');location.replace('login.php');</script>";
              }
			}
		}else{
              if (is_numeric($no_telepon) == false) {
                echo "<script>alert('mohon masukkan hanya angka pada kolom input kolom nomor telepon!');</script>";
              }
			}
		}
	?>

</body>
</html>

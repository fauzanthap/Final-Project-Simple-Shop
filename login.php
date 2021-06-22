<?php  
session_start();
require ('koneksi.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="login.css">
</head>
<body>
	<form method="post" >
		<div class="login">	
		<table align="center" class="tabel_login" border="3" cellspacing="1" cellpadding="1">
			<tr align="center">
				<td>
					<svg class="ikon"	 style="width:50px;height:50px " viewBox="0 0 24 24">
				    <path fill="black" d="M12,19.2C9.5,19.2 7.29,17.92 6,16C6.03,14 10,12.9 12,12.9C14,12.9 17.97,14 18,16C16.71,17.92 14.5,19.2 12,19.2M12,5A3,3 0 0,1 15,8A3,3 0 0,1 12,11A3,3 0 0,1 9,8A3,3 0 0,1 12,5M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12C22,6.47 17.5,2 12,2Z" />
					</svg><p class="judul"><b>Login</b></p>
					<input type="text" name="username" placeholder="Nama Pengguna" required="required" style="width: 200px; height: 25px;"><br><br>
					<input type="password" name="password" placeholder="Password" required="required" style="width: 200px; height: 25px;"><br> <br>
					<p> <b>Lupa Kata Sandi ?</b></p>
					<input type="submit" name="btn_login" value="login" class="btn_login">
				</td>
			</tr>
		</table>
	</div>
	</form>
	<?php  
if (isset($_POST['btn_login'])) { //deklarasi kondisi apabila tombol login ditekan
				$username = $_POST['username']; //deklarasi nilai username yang ditampung
				$password = $_POST['password']; //deklarasi nilai password yang ditampung
				$query = mysqli_query($koneksi," SELECT *FROM tb_akun where username='$username' AND password=$password");//query untuk mengakses tabel user
				$cek=mysqli_num_rows($query); //cek nilai di kolom user 
				if ($cek > 0){
					$data = mysqli_fetch_assoc($query);
					if ($data['status']=="penjual") {
					$_SESSION['username']=$username;
					$_SESSION['status']="penjual";
					header('location:admin.php');
					exit;
					}else if($data['status']=="pembeli") {
					$_SESSION['username']=$username;
					$_SESSION['status']="pembeli";
					header('location:home.php');
					} exit;
				}else {
					echo "Maaf Username Atau Password Salah";

				}
			}
?>
	
</body>
</html>

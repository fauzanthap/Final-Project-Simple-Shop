<?php  
session_start();
include 'koneksi.php';
if (isset($_SESSION['status'])) {
  $username=$_SESSION['username'];
  $query = mysqli_query($koneksi,"SELECT *FROM tb_akun WHERE username='$username'"); 
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Tambah Produk</title>
	<link rel="stylesheet" type="text/css" href="style2.css">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=0">
	<link rel="stylesheet" href="bostrap.css">
</head>
<body>
 <div class="panel-logout">
    <a href="logout.php" style="text-decoration: none; margin-top: 10px;" class="icon"><svg style="width:24px;height:24px" viewBox="0 0 24 24">
    <path fill="red" d="M14.08,15.59L16.67,13H7V11H16.67L14.08,8.41L15.5,7L20.5,12L15.5,17L14.08,15.59M19,3A2,2 0 0,1 21,5V9.67L19,7.67V5H5V19H19V16.33L21,14.33V19A2,2 0 0,1 19,21H5C3.89,21 3,20.1 3,19V5C3,3.89 3.89,3 5,3H19Z" />
</svg><span style="color: black; margin-left: -10px;">Logout</span></a>
  </div>
  <hr style="width: 1370px; margin-left: -10px; " align="left">
<div class="panel-atas" align="right">
  <a href="#" class="akun" style="text-decoration: none;"><svg class="ikon"  style="width:30px;height:30px " viewBox="0 0 24 24">
    <path fill="black" d="M12,19.2C9.5,19.2 7.29,17.92 6,16C6.03,14 10,12.9 12,12.9C14,12.9 17.97,14 18,16C16.71,17.92 14.5,19.2 12,19.2M12,5A3,3 0 0,1 15,8A3,3 0 0,1 12,11A3,3 0 0,1 9,8A3,3 0 0,1 12,5M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12C22,6.47 17.5,2 12,2Z" />
</svg><span style="color:black;"><?= $username ?></span></a>
</div>
<hr>
<div class="logo" style="margin-top: 30px;">
	<lu><img src="LogoHimasifo.jpg" style="width: 50px; height: 50px"></lu>
	<lu><img src="LogoUPN.png" style="width: 50px; height: 50px;"></lu>
</div> <br><br>
	<div class="container">
		<h2 style="text-align: center;">Tambah Data Produk</h2>
				<form method="post" enctype="multipart/form-data">
			<div class="form-group">
				<label>Nama Toko:</label><br>	
				<input type="text" class="form-control" name="nama_toko" required="required">
			</div>
			<div class="form-group"><br>	
				<label>Nama Produk :</label><br>
				<input type="text" class="form-control" name="nama_produk" required="required" >
			</div>
			<div class="form-group"><br>	
				<label>Harga Produk :</label><br>
				<input type="number" class="form-control"  name="harga_produk" required="required"> 
			</div>
			<div class="form-group"><br>
				<label>Biaya Pengiriman :</label><br>
				<input type="number" class="form-control" name="biaya_pengiriman" required="required">
			</div>
			<div class="form-group"><br>
				<label>Waktu Pengiriman	 :</label> <br>
				<input type="text" class="form-control" name="waktu_pengiriman" required="required">
			</div>
			<div class="form-group"><br>
				<label>Stok :</label> <br>
				<input type="number" class="form-control" name="stok" required="required">
			</div>
			<div class="form-group"><br>
				<label>Negara :</label> <br>	
				<input type="text" class="form-control" name="negara" required="required">
			</div>
			<div class="form-group"><br>
				<label>Provinsi :</label><br>	
				<input type="text" class="form-control" name="provinsi" required="required">
			</div>
			<div class="form-group"><br>
				<label>Alamat:</label><br>
				<input type="text" class="form-control" name="alamat" required="required">
			</div>
			<div class="form-group"><br>
				<label>Nomor Telepon :</label><br>
				<input type="number	" class="form-control" name="no_telepon" required="required">
			<div class="form-group"><br>
				<label>Deskripsi Produk:</label><br>
				<input type="text" class="form-control" name="deskripsi_produk" required="required" style="height: 100px;">
			</div>
			<div class="form-group"><br>
				<label>Foto Produk :</label>
				<input type="file" name="gambar_produk" required="required">
				<p style="color: red">Ekstensi yang diperbolehkan .png | .jpg | .jpeg | .gif</p>
			</div>			
			<input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
		</form>
		<?php  
		if (isset($_POST['simpan'])) {
			$nama_toko = $_POST['nama_toko'];
		$nama_produk = $_POST['nama_produk'];
		$harga_produk = $_POST['harga_produk'];
		$biaya_pengiriman = $_POST['biaya_pengiriman'];
		$waktu_pengiriman = $_POST['waktu_pengiriman'];
		$stok = $_POST['stok'];
		$negara = $_POST['negara'];
		$provinsi = $_POST['provinsi'];
		$alamat = $_POST['alamat'];
		$no_telepon = $_POST['no_telepon'];
		$deskripsi = $_POST['deskripsi_produk'];

		$rand = rand();
		$ekstensi =  array('png','jpg','jpeg','gif');
		$filename = $_FILES['gambar_produk']['name'];
		$ukuran = $_FILES['gambar_produk']['size'];
		$ext = pathinfo($filename, PATHINFO_EXTENSION);

		if(!in_array($ext,$ekstensi) ) {
			header("location:admin.php?alert=gagal_ekstensi");
		}else{
			if($ukuran < 1044070){		
				$xx = $rand.'_'.$filename;
				move_uploaded_file($_FILES['gambar_produk']['tmp_name'], 'gambar/'.$rand.'_'.$filename);
				mysqli_query($koneksi, "INSERT INTO tb_produk VALUES(NULL,'$nama_toko','$nama_produk','$harga_produk','$biaya_pengiriman','$waktu_pengiriman','$stok','$negara','$provinsi','$alamat','$no_telepon','$deskripsi','$xx')");
				header("location:admin.php?alert=berhasil");
			}else{
				header("location:admin.php?alert=gagal_ukuran");
			}
		}

		}
		?>
	</div>
	
</body>
</html>

 
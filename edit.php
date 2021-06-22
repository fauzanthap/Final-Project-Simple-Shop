<?php 
session_start();
include 'koneksi.php';
if (isset($_SESSION['status'])) {
  $username=$_SESSION['username'];
  $query = mysqli_query($koneksi,"SELECT *FROM tb_akun WHERE username='$username'"); 
}
?>

<?php  
if (!isset($_GET['id_produk'])) {
    header("location: admin.php");
  }
  $id_produk = $_GET['id_produk'];
  $data = "SELECT * FROM tb_produk WHERE id_produk = $id_produk";
  $result = mysqli_query($koneksi, $data);
  $datatb_produk = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Produk</title>
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
<div class="logo" style="margin-top: 10px;"><br><br>
	<lu><img src="LogoHimasifo.jpg" style="width: 50px; height: 50px"></lu>
	<lu><img src="LogoUPN.png" style="width: 50px; height: 50px;"></lu>
</div> <br><br>
	<div class="container">
		<h2 style="text-align: center;">Edit Data Produk</h2>
				<form action="#" method="post" enctype="multipart/form-data">
			<div class="form-group">
				<label>Nama Toko:</label><br>	
				<input type="text" class="form-control" name="nama_toko" required="required" value="<?= $datatb_produk['nama_toko'] ?>">
			</div>
			<div class="form-group"><br>	
				<label>Nama Produk :</label><br>
				<input type="text" class="form-control" name="nama_produk" required="required" value="<?= $datatb_produk['nama_produk'] ?>">
			</div>
			<div class="form-group"><br>	
				<label>Harga Produk :</label><br>
				<input type="number" class="form-control"  name="harga_produk" required="required" value="<?= $datatb_produk['harga_produk'] ?>"> 
			</div>
			<div class="form-group"><br>
				<label>Biaya Pengiriman :</label><br>
				<input type="number" class="form-control" name="biaya_pengiriman" required="required" value="<?= $datatb_produk['biaya_pengiriman'] ?>">
			</div>
			<div class="form-group"><br>
				<label>Waktu Pengiriman	 :</label> <br>
				<input type="text" class="form-control" name="waktu_pengiriman" required="required" value="<?= $datatb_produk['waktu_pengiriman'] ?>">
			</div>
			<div class="form-group"><br>
				<label>Stok :</label> <br>
				<input type="number" class="form-control" name="stok" required="required" value="<?= $datatb_produk['stok'] ?>">
			</div>
			<div class="form-group"><br>
				<label>Negara :</label> <br>	
				<input type="text" class="form-control" name="negara" required="required" value="<?= $datatb_produk['negara'] ?>">
			</div>
			<div class="form-group"><br>
				<label>Provinsi :</label><br>	
				<input type="text" class="form-control" name="provinsi" required="required" value="<?= $datatb_produk['provinsi'] ?>">
			</div>
			<div class="form-group"><br>
				<label>Alamat :</label><br>
				<input type="text" class="form-control" name="alamat" required="required" value="<?= $datatb_produk['alamat'] ?>">
			</div>
			<div class="form-group"><br>
				<label>Nomor Telepon :</label><br>
				<input type="number	" class="form-control" name="no_telepon" required="required" value="<?= $datatb_produk['no_telepon'] ?>">
			</div>
			<div class="form-group"><br>
				<label>Deskripsi Produk:</label><br>
				<input type="text" class="form-control" name="deskripsi_produk" required="required" value="<?= $datatb_produk['deskripsi_produk'] ?>">
			</div>
			<div class="form-group"><br>
				<label>Foto Produk :</label>
				<input type="file" name="gambar_produk" accept=".jpg, .png"> 
				<p style="color: red">Ekstensi yang diperbolehkan .png | .jpg | .jpeg | .gif</p>
			</div>
			<input type="hidden" name="foto_lama" value="<?= $datatb_produk['gambar_produk'] ?>"/>			
			<input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
			<input type="hidden" name="username" value="<?php echo $username; ?>">
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
		$deskripsi_produk = $_POST['deskripsi_produk'];



		$file=$_FILES['gambar_produk']['tmp_name'];    //temporary gambar_produk
$nama_file=$_FILES ['gambar_produk']['name']; //ambil nama file
$ukuran=$_FILES['gambar_produk']['size'];    //ukuran file
$extensi= strtolower(substr(strrchr($nama_file,"."),1));  //extensi setelah .(titik)
$lama=$_POST['foto_lama']; //variabel foto lama
		
if(empty($file)){
        $save=mysqli_query($koneksi, "UPDATE tb_produk set nama_toko='$nama_toko', nama_produk='$nama_produk',harga_produk='$harga_produk',biaya_pengiriman='$biaya_pengiriman',waktu_pengiriman='$waktu_pengiriman',stok='$stok',negara='$negara',provinsi='$provinsi',alamat='$alamat',no_telepon='$no_telepon',deskripsi_produk='$deskripsi_produk' where id_produk='$id_produk'");
        if($save){ //jika update berhasil maka muncul pesan dan menuju ke halaman produk
                   echo "<script>alert('Data Produk Berhasil disimpan ke database');document.location='admin.php'</script>";
        }else{  //jika update gagal maka muncul pesan
                 echo "<script>alert('Proses simpan gagal, coba kembali');document.location='edit.php'</script>";
         }

    }else
    if($ukuran > 2000000){
        $error="<p style='color:#F00;'>* Ukuran File Maksimal 2MB</p>";
    }
    elseif(strlen($nama_file) > 100){
        $error="<p style='color:#F00;'>* Nama File Maksimal 100 Karakter</p>";
    }
    elseif($extensi !="jpg" && $extensi !="png"){
        $error="<p style='color:#F00;'>* Format File yang diizinkan hanya .jpg/.png</p>";
    }
    else{  //jika semua sudah terpenuhi maka simpan ke tb_produk

    unlink('gambar/'.$lama); //hapus foto lama
    move_uploaded_file($file,"gambar/$nama_file");    //upload foto baru

    $save=mysqli_query($koneksi, "UPDATE tb_produk set nama_toko='$nama_toko',nama_produk='$nama_produk',harga_produk='$harga_produk',biaya_pengiriman='$biaya_pengiriman',waktu_pengiriman='$waktu_pengiriman',stok='$stok',negara='$negara',provinsi='$provinsi',alamat='$alamat',no_telepon='$no_telepon',deskripsi_produk='$deskripsi_produk',gambar_produk='$nama_file' where id_produk='$id_produk'");
    if($save){ //jika update berhasil maka muncul pesan dan menuju ke halaman produk
        echo "<script>alert('Data Produk Berhasil disimpan ke database');document.location='admin.php'</script>";
    }else{  //jika update gagal maka muncul pesan
         echo "<script>alert('Proses simpan gagal, coba kembali ya lain waktu');document.location='edit.php'</script>";
    }
}

		}
		?>
	</div>

	
</body>
</html>


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
    header("location: produk.php");
   }
  $jumlah = $_GET['jumlah'];
  $id_produk = $_GET['id_produk'];
  $sql = "SELECT * FROM tb_produk WHERE id_produk = $'id_produk'";
  $result = mysqli_query($koneksi, $sql);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Pengiriman</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="panel-logout">
    <a href="logout.php" style="text-decoration: none;" class="icon"><svg style="width:24px;height:24px" viewBox="0 0 24 24">
    <path fill="red" d="M14.08,15.59L16.67,13H7V11H16.67L14.08,8.41L15.5,7L20.5,12L15.5,17L14.08,15.59M19,3A2,2 0 0,1 21,5V9.67L19,7.67V5H5V19H19V16.33L21,14.33V19A2,2 0 0,1 19,21H5C3.89,21 3,20.1 3,19V5C3,3.89 3.89,3 5,3H19Z" />
</svg><span style="color: black; margin-left: -10px;">Logout</span></a>
  </div>
	<hr style="width: 1370px; margin-left: -10px; " align="left">
<div class="panel-atas" align="right">
	<a href="#" class="akun" style="text-decoration: none;"><svg class="ikon"	 style="width:30px;height:30px " viewBox="0 0 24 24">
    <path fill="black" d="M12,19.2C9.5,19.2 7.29,17.92 6,16C6.03,14 10,12.9 12,12.9C14,12.9 17.97,14 18,16C16.71,17.92 14.5,19.2 12,19.2M12,5A3,3 0 0,1 15,8A3,3 0 0,1 12,11A3,3 0 0,1 9,8A3,3 0 0,1 12,5M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12C22,6.47 17.5,2 12,2Z" />
</svg><span style="color:black;"><?= $username ?></span></a>
</div>
<hr style="width: 1350px; margin-left: -10px;" align="left">
</div>
<div class="logo"><br><br>
	<lu><img src="LogoHimasifo.jpg" style="width: 50px; height: 50px"></lu>
	<lu><img src="LogoUPN.png" style="width: 50px; height: 50px;"></lu>
</div>
<div class="cari">
	<input type="text" name="cari" placeholder="Cari" size="50">
</div><br><br>
<div class="cek">
	<hr style="width: 1350px; margin-left: -10px;" align="left">
	<p>Check Out</p>
	<hr align="left" style="width: 1000px;">
	<p align="right" style="margin-top: -50px;">Ringkasan Pesanan</p>
	<hr align="right" style="width: 310px; margin-top: 22px; margin-right: -8px;">
</div>
<form method="post">
		<div class="checkout">
	<table align="left" cellpadding="8" cellspacing="1" class="tabel_daftar">
		<tr align="left">
			<td>
				<p class="judul"><b>1. Informasi Pengirim</b></p>
				<input type="text" name="nama" placeholder="Nama" required="required" style="width: 200px; height: 25px;"><br><br>			
				<input type="email" name="email" placeholder="Email" required="required" style="width: 200px; height: 25px;"><br> <br>
				<input type="text" name="no_telepon" placeholder="Nomor Telepon" required="required" style="width: 200px; height: 25px;"><br> <br>
				<input type="text" name="negara" placeholder="Negara" required="required" style="width: 200px; height: 25px;"><br> <br>
				<input type="text" name="provinsi" placeholder="Provinsi" required="required" style="width: 200px; height: 25px;"><br><br>
				<input type="text" name="kota" placeholder="Kabupaten/Kota" required="required" style="width: 200px; height: 25px;"><br> <br>
				<input type="text" name="alamat" placeholder="Alamat" required="required" style="width: 200px; height: 25px;"><br> <br>
				<label>Metode Pembayaran</label><br>
				<input type="radio" name="pembayaran" value="COD" class="bayar">COD (Bayar di Tempat) <br>
				<input type="radio" name="pembayaran" value="Transfer Bank" class="bayar">Transfer Bank <br><br>
				<div class="login">
					<input type="submit" name="btn_pesanan" class="button_pesan" value="Buat Pesanan"><br><br>
					<input type="hidden" name="id_produk" value="<?php echo $id_produk; ?>">
				</div>
			</td>
		</tr>
		<tr>
			<td>
				
			</td>
		</tr>
	</table>
	</div>
	</form>

	<?php
	
      $sql = "SELECT * FROM tb_produk WHERE id_produk=$id_produk";
      $result = mysqli_query($koneksi, $sql);
      foreach ($result as $data) { 
      	$total_pembayaran = $data['harga_produk'] * $_GET['jumlah'] + $data['biaya_pengiriman'];
      	$sub_total = $data['harga_produk'] * $_GET['jumlah'];
    ?>
      <div class="ringkasan">
        <table align="right" cellpadding="10" cellspacing="3" style="background-color: #E3E0E0;">
          <th>
            
              <img src="gambar/<?php echo $data['gambar_produk'] ?>" widtd="100" height="100">
            
          </th>
          <th align="right"> 
            <td>
              <b><label>Nama Produk : </label></b>
              <?= $data['nama_produk'] ?><br>
               <b><label>Toko Produk :</label></b>
               <?= $data['nama_toko'] ?><br>
               <b><label>Jumlah Barang : </label></b><?= $_GET['jumlah'];?><br>
               <b><label>Harga Produk : </label></b><?= $data['harga_produk'] ?><br><br><br>
               <b><label> Sub Total : </label></b><?= $sub_total ?><br><br>
               <b><label>Biaya Pengiriman : </label></b>
              <?= $data['biaya_pengiriman'] ?><br>
              <hr align="right" style="width: 310px; margin-top: 22px; margin-right: -8px;"><br><br>
              <b><label>Total Pembayaran: </label></b><?= $total_pembayaran ?><br>
              
            </td>            
        </table>
        <?php 
        }
        ?>
        </div>
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
  <div class="panel-back" style="background-color: #0033E9; width: 150px;
height: 30px; border-radius: 10px;">
    <a href="home.php" style="text-decoration: none;" class="icon"><svg style="width:20px;height:20px" viewBox="0 -2 24 23">
    <path fill="#FFFFFF" d="M13.5 21H6V17H13.5C15.43 17 17 15.43 17 13.5S15.43 10 13.5 10H11V14L4 8L11 2V6H13.5C17.64 6 21 9.36 21 13.5S17.64 21 13.5 21Z" />
</svg><span style="color: #FFFFFF">Kembali Ke Home</span></a>
  </div>
	<?php
if (isset($_POST['btn_pesanan'])) {
            $nama = $_POST['nama'];
			$email = $_POST['email'];
			$no_telepon=$_POST['no_telepon'];
			$negara = $_POST['negara'];
			$provinsi = $_POST['provinsi'];
			$kota = $_POST['kota'];
			$alamat = $_POST['alamat'];
			$pembayaran = $_POST['pembayaran'];
			$id_produk = $_POST['id_produk']; 
			$_SESSION['alamat']=$alamat;
			$_SESSION['id_produk']=$id_produk;
			$_SESSION['pembayaran']=$pembayaran;
			$_SESSION['jumlah']=$jumlah;
			$query = mysqli_query($koneksi," SELECT *FROM tb_produk where id_produk='$id_produk'");
			if (mysqli_error($koneksi)) {
                echo "<script>alert('Pemesanan Gagal!');</script>";
              }else{
	              	if ($_POST['pembayaran']=="Transfer Bank") {
					$query = "INSERT INTO  tb_pemesanan SET nama='$nama', email='$email', no_telepon='$no_telepon', negara='$negara', provinsi='$provinsi', kota='$kota', alamat='$alamat',pembayaran='$pembayaran'";
					mysqli_query($koneksi, $query);
					echo "<script>alert('Pemesanan Berhasil, Lakukan Transfer!');document.location='transfer.php'</script>";
					mysqli_query($koneksi, $query);
				}else{
					$query = "INSERT INTO  tb_pemesanan SET nama='$nama', email='$email', no_telepon='$no_telepon', negara='$negara', provinsi='$provinsi', kota='$kota', alamat='$alamat',pembayaran='$pembayaran'";
					mysqli_query($koneksi, $query);
					if (is_numeric($no_telepon)== true) {
	              		echo "<script>alert('Pemesanan Berhasil, Silahkan Tunggu Pesanan Anda Sampai!');document.location='pesanan.php'</script>";
				}else{
	              if (is_numeric($no_telepon) == false) {
	                echo "<script>alert('mohon masukkan hanya angka pada kolom input kolom nomor telepon!');</script>";
	              }
	        	 }
				}
	              }
			
			}
	?>

</body>
</html>
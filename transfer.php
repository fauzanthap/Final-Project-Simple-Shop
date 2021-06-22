 <?php 
session_start();
include 'koneksi.php';
if (isset($_SESSION['status'])) {
  $username=$_SESSION['username'];
  $query = mysqli_query($koneksi,"SELECT *FROM tb_akun WHERE username='$username'");
}
?>

 <?php  
   if (isset($_POST['pesanan'])) {
     header("location: pengiriman.php");
   }
   $alamat = $_SESSION['alamat'];
    $id_produk = $_SESSION['id_produk'];
    $jumlah=$_SESSION['jumlah'];
    $pembayaran=$_SESSION['pembayaran'];
   $sql = "SELECT * FROM tb_produk WHERE id_produk = $id_produk";
   $result = mysqli_query($koneksi, $sql);
  $datatb_produk = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Transffer</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<hr>
<div class="panel-atas" align="right">
	<a href="#" class="akun"><svg class="ikon"	 style="width:30px;height:30px " viewBox="0 0 24 24">
    <path fill="black" d="M12,19.2C9.5,19.2 7.29,17.92 6,16C6.03,14 10,12.9 12,12.9C14,12.9 17.97,14 18,16C16.71,17.92 14.5,19.2 12,19.2M12,5A3,3 0 0,1 15,8A3,3 0 0,1 12,11A3,3 0 0,1 9,8A3,3 0 0,1 12,5M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12C22,6.47 17.5,2 12,2Z" />
</svg><span>Akun</span></a>
</div>
<hr> <br><br>
<div class="logo">
	<lu><img src="LogoHimasifo.jpg" style="width: 50px; height: 50px"></lu>
	<lu><img src="LogoUPN.png" style="width: 50px; height: 50px;"></lu>
</div>
<div class="cari">
	<input type="text" name="cari" placeholder="Cari" size="50">
</div>
<div class="kata">
	<p>Belanja Mudah Cepat dan Praktis</p>
</div>
<hr>
<form method="post" enctype="multipart/form-data">
	<div class="form-group">
	<table align="left" cellpadding="8" cellspacing="1">
		<tr>
			<td>
				<?php
	
      $sql2 ="SELECT * FROM tb_penjualan WHERE id_produk=$id_produk";
      $result = mysqli_query($koneksi, $sql2);
      foreach ($result as $row) {
        $penjualan=$row['hasil_penjualan'] + $jumlah;
      }
      
      $sql = "SELECT * FROM tb_produk WHERE id_produk=$id_produk";
      $result = mysqli_query($koneksi, $sql);
      foreach ($result as $data) {   
      $total_pembayaran = $data['harga_produk'] * $jumlah + $data['biaya_pengiriman'];
        $sub_total = $data['harga_produk'] * $jumlah; 
        
    }
    ?>
			<p class="judul"><b>Transfer Bank</b></p>
			<input type="text" class="form-control" name="nama_bank" placeholder="Nama Bank Anda" required="required"><br><br>
			<input type="number" class="form-control" name="no_rekening" placeholder="No Rek Anda" size="25" required="required"><br> <br>
			<input type="number" class="form-control" name="nominal" placeholder="Nominal" size="25" required="required"><label style="color: gray;">Total Pembayaran: </label><b><?= $total_pembayaran ?></b><br><br>
			<input type="number" class="form-control" name="no_rekening_tujuan" placeholder="Nomer Rek Tujuan" size="25" required="required"><t\><label style="color: gray;"> Contoh : 001234567</label><br> <br>
			</td>
		</tr>
		<tr>
			<td>
				<input type="submit" name="kirim" class="btn_transfer" value="Kirim">
				
			</td>
		</tr>
	</table>
	</div>
</form>

	<?php
if (isset($_POST['kirim'])) {
            $nama_bank = $_POST['nama_bank'];
			$no_rekening = $_POST['no_rekening'];
			$nominal = $_POST['nominal'];
			$no_rekening_tujuan=$_POST['no_rekening_tujuan'];
              $query = "INSERT INTO tb_rekening SET nama_bank='$nama_bank', no_rekening='$no_rekening', nominal='$nominal', no_rekening_tujuan='$no_rekening_tujuan'";
              mysqli_query($koneksi, $query);
              if (mysqli_error($koneksi)) {
                echo "<script>alert('Transfer Gagal dilakukan !');location.replace('pengiriman.php')</script>";
              }else {
                if ($_POST['nominal']==$total_pembayaran) {
              	echo "<script>alert('Transfer telah berhasil dilakukan!');location.replace('pesanan.php');</script>";
              }else if ($_POST['nominal']<=$total_pembayaran){
              	echo "<script>alert('Transfer Gagal Nominal Yang Anda Masukan Kurang !');location.replace('transfer.php')</script>";
              }else{
              	echo "<script>alert('Transfer telah berhasil dilakukan Uang Kembalian Anda Akan Ada Pada Saat Barang Anda di Kirim!');location.replace('pesanan.php');</script>";
              }
            }    
         }
	?>
	
</body>
</html>
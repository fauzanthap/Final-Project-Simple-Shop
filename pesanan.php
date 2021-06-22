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
  $sql2 = "SELECT * FROM tb_penjualan WHERE id_produk = $id_produk";
   $result = mysqli_query($koneksi, $sql2);
  $datatb_penjualan = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Pesanan</title>
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
  <a href="#" class="akun" style="text-decoration: none;"><svg class="ikon"  style="width:30px;height:30px " viewBox="0 0 24 24">
    <path fill="black" d="M12,19.2C9.5,19.2 7.29,17.92 6,16C6.03,14 10,12.9 12,12.9C14,12.9 17.97,14 18,16C16.71,17.92 14.5,19.2 12,19.2M12,5A3,3 0 0,1 15,8A3,3 0 0,1 12,11A3,3 0 0,1 9,8A3,3 0 0,1 12,5M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12C22,6.47 17.5,2 12,2Z" />
</svg><span style="color:black;"><?= $username ?></span></a>
</div>
<div class="logo">
	<lu><img src="LogoHimasifo.jpg" style="width: 50px; height: 50px"></lu>
	<lu><img src="LogoUPN.png" style="width: 50px; height: 50px;"></lu>
</div>
<div class="cari">
	<input type="text" name="cari" placeholder="Cari" size="50">
</div><br>
	<hr> <br>
	<div class="map">
		<p><svg style="width:20px;height:20px;" viewBox="0 0 24 24">
    <path fill="red" d="M12,11.5A2.5,2.5 0 0,1 9.5,9A2.5,2.5 0 0,1 12,6.5A2.5,2.5 0 0,1 14.5,9A2.5,2.5 0 0,1 12,11.5M12,2A7,7 0 0,0 5,9C5,14.25 12,22 12,22C12,22 19,14.25 19,9A7,7 0 0,0 12,2Z" />
</svg><span></span>Alamat Pengiriman</p>
	</div> 
	<b><h3><?= $alamat  ?></h3></b>
  <b><h2>Produk Yang diPesan</h2></b>
  <form method="post" >
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
        $sisa_stok = $data['stok'] - $jumlah;
    ?>
        <table cellpadding="10" cellspacing="3" style="background-color: #E3E0E0;" >
          <th>
              <img src="gambar/<?php echo $data['gambar_produk'] ?>" widtd="100" height="100">
          </th>
          <th align="left"> 
            <td>
              <b><label>Nama Produk : </label></b>
              <?= $data['nama_produk'] ?><br>
              <b><label>Nama Toko : </label></b>
              <?= $data['nama_toko'] ?><br>
              <b><label>Jumlah : </label></b><?= $jumlah ?><br>
               <b><label>Harga Produk : </label></b><?= $data['harga_produk'] ?><br>
               <b><label>Metode Pembayaran : </label></b><?= $pembayaran ?><br><br>
               <b><label> Sub Total : </label></b><?= $sub_total ?><br><br>
               <b><label>Biaya Pengiriman : </label></b>
              <?= $data['biaya_pengiriman'] ?><br>
              <hr align="right" style="width: 310px; margin-top: 22px; margin-right: -8px;"><br><br>
              <b><label>Total Pembayaran: </label></b><b><?= $total_pembayaran ?></b><br>
            </td>            
          </th>
       </table>
        <?php 
        }
        ?>
    <br><br><br><br>
    <table class="pilih" cellpadding="10" cellspacing="1" >
    <tr>
      <td align="center">
        <input type="submit" name="btn_batal" class="btn_batal" value="Batalkan">
      </td>
      <td align="center">
        <input type="submit" name="btn_terima" class="btn_terima" value="Pesanan di Terima">
      </td>
    </tr>
  </table>
  <?php  
  if (isset($_POST['btn_terima'])) {
    // $penjuala=$_POST['hasil_penjualan'];
    // $sisa_tok=$_POST['stok'];
  $update="UPDATE tb_penjualan set hasil_penjualan=$penjualan where id_produk='$id_produk'";
  mysqli_query($koneksi,$update);
  $update= "UPDATE tb_produk set stok='$sisa_stok' where id_produk='$id_produk'";
  mysqli_query($koneksi,$update);
  echo "<script>alert('Terimakasih Telah Berbelanja diToko Kami');document.location='home.php'</script>";
  }
  ?>

  <?php  
  if (isset($_POST['btn_batal'])) {
  echo "<script>alert('Anda Membatalkan Pesanan');document.location='home.php'</script>";
  }
  ?>
    </form>

</body>
</html>

<?php
  require "koneksi.php";
  if (isset($_GET['id_produk'])) {
    $id_produk = $_GET['id_produk'];
    $sql = "DELETE FROM tb_produk WHERE `id_produk`=$id_produk";
    mysqli_query($koneksi, $sql);
    if (mysqli_error($koneksi)) {
      echo "<script>alert('Data gagal di hapus!');</script>";
    }else {
      echo "<script>alert('Data berhasil di hapus!');location.replace('admin.php');</script>";
    }
  }
?>
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
	<title>Admin</title>
	<link rel="stylesheet" type="text/css" href="style2.css">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="bostrap.css">
	<script src="jquery.min.js"></script>
	<script src="popper.min.js"></script>
	<script src="bootstrap.min.js"></script>
</head>
<body>
	
 <div class="panel-logout">
    <a href="logout.php" style="text-decoration: none; margin-top:10px; " class="icon"><svg style="width:24px;height:24px" viewBox="0 0 24 24">
    <path fill="red" d="M14.08,15.59L16.67,13H7V11H16.67L14.08,8.41L15.5,7L20.5,12L15.5,17L14.08,15.59M19,3A2,2 0 0,1 21,5V9.67L19,7.67V5H5V19H19V16.33L21,14.33V19A2,2 0 0,1 19,21H5C3.89,21 3,20.1 3,19V5C3,3.89 3.89,3 5,3H19Z" />
</svg><span style="color: black; margin-left: -10px;">Logout</span></a>
  </div>
  <hr style="width: 1370px; margin-left: -10px; " align="left">
<div class="panel-atas" align="right">
  <a href="#" class="akun" style="text-decoration: none;"><svg class="ikon"  style="width:30px;height:30px " viewBox="0 0 24 24">
    <path fill="black" d="M12,19.2C9.5,19.2 7.29,17.92 6,16C6.03,14 10,12.9 12,12.9C14,12.9 17.97,14 18,16C16.71,17.92 14.5,19.2 12,19.2M12,5A3,3 0 0,1 15,8A3,3 0 0,1 12,11A3,3 0 0,1 9,8A3,3 0 0,1 12,5M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12C22,6.47 17.5,2 12,2Z" />
</svg><span style="color:black;"><?= $username ?></span></a>
</div>
<hr> <br><br>
<div class="logo"><br><br>
	<lu><img src="LogoHimasifo.jpg" style="width: 50px; height: 50px"></lu>
	<lu><img src="LogoUPN.png" style="width: 50px; height: 50px;">
		</lu>
	<lu>
	<a class="kata" style="color: rgba(0, 255, 148, 1);">Hari Yang Berat Untuk Orang Hebat</a>
	</lu>
	<br><br>
</div><br><br>

<div class="container">
		<h2 style="text-align: center;">Data Produk </h2>		
		<br>
		<?php 
		if(isset($_GET['alert'])){
			if($_GET['alert']=='gagal_ekstensi'){
				?>
				<div class="alert alert-warning alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					<h4><i class="icon fa fa-warning"></i> Peringatan !</h4>
					Ekstensi Tidak Diperbolehkan
				</div>	
				<?php
			}elseif($_GET['alert']=="gagal_ukuran"){
				?>		
				<div class="alert alert-warning alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					<h4><i class="icon fa fa-check"></i> Peringatan !</h4>
					Ukuran File terlalu Besar
				</div>
				<?php
			}elseif($_GET['alert']=="berhasil"){
				?>				
				<div class="alert alert-success alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					<h4><i class="icon fa fa-check"></i> Success</h4>
					Berhasil Disimpan
				</div>
				<?php
			}
		}
		?>
		<br>
		<a href="tambahproduk.php" class="btn btn-info btn-xs">Tambah Data</a>
		<br>		
		<br>		
		<table class="produk" border="1" cellpadding="3" cellspacing="3">
			<tr>
				<th width="5%">No</th>
				<th width="5%">Id Produk</th>
				<th width="20%">Nama Produk</th>
				<th width="20%">Harga</th>
				<th width="20%">Stok </th>
				<th width="60%">Deskripsi </th>
				<th width="20%">Foto</th>
				<th width="20%">Aksi</th>
				<th width="20%">Aksi</th>			
			</tr>
			 <?php
                      $sql = "SELECT * FROM tb_produk";
                      $result = mysqli_query($koneksi, $sql);
                      $number = 1;
                      foreach ($result as $data) {
                    ?>
                    <tr>
                        <td><?= $number ?></td>
                         <td><?= $data['id_produk'] ?></td>
                        <td><?= $data['nama_produk'] ?></td>
                        <td><?= $data['harga_produk'] ?></td>
                        <td><?= $data['stok'] ?></td>
                        <td><?= $data['deskripsi_produk'] ?></td>
                        <td><img src="gambar/<?php echo $data['gambar_produk'] ?>" width="100" height="100"></td>
                        <td align="center">
                            <a href="edit.php?id_produk=<?= $data['id_produk'] ?>" class="btn btn-warning btn-xs" style="color: #FFFFFF;">Edit</a>
                            
                        </td>
                        <td>
                        	<a href="admin.php?id_produk=<?= $data['id_produk'] ?>" class="btn btn-danger btn-xs">Hapus</a>
                        </td>
                    </tr>
                    <?php
                        $number++;
                      }
                    ?>
		</table>
	</div>
 
<br><br>
<p class="file">Download file rekap dalam bentuk : </p>
<a class="excel" href="downloadexcel.php" style="text-decoration: none; color: #FFFFFF; background-color: #46874D; border-color:#46874D;" >Download Excel</a>
<a class="pdf" href="downloadpdf.php" style="text-decoration: none; color: #FFFFFF; background-color: #FAA352; border-color:#FAA352;"  >Download PDF</a>

</body>
</html>


<!--- Bar Chart -->
<?php
include('koneksi.php'); //koneksi ke database
$query = mysqli_query($koneksi,"select * from tb_penjualan"); //mengambil data dari db
while($row = mysqli_fetch_array($query)){
	$nama_produk[]=$row['nama_produk'];
	$hasil_penjualan[] = $row['hasil_penjualan'];

}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Bar Chart Penjualan</title>
	<script type="text/javascript" src="Chart.js"></script> <!-- deklarasi penggunaan Chartjs -->
</head>
<body>
	<br><br><br><br>
	<div style="width: 800px;height: 800px">
		<canvas id="myChart"></canvas>
	</div>
 
 
	<script>
		var ctx = document.getElementById("myChart").getContext('2d');
		var myChart = new Chart(ctx, {
			type: 'bar',
			data: {
				labels: <?php echo json_encode($nama_produk); ?>,
				datasets: [{
					label: 'Grafik Total Penjualan Bulan Juni',
					data: <?php echo json_encode($hasil_penjualan); ?>,
					backgroundColor: 'rgba(252, 117, 255, 1)',
					borderColor: 'rgba(117, 247, 255, 1)',
					borderWidth: 2
					//warna chart
				}]
			},
			options: {
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero:true
						}
					}]
				}
			}
		});
	</script>
</body>
</html>



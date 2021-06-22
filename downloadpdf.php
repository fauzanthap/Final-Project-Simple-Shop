<!-- <?php  
// include ('koneksi.php');
// require_once("dompdf/autoload.inc.php");
// use Dompdf\Dompdf;
// $dompdf = new Dompdf();
// $query = mysqli_query($koneksi, "SELECT *FROM tb_penjualan");
// $html = '<center><h3>Daftar Nama Siswa</h3></center><br><br/><hr/><br>';
// $html .= '<table border="1" width="100%">
// <tr>
// <th>No</th>
// <th>Nama Produk</th>
// <th>Hasil Perjualan</th>
// <th>Bulan</th>
// </tr>';
// $no = 1;
// while ($row = mysqli_fetch_array($query)) 
// {
// $html .= "<tr>
// <td>".$no."</td>
// <td>".$row['nama_produk']."</td>
// <td>".$row['hasil_penjualan']."</td>
// <td>".$row['bulan']."</td>
// </tr>";
// $no++;
// }
// $html .= "<html>";
// $dompdf->loadhtml($html);
// //Setting Ukuran dan Orientasi Kertas
// $dompdf->setPaper('A4','potrait');
// //Rendering dari HTML ke PDF
// $dompdf->render();
// //Melakukan Output File PDF
// $dompdf->stream('Rekap Hasil Penjualan Bulan Juni.pdf');
?> -->

<?php  
include"koneksi.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<center>
 
		<h2>Rekap Penjualan Produk Bulan Juni</h2>
 
	</center>
 
	<?php 
	include 'koneksi.php';
	?>
 
	<table border="1" style="width: 100%">
		<tr>
			<th width="1%">No</th>
			<th>Nama Produk</th>
			<th>Hasil Penjualan</th>
			<th width="5%">Bulan</th>
		</tr>
		<?php 
		$no = 1;
		$sql = mysqli_query($koneksi,"select * from tb_penjualan");
		while($data = mysqli_fetch_array($sql)){
		?>
		<tr>
			<td><?php echo $no++; ?></td>
			<td><?php echo $data['nama_produk']; ?></td>
			<td><?php echo $data['hasil_penjualan']; ?></td>
			<td><?php echo $data['bulan']; ?></td>
		</tr>
		<?php 
		}
		?>
	</table>
 
	<script>
		window.print();
	</script>
</body>
</html>

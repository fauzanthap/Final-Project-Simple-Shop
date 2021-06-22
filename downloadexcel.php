 <?php  
 include ('koneksi.php');
 require 'vendor/autoload.php';
 use PhpOffice\PhpSpreadsheet\Spreadsheet;
 use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

 $spreadsheet = new Spreadsheet();
 $sheet = $spreadsheet -> getActiveSheet();
 $sheet -> setCellValue('A1','No');
 $sheet -> setCellValue('B1','Nama Produk');
 $sheet -> setCellValue('C1','Hasil Penjualan');
 $sheet -> setCellValue('D1','Bulan');

 $query = mysqli_query($koneksi, "SELECT *FROM tb_penjualan");
 $i = 2;
 $no = 1;
 while ($row = mysqli_fetch_array($query)) {
 $sheet -> setCellValue('A'.$i, $no++);
 $sheet -> setCellValue('B'.$i, $row['nama_produk']);
 $sheet -> setCellValue('C'.$i, $row['hasil_penjualan']);
 $sheet -> setCellValue('D'.$i, $row['bulan']);
 $i++;
 }

 $styleArray = [
 			'borders' => [
 				'allBorders'=>[
 					'borderStyle'=> \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
 				],
 			],

 		];
 $i =$i -1;
 $sheet->getStyle('A1:D'.$i)->applyFromArray($styleArray);

 $writer = new Xlsx($spreadsheet);
 $writer->save('Rekap Penjualan Bulan Juni.xlsx');
 echo "<script>alert('Silahkan Cek Rekapan Anda di File Anda Menyimpan simple_shop');document.location='admin.php'</script>";
?> 


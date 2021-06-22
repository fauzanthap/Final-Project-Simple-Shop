<?php  
$host = "localhost";
$username = "root";
$password = "";
$database = "simple_shop";

$koneksi = mysqli_connect($host,$username,$password,$database);
if (!$koneksi) {
	die("Connection Failed: ".mysqli_connect_error());
}
?>


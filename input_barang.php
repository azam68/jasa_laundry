<?php
include "koneksi.php";
$KodeBarang = $_POST['KodeBarang'];
$NmBarang = $_POST['NmBarang'];
$Stok = $_POST['Stok'];
$HargaSatuan = $_POST['HargaSatuan'];
$TglUpdateStok = $_POST['TglUpdateStok'];

$insertBarang = "INSERT INTO barang values ('$KodeBarang','$NmBarang','$Stok', '$HargaSatuan', '$TglUpdateStok')";

$insertBarang_query = mysqli_query($connect,$insertBarang);

if ($insertBarang_query)
{
	echo "Pendaftaran Berhasil!";
	header ('location:halaman_utama.php?tabel_barang=$tabel_barang');
}
else
{
	echo "Insert gagal dijalankan";
}

?>
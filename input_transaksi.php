<?php
include "koneksi.php";

// Mendapatkan data dari form
$NoTransaksi = $_POST['NoTransaksi'];
$TglTransaksi = $_POST['TglTransaksi'];
$TglAmbil = $_POST['TglAmbil'];
$KodeKonsumen = $_POST['KodeKonsumen'];
$NIK = $_POST['NIK'];

// Query untuk menambahkan data transaksi ke dalam tabel
$insertTransaksi = "INSERT INTO transaksi (NoTransaksi, TglTransaksi, TglAmbil, KodeKonsumen, NIK) VALUES ('$NoTransaksi', '$TglTransaksi', '$TglAmbil', '$KodeKonsumen', '$NIK')";

// Menjalankan query
$insertTransaksi_query = mysqli_query($connect, $insertTransaksi);

// Cek apakah query berhasil dijalankan
if ($insertTransaksi_query) {
    echo "<script>alert('Transaksi berhasil ditambahkan!'); window.location='halaman_utama.php?tabel_transaksi=$tabel_transaksi';</script>";
} else {
    echo "Insert gagal dijalankan: " . mysqli_error($connect);
}
?>

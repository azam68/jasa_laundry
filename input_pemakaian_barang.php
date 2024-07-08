<?php
// Pastikan file koneksi.php sudah di-include untuk menghubungkan ke database
include "koneksi.php";

// Ambil data dari formulir
$KodePengeluaran = $_POST['KodePengeluaran'];
$Jumlah = $_POST['Jumlah'];
$KodeBarang = $_POST['KodeBarang'];
$NIK = $_POST['NIK'];

// Query untuk menyimpan data ke dalam tabel pemakaian_barang
$query = "INSERT INTO pemakaian_barang (KodePengeluaran, Jumlah, KodeBarang, NIK) 
          VALUES ('$KodePengeluaran', '$Jumlah', '$KodeBarang', '$NIK')";

// Eksekusi query
$result = mysqli_query($connect, $query);

if ($result) {
        echo "<script>alert('Data berhasil ditambahkan!'); window.location='halaman_utama.php?tabel_pemakaian_barang=$tabel_pemakaian_barang';</script>";
    } else {
        echo "Insert gagal dijalankan: " . mysqli_error($connect);
    }
    ?>

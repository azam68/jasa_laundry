<?php
// Pastikan Anda telah memasukkan script koneksi.php yang terkoneksi dengan database di sini
include "koneksi.php";

// Periksa apakah ada data yang dikirim dari formulir
if(isset($_POST['NoRincian']) && isset($_POST['Jumlah']) && isset($_POST['NoPembelian']) && isset($_POST['KodeBarang'])) {
    // Tangkap data yang dikirimkan dari formulir
    $NoRincian = $_POST['NoRincian'];
    $Jumlah = $_POST['Jumlah'];
    $NoPembelian = $_POST['NoPembelian'];
    $KodeBarang = $_POST['KodeBarang'];

    // Query untuk menyimpan data ke dalam tabel rincian_pembelian
    $query = "INSERT INTO `rincian_pembelian` (NoRincian, Jumlah, NoPembelian, KodeBarang) VALUES ('$NoRincian', '$Jumlah', '$NoPembelian', '$KodeBarang')";

    $result = mysqli_query($connect, $query);

// Cek apakah query berhasil dijalankan
if ($result) {
    echo "<script>alert('Transaksi berhasil ditambahkan!'); window.location='halaman_utama.php?tabel_rincian_pembelian=$tabel_rincian_pembelian';</script>";
} else {
    echo "Insert gagal dijalankan: " . mysqli_error($connect);
}
}
?>
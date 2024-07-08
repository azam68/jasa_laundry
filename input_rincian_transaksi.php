<?php
// Pastikan Anda telah memasukkan script koneksi.php yang terkoneksi dengan database di sini
include "koneksi.php";

// Periksa apakah ada data yang dikirim dari formulir
if(isset($_POST['IDRincian']) && isset($_POST['Jumlah']) && isset($_POST['NoTransaksi']) && isset($_POST['IDJenisPakaian'])) {
    // Tangkap data yang dikirimkan dari formulir
    $IDRincian = $_POST['IDRincian'];
    $Jumlah = $_POST['Jumlah'];
    $NoTransaksi = $_POST['NoTransaksi'];
    $IDJenisPakaian = $_POST['IDJenisPakaian'];

    // Query untuk menyimpan data ke dalam tabel rincian_transaksi
    $query = "INSERT INTO `rincian_transaksi` (IDRincian, Jumlah, NoTransaksi, IDJenisPakaian) VALUES ('$IDRincian', '$Jumlah', '$NoTransaksi', '$IDJenisPakaian')";

    // Eksekusi query dan periksa apakah berhasil
    if(mysqli_query($connect, $query)) {
        echo "<script>alert('Transaksi berhasil ditambahkan!'); window.location='halaman_utama.php?tabel_rincian_transaksi=$tabel_rincian_transaksi';</script>";
    } else {
        echo "Insert gagal dijalankan: " . mysqli_error($connect);
    }
}
    ?>

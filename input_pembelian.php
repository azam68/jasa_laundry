<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $NoPembelian = $_POST['NoPembelian'];
    $TglPembelian = $_POST['TglPembelian'];
    $IDSupplier = $_POST['IDSupplier'];
    $NIK = $_POST['NIK'];
    
    // Validasi data
    if (!empty($NoPembelian) && !empty($TglPembelian) && !empty($IDSupplier) && !empty($NIK)) {
        // Insert data into database
        $query = "INSERT INTO pembelian (NoPembelian, TglPembelian, IDSupplier, NIK) 
                  VALUES ('$NoPembelian', '$TglPembelian', '$IDSupplier', '$NIK')";
        
        if (mysqli_query($connect, $query)) {
            echo "<script>alert('Data pembelian berhasil ditambahkan!'); window.location='halaman_utama.php?tabel_pembelian=tabel_pembelian.php';</script>";
        } else {
            echo "<script>alert('Gagal menambahkan data pembelian!'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('Semua field harus diisi!'); window.history.back();</script>";
    }
} else {
    echo "<script>alert('Invalid request method!'); window.history.back();</script>";
}
?>

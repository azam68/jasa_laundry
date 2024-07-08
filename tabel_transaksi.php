<h2>Daftar Transaksi</h2><hr color="#0263A0"><br>

<form action="halaman_utama.php?tabel_transaksi=$tabel_transaksi" method="post">
    <input type="search" name="cari" placeholder="Pencarian Data Transaksi" class="css-input" style="width:250px;" />
    <button type="submit" name="pencarian" value="Cari" class="btn" style="padding:3px; margin:6px;" width="10px;">
        <img src="animasi/search.png" height="10" width="12">
    </button>
</form>
<font size="1">Catatan: Jika mencari data dalam <u>Tanggal</u>, maka formatnya adalah <b>YYYY-MM-DD</b></font>
<br>
<br>
<!-- Tombol Tambah Transaksi -->
<?php if ($_SESSION['TypeUser'] === "admin" || $_SESSION['TypeUser'] === "operator") { ?>
<button onclick="location.href='halaman_utama.php?formulir_transaksi=formulir_transaksi.php'" class="btn" style="padding:5px 10px; margin:10px 0; border:none; cursor:pointer;">
    Tambah Transaksi
</button>
<?php } ?>
<table id="daftar-table" border='1' bordercolor="black" cellpadding='2' cellspacing='2' width='100%'>
    <tr align='center'>
        <th class="short">NO</th>
        <th class="short">NO TRANSAKSI</th>
        <th class="normal">TANGGAL TRANSAKSI</th>
        <th class="normal">TANGGAL AMBIL</th>
        <th class="normal">TOTAL</th>
        <th class="normal">KODE KONSUMEN</th>
        <th class="normal">NIK</th>
        <?php if($_SESSION['TypeUser'] !== "user") { ?>
        <th class="normal">AKSI</th>
        <?php } ?>
    </tr>
    <?php
    include "koneksi.php";

    $limit = 5; // Jumlah data per halaman
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $start = ($page - 1) * $limit;

    $tampilkan_isi = "SELECT * FROM `transaksi` LIMIT $start, $limit";
    $total_records_query = "SELECT COUNT(*) FROM `transaksi`";

    if(isset($_POST['pencarian']) && $_POST['cari'] != "") {
        $key = $_POST['cari'];
        $tampilkan_isi = "SELECT * FROM `transaksi` WHERE NoTransaksi LIKE '%$key%' OR TglTransaksi LIKE '%$key%' OR TglAmbil LIKE '%$key%' OR KodeKonsumen LIKE '%$key%' OR NIK LIKE '%$key%' LIMIT $start, $limit";
        $total_records_query = "SELECT COUNT(*) FROM `transaksi` WHERE NoTransaksi LIKE '%$key%' OR TglTransaksi LIKE '%$key%' OR TglAmbil LIKE '%$key%' OR KodeKonsumen LIKE '%$key%' OR NIK LIKE '%$key%'";
        echo "Hasil pencarian data transaksi dengan kata '$key'";
    }

    $total_records_result = mysqli_query($connect, $total_records_query);
    $total_records = mysqli_fetch_array($total_records_result)[0];
    $total_pages = ceil($total_records / $limit);

    $tampilkan_isi_sql = mysqli_query($connect, $tampilkan_isi);

    $no = $start + 1;
    while ($isi = mysqli_fetch_array($tampilkan_isi_sql)) {
        $NoTransaksi = $isi['NoTransaksi'];
        $TglTransaksi = $isi['TglTransaksi'];
        $TglAmbil = $isi['TglAmbil'];
        $TotalTransaksi = $isi['TotalTransaksi'];
        $KodeKonsumen = $isi['KodeKonsumen'];
        $NIK = $isi['NIK'];
    ?>
    <tr align='center'>
        <td><?php echo $no ?></td>
        <td><?php echo $NoTransaksi ?></td>
        <td><?php echo $TglTransaksi ?></td>
        <td><?php echo $TglAmbil ?></td>
        <td>Rp.<?php echo $TotalTransaksi ?>,-</td>
        <td><?php echo $KodeKonsumen ?></td>
        <td><?php echo $NIK ?></td>
        <?php if($_SESSION['TypeUser'] !== "user") { ?>
        <td>
            <form action="halaman_utama.php?aksi_transaksi=$aksi_transaksi" method="post">
                <input type="hidden" name="NoTransaksi" value="<?php echo $NoTransaksi; ?>">
                <input class="update" name="proses" type="submit" value="Update">
                <input class="delete" name="proses" type="submit" value="Delete" onClick="return confirm('Apakah Anda ingin menghapus transaksi dengan nomor <?php echo $NoTransaksi; ?> ?')">
            </form>
        </td>
        <?php } ?>
    </tr>
    <?php
        $no++;
    }
    ?>
</table>

<!-- Navigasi Halaman -->
<div class="pagination">
    <?php if ($page > 1) { ?>
        <a href="halaman_utama.php?tabel_transaksi=<?= $tabel_transaksi ?>&page=<?= $page - 1 ?>">Previous</a>
    <?php } ?>
    <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
        <a href="halaman_utama.php?tabel_transaksi=<?= $tabel_transaksi ?>&page=<?= $i ?>" class="<?= ($i == $page) ? 'active' : '' ?>"><?= $i ?></a>
    <?php } ?>
    <?php if ($page < $total_pages) { ?>
        <a href="halaman_utama.php?tabel_transaksi=<?= $tabel_transaksi ?>&page=<?= $page + 1 ?>">Next</a>
    <?php } ?>
</div>

<style>
.pagination a {
    color: white;
    float: left;
    padding: 8px 16px;
    text-decoration: none;
    transition: background-color .3s;
}

.pagination a.active {
    background-color: #4CAF50;
    color: black;
}

.pagination a:hover:not(.active) {
    background-color: #ddd;
}
</style>

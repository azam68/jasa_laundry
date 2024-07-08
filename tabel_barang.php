<h2>Daftar Barang</h2><hr color="#0263A0"><br>

<form action="halaman_utama.php?tabel_barang=$tabel_barang" method="post">
   <input type="search" name="cari" placeholder="Pencarian Barang" class="css-input" style="width:250px;" />
   <button type="submit" name="pencarian" value="Cari" class="btn" style="padding:3px;" margin="6px;" width="10px;"><img src="animasi/search.png" height="10" width="12"></button>
</form>
<font size="1">Catatan : Jika mencari data dalam <u>Tanggal</u>,maka formatnya adalah <b>YYYY-MM-DD</b></font>
<br>
<br>

<table id="daftar-table" border='1' bordercolor="black" cellpading='2' cellspacing='2' width='100%'>
	<tr align='center'>
    	<th class="short">NO</th>
		<th class="normal">KODE BARANG</th>
		<th class="normal">NAMA BARANG</th>
		<th class="normal">STOK</th>
		<th class="normal">HARGA SATUAN</th>
		<th class="normal">TGL UPDATE STOK</th>
        <?php 
		if($_SESSION['TypeUser']!=="user")
		{ ?>
        <th class="normal">TOOLS</th>
        <?php } ?>
	</tr>
	<?php
	include "koneksi.php";

    $limit = 5; // Jumlah data per halaman
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $start = ($page - 1) * $limit;

	$tampilkan_isi = "SELECT * FROM `barang` LIMIT $start, $limit";
	$total_records_query = "SELECT COUNT(*) FROM `barang`";

	if(isset($_POST['pencarian']) && $_POST['cari'] <> "") {
		$key = $_POST['cari'];
		$tampilkan_isi = "SELECT * FROM `barang` WHERE KodeBarang LIKE '%$key%' OR NmBarang LIKE '%$key%' OR Stok LIKE '%$key%' OR HargaSatuan LIKE '%$key%' OR TglUpdateStok LIKE '%$key%' LIMIT $start, $limit";
		$total_records_query = "SELECT COUNT(*) FROM `barang` WHERE KodeBarang LIKE '%$key%' OR NmBarang LIKE '%$key%' OR Stok LIKE '%$key%' OR HargaSatuan LIKE '%$key%' OR TglUpdateStok LIKE '%$key%'";
		echo "Hasil pencarian data barang dengan kata '$key'";
	}

	$total_records_result = mysqli_query($connect, $total_records_query);
    $total_records = mysqli_fetch_array($total_records_result)[0];
    $total_pages = ceil($total_records / $limit);

	$no = $start + 1;
	$tampilkan_isi_sql = mysqli_query($connect, $tampilkan_isi);

	while ($isi = mysqli_fetch_array($tampilkan_isi_sql)) {
		$KodeBarang = $isi['KodeBarang'];
		$NmBarang = $isi['NmBarang'];
		$Stok = $isi['Stok'];
		$HargaSatuan = $isi['HargaSatuan'];
		$TglUpdateStok = $isi['TglUpdateStok'];
	?>
	<tr align='center'> 
    	<td><?php echo $no ?></td>
		<td><?php echo $KodeBarang ?></td> 
		<td><?php echo $NmBarang ?></td> 
		<td><?php echo $Stok ?></td> 
		<td>Rp.<?php echo $HargaSatuan ?>,-</td>
		<td><?php echo $TglUpdateStok ?></td>
        <?php 
		if($_SESSION['TypeUser']!=="user")
		{ ?>
        <td>
            <form action="halaman_utama.php?aksi_barang=$aksi_barang" method="post">
            <input type="hidden" name="KodeBarang" value="<?php echo $KodeBarang; ?>">
            <input class="update" name="proses" type="submit" value="Update">
            <input class="delete" name="proses" type="submit" value="Delete" onClick ="return confirm('Apakah Anda ingin menghapus barang <?php echo $NmBarang; ?> ?')">
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
        <a href="halaman_utama.php?tabel_barang=<?= $tabel_barang ?>&page=<?= $page - 1 ?>">Previous</a>
    <?php } ?>
    <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
        <a href="halaman_utama.php?tabel_barang=<?= $tabel_barang ?>&page=<?= $i ?>" class="<?= ($i == $page) ? 'active' : '' ?>"><?= $i ?></a>
    <?php } ?>
    <?php if ($page < $total_pages) { ?>
        <a href="halaman_utama.php?tabel_barang=<?= $tabel_barang ?>&page=<?= $page + 1 ?>">Next</a>
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

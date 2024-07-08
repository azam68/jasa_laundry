<h2>Daftar Pemakaian Barang</h2><hr color="#0263A0"><br>

<form action="halaman_utama.php?tabel_pemakaian_barang=$tabel_pemakaian_barang" method="post">
   <input type="search" name="cari" placeholder="Pencarian Data Pemakaian Barang" class="css-input" style="width:250px;" />
   <button type="submit" name="pencarian" value="Cari" class="btn" style="padding:3px;" margin="6px;" width="10px;"><img src="animasi/search.png" height="10" width="12"></button>
</form>
<br>
<?php if ($_SESSION['TypeUser'] === "admin" || $_SESSION['TypeUser'] === "operator") { ?>
<form action="halaman_utama.php?formulir_pemakaian_barang=<?= $formulir_pemakaian_barang ?>" method="post">
   <button type="submit" class="btn" style="padding:5px 10px; margin:10px 0;">Tambah</button>
</form>
<?php } ?>
<table id="daftar-table" border='1' bordercolor="black" cellpading='2' cellspacing='2' width='100%'>
	<tr align='center'>
    	<th class="short">NO</th>
		<th class="normal">KODE PENGELUARAN</th>
		<th class="normal">JUMLAH</th>
		<th class="normal">KODE BARANG</th>
		<th class="normal">NIK</th>
        <?php 
		if($_SESSION['TypeUser']!=="user")
		{ ?>
        <th class="normal">TOOLS</th>
        <?php } ?>
	</tr>
	<?php
	include "koneksi.php";

    $limit = 10; // Jumlah data per halaman
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $start = ($page - 1) * $limit;

	$tampilkan_isi = "SELECT * FROM `pemakaian_barang` LIMIT $start, $limit";
	$total_records_query = "SELECT COUNT(*) FROM `pemakaian_barang`";

	if(isset($_POST['pencarian']) && $_POST['cari'] <> "") {
		$key = $_POST['cari'];
		$tampilkan_isi = "SELECT * FROM `pemakaian_barang` WHERE KodePengeluaran LIKE '%$key%' OR Jumlah LIKE '%$key%' OR KodeBarang LIKE '%$key%' OR NIK LIKE '%$key%' LIMIT $start, $limit";
		$total_records_query = "SELECT COUNT(*) FROM `pemakaian_barang` WHERE KodePengeluaran LIKE '%$key%' OR Jumlah LIKE '%$key%' OR KodeBarang LIKE '%$key%' OR NIK LIKE '%$key%'";
		echo "Hasil pencarian data pemakaian barang dengan kata '$key'";
	}

	$total_records_result = mysqli_query($connect, $total_records_query);
    $total_records = mysqli_fetch_array($total_records_result)[0];
    $total_pages = ceil($total_records / $limit);

	$no = $start + 1;
	$tampilkan_isi_sql = mysqli_query($connect, $tampilkan_isi);

	while ($isi = mysqli_fetch_array($tampilkan_isi_sql)) {
		$KodePengeluaran = $isi['KodePengeluaran'];
		$Jumlah = $isi['Jumlah'];
		$KodeBarang = $isi['KodeBarang'];
		$NIK = $isi['NIK'];
	?>
	<tr align='center'> 
    	<td><?php echo $no ?></td>
		<td><?php echo $KodePengeluaran ?></td> 
		<td><?php echo $Jumlah ?></td> 
		<td><?php echo $KodeBarang ?></td> 
		<td><?php echo $NIK ?></td>
        <?php 
		if($_SESSION['TypeUser']!=="user")
		{ ?> 
        <td>
            <form action="halaman_utama.php?aksi_pemakaian_barang=$aksi_pemakaian_barang" method="post">
            <input type="hidden" name="KodePengeluaran" value="<?php echo $KodePengeluaran; ?>">
            <input class="update" name="proses" type="submit" value="Update">
            <input class="delete" name="proses" type="submit" value="Delete" onClick ="return confirm('Apakah Anda ingin menghapus data pemakaian barang no <?php echo $KodePengeluaran; ?> ?')">
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
        <a href="halaman_utama.php?tabel_pemakaian_barang=<?= $tabel_pemakaian_barang ?>&page=<?= $page - 1 ?>">Previous</a>
    <?php } ?>
    <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
        <a href="halaman_utama.php?tabel_pemakaian_barang=<?= $tabel_pemakaian_barang ?>&page=<?= $i ?>" class="<?= ($i == $page) ? 'active' : '' ?>"><?= $i ?></a>
    <?php } ?>
    <?php if ($page < $total_pages) { ?>
        <a href="halaman_utama.php?tabel_pemakaian_barang=<?= $tabel_pemakaian_barang ?>&page=<?= $page + 1 ?>">Next</a>
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

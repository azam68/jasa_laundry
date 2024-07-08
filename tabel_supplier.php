<h2>Daftar Supplier</h2><hr color="#0263A0"><br>

<form action="halaman_utama.php?tabel_supplier=$tabel_supplier" method="post">
   <input type="search" name="cari" placeholder="Pencarian Data Supplier" class="css-input" style="width:250px;" />
   <button type="submit" name="pencarian" value="Cari" class="btn" style="padding:3px;" margin="6px;" width="10px;"><img src="animasi/search.png" height="10" width="12"></button>
</form>
<br>

<table id="daftar-table" border='1' bordercolor="black" cellpading='2' cellspacing='2' width='100%'>
	<tr align='center'>
    	<th class="short">NO</th>
		<th class="normal">ID SUPPLIER</th>
		<th class="normal">NAMA SUPPLIER</th>
		<th class="normal">ALAMAT SUPPLIER</th>
		<th class="normal">NO.HANDPHONE</th>
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

	$tampilkan_isi = "SELECT * FROM `supplier` LIMIT $start, $limit";
	$total_records_query = "SELECT COUNT(*) FROM `supplier`";

	if(isset($_POST['pencarian']) and $_POST['cari'] <> "")
	{
		$key = $_POST['cari'];
		$tampilkan_isi = "SELECT * FROM `supplier` WHERE IDSupplier LIKE '%$key%' OR NmSupplier LIKE '%$key%' OR AlmtSupplier LIKE '%$key%' OR TelpSupplier LIKE '%$key%' LIMIT $start, $limit";
		$total_records_query = "SELECT COUNT(*) FROM `supplier` WHERE IDSupplier LIKE '%$key%' OR NmSupplier LIKE '%$key%' OR AlmtSupplier LIKE '%$key%' OR TelpSupplier LIKE '%$key%'";
		echo "Pencarian data supplier dengan kata '$key'";
	}

	$total_records_result = mysqli_query($connect, $total_records_query);
    $total_records = mysqli_fetch_array($total_records_result)[0];
    $total_pages = ceil($total_records / $limit);

	$no = $start + 1;
	$tampilkan_isi_sql = mysqli_query($connect, $tampilkan_isi);

	while ($isi = mysqli_fetch_array($tampilkan_isi_sql))
	{
		$IDSupplier = $isi['IDSupplier'];
		$NmSupplier = $isi['NmSupplier'];
		$AlmtSupplier = $isi['AlmtSupplier'];
		$TelpSupplier = $isi['TelpSupplier'];
	?>
	<tr align='center'> 
    	<td><?php echo $no ?></td> 
		<td><?php echo $IDSupplier ?></td> 
		<td><?php echo $NmSupplier ?></td> 
		<td><?php echo $AlmtSupplier ?></td> 
		<td><?php echo $TelpSupplier ?></td> 
        <?php 
		if($_SESSION['TypeUser']!=="user")
		{ ?>
        <td>
            <form action="halaman_utama.php?aksi_supplier=$aksi_supplier" method="post">
            <input type="hidden" name="IDSupplier" value="<?php echo $IDSupplier; ?>">
            <input class="update" name="proses" type="submit" value="Update">
            <input class="delete" name="proses" type="submit" value="Delete" onClick ="return confirm('Apakah Anda ingin menghapus data supplier <?php echo $NmSupplier; ?> ?')">
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
        <a href="halaman_utama.php?tabel_supplier=<?= $tabel_supplier ?>&page=<?= $page - 1 ?>">Previous</a>
    <?php } ?>
    <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
        <a href="halaman_utama.php?tabel_supplier=<?= $tabel_supplier ?>&page=<?= $i ?>" class="<?= ($i == $page) ? 'active' : '' ?>"><?= $i ?></a>
    <?php } ?>
    <?php if ($page < $total_pages) { ?>
        <a href="halaman_utama.php?tabel_supplier=<?= $tabel_supplier ?>&page=<?= $page + 1 ?>">Next</a>
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

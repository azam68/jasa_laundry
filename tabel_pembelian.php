<h2>Daftar Data Pembelian</h2>
<hr color="#0263A0"><br>

<form action="halaman_utama.php?tabel_pembelian=$tabel_pembelian" method="post">
   <input type="search" name="cari" placeholder="Pencarian Data Pembelian" class="css-input" style="width:250px;" />
   <button type="submit" name="pencarian" value="Cari" class="btn" style="padding:3px;" margin="6px;" width="10px;">
      <img src="animasi/search.png" height="10" width="12">
   </button>
</form>
<font size="1">Catatan : Jika mencari data dalam <u>Tanggal</u>, maka formatnya adalah <b>YYYY-MM-DD</b></font>
<br>
<br>

<?php if ($_SESSION['TypeUser'] === "admin" || $_SESSION['TypeUser'] === "operator") { ?>
<form action="halaman_utama.php?formulir_pembelian=<?= $formulir_pembelian ?>" method="post">
   <button type="submit" class="btn" style="padding:5px 10px; margin:10px 0;">Tambah Pembelian</button>
</form>
<?php } ?>

<table id="daftar-table" border='1' bordercolor="black" cellpadding='2' cellspacing='2' width='100%'>
   <tr align='center'>
      <th class="short">NO</th>
      <th class="normal">NO PEMBELIAN</th>
      <th class="normal">TGL PEMBELIAN</th>
      <th class="normal">TOTAL</th>
      <th class="normal">ID SUPPLIER</th>
      <th class="normal">NIK</th>
      <?php if ($_SESSION['TypeUser'] !== "user") { ?>
      <th class="normal">TOOLS</th>
      <?php } ?>
   </tr>
   <?php
   include "koneksi.php";

   $limit = 5; // Jumlah data per halaman
   $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
   $start = ($page - 1) * $limit;

   $tampilkan_isi = "SELECT * FROM `pembelian` LIMIT $start, $limit";
   $total_records_query = "SELECT COUNT(*) FROM `pembelian`";

   if (isset($_POST['pencarian']) && $_POST['cari'] != "") {
      $key = $_POST['cari'];
      $tampilkan_isi = "SELECT * FROM `pembelian` WHERE NoPembelian LIKE '%$key%' OR TotalBiaya LIKE '%$key%' OR IDSupplier LIKE '%$key%' OR NIK LIKE '%$key%' LIMIT $start, $limit";
      $total_records_query = "SELECT COUNT(*) FROM `pembelian` WHERE NoPembelian LIKE '%$key%' OR TotalBiaya LIKE '%$key%' OR IDSupplier LIKE '%$key%' OR NIK LIKE '%$key%'";
      echo "Hasil pencarian data pembelian dengan kata '$key'";
   }

   $total_records_result = mysqli_query($connect, $total_records_query);
   $total_records = mysqli_fetch_array($total_records_result)[0];
   $total_pages = ceil($total_records / $limit);

   $tampilkan_isi_sql = mysqli_query($connect, $tampilkan_isi);

   $no = $start + 1;
   while ($isi = mysqli_fetch_array($tampilkan_isi_sql)) {
      $NoPembelian = $isi['NoPembelian'];
      $TglPembelian = $isi['TglPembelian'];
      $TotalBiaya = $isi['TotalBiaya'];
      $IDSupplier = $isi['IDSupplier'];
      $NIK = $isi['NIK'];
   ?>
      <tr align='center'>
         <td><?php echo $no ?></td>
         <td><?php echo $NoPembelian ?></td>
         <td><?php echo $TglPembelian ?></td>
         <td>Rp.<?php echo $TotalBiaya ?>,-</td>
         <td><?php echo $IDSupplier ?></td>
         <td><?php echo $NIK ?></td>
         <?php if ($_SESSION['TypeUser'] !== "user") { ?>
         <td>
            <form action="halaman_utama.php?aksi_pembelian=$aksi_pembelian" method="post">
               <input type="hidden" name="NoPembelian" value="<?php echo $NoPembelian; ?>">
               <input class="update" name="proses" type="submit" value="Update">
               <input class="delete" name="proses" type="submit" value="Delete" onClick="return confirm('Apakah Anda ingin menghapus data pembelian <?php echo $NoPembelian; ?> ?')">
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
        <a href="halaman_utama.php?tabel_pembelian=<?= $tabel_pembelian ?>&page=<?= $page - 1 ?>">Previous</a>
    <?php } ?>
    <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
        <a href="halaman_utama.php?tabel_pembelian=<?= $tabel_pembelian ?>&page=<?= $i ?>" class="<?= ($i == $page) ? 'active' : '' ?>"><?= $i ?></a>
    <?php } ?>
    <?php if ($page < $total_pages) { ?>
        <a href="halaman_utama.php?tabel_pembelian=<?= $tabel_pembelian ?>&page=<?= $page + 1 ?>">Next</a>
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

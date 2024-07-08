<h2>Daftar Tarif</h2><hr color="#0263A0"><br>

<form action="halaman_utama.php?tabel_tarif=$tabel_tarif" method="post">
   <input type="search" name="cari" placeholder="Pencarian Tarif" class="css-input" style="width:250px;" />
   <button type="submit" name="pencarian" value="Cari" class="btn" style="padding:3px;" margin="6px;" width="10px;">
       <img src="animasi/search.png" height="10" width="12">
   </button>
</form>

<br>

<table id="daftar-table" border='1' bordercolor="black" cellpadding='2' cellspacing='2' width='100%'>
    <tr align='center'>
        <th class="short">NO</th>
        <th class="normal">ID JENIS PAKAIAN</th>
        <th class="normal">NAMA PAKAIAN</th>
        <th class="normal">JENIS LAUNDRY</th>
        <th class="normal">TARIF</th>
        <?php if ($_SESSION['TypeUser'] !== "user") { ?>
            <th class="normal">TOOLS</th>
        <?php } ?>
    </tr>
    <?php
    include "koneksi.php";

    $limit = 10; // Jumlah data per halaman
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $start = ($page - 1) * $limit;

    $tampilkan_isi = "SELECT t.IDJenisPakaian, t.NmPakaian, jl.NmJenisLaundry, t.tarif 
                      FROM tarif t
                      INNER JOIN jenis_laundry jl
                      ON t.IDJenisLaundry = jl.IDJenisLaundry
                      LIMIT $start, $limit";
    $total_records_query = "SELECT COUNT(*) FROM tarif";

    if (isset($_POST['pencarian']) && $_POST['cari'] != "") {
        $key = $_POST['cari'];
        $tampilkan_isi = "SELECT t.IDJenisPakaian, t.NmPakaian, jl.NmJenisLaundry, t.tarif 
                          FROM tarif t
                          INNER JOIN jenis_laundry jl
                          ON t.IDJenisLaundry = jl.IDJenisLaundry 
                          WHERE t.NmPakaian LIKE '%$key%' 
                          LIMIT $start, $limit";
        $total_records_query = "SELECT COUNT(*) 
                                FROM tarif t
                                INNER JOIN jenis_laundry jl
                                ON t.IDJenisLaundry = jl.IDJenisLaundry 
                                WHERE t.NmPakaian LIKE '%$key%'";
        echo "Pencarian data tarif dengan kata '$key'";
    }

    $total_records_result = mysqli_query($connect, $total_records_query);
    $total_records = mysqli_fetch_array($total_records_result)[0];
    $total_pages = ceil($total_records / $limit);

    $tampilkan_isi_sql = mysqli_query($connect, $tampilkan_isi);

    $no = $start + 1;
    while ($isi = mysqli_fetch_array($tampilkan_isi_sql)) {
        $IDJenisPakaian = $isi['IDJenisPakaian'];
        $NmPakaian = $isi['NmPakaian'];
        $NmJenisLaundry = $isi['NmJenisLaundry'];
        $tarif = $isi['tarif'];
    ?>
        <tr align='center'>
            <td><?php echo $no ?></td>
            <td><?php echo $IDJenisPakaian ?></td>
            <td><?php echo $NmPakaian ?></td>
            <td><?php echo $NmJenisLaundry ?></td>
            <td>Rp.<?php echo $tarif ?>,-</td>
            <?php if ($_SESSION['TypeUser'] !== "user") { ?>
                <td>
                    <form action="halaman_utama.php?aksi_tarif=$aksi_tarif" method="post">
                        <input type="hidden" name="IDJenisPakaian" value="<?php echo $IDJenisPakaian; ?>">
                        <input class="update" name="proses" type="submit" value="Update">
                        <input class="delete" name="proses" type="submit" value="Delete" onClick="return confirm('Apakah Anda ingin menghapus data tarif <?php echo $NmJenisLaundry;?> <?php echo $NmPakaian; ?> ?')">
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
        <a href="halaman_utama.php?tabel_tarif=<?= $tabel_tarif ?>&page=<?= $page - 1 ?>">Previous</a>
    <?php } ?>
    <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
        <a href="halaman_utama.php?tabel_tarif=<?= $tabel_tarif ?>&page=<?= $i ?>" class="<?= ($i == $page) ? 'active' : '' ?>"><?= $i ?></a>
    <?php } ?>
    <?php if ($page < $total_pages) { ?>
        <a href="halaman_utama.php?tabel_tarif=<?= $tabel_tarif ?>&page=<?= $page + 1 ?>">Next</a>
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

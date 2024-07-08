<h2>Form Penambahan Transaksi</h2>
<hr color="#0263A0">
<br>

<form action="input_transaksi.php" method="POST">
    <table>
        <tr>
            <td>No Transaksi</td>
        </tr>
        <tr>
            <td><input type="text" name="NoTransaksi" size="25px" maxlength="10" placeholder="ketikkan nomor transaksi.."></td>
        </tr>
        
        <tr>
            <td>Tanggal Transaksi</td>
        </tr>
        <tr>
            <td><input type="date" name="TglTransaksi" size="25px"></td>
        </tr>
        
        <tr>
            <td>Tanggal Ambil</td>
        </tr>
        <tr>
            <td><input type="date" name="TglAmbil" size="25px"></td>
        </tr>
        
        <tr>
            <td>Kode Konsumen</td>
        </tr>
        <tr>
            <td>
                <select name="KodeKonsumen" size="1">
                    <option value="">Pilih Kode Konsumen</option>
                    <?php
                    // Menghubungkan ke database
                    $servername = "localhost";  // Ganti dengan nama host Anda
                    $username = "root";         // Ganti dengan username database Anda
                    $password = "";             // Ganti dengan password database Anda
                    $dbname = "jasa_laundry";  // Ganti dengan nama database Anda

                    // Membuat koneksi
                    $conn = new mysqli($servername, $username, $password, $dbname);

                    // Memeriksa koneksi
                    if ($conn->connect_error) {
                        die("Koneksi gagal: " . $conn->connect_error);
                    }

                    // Mengambil data kode_konsumen dari tabel konsumen
                    $sql = "SELECT kodekonsumen FROM konsumen";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        // Output data setiap baris
                        while($row = $result->fetch_assoc()) {
                            echo '<option value="' . $row["kodekonsumen"] . '">' . $row["kodekonsumen"] . '</option>';
                        }
                    } else {
                        echo '<option value="">Tidak ada konsumen tersedia</option>';
                    }
                    ?>
                </select>
            </td>
        </tr>
        
        <tr>
            <td>NIK</td>
        </tr>
        <tr>
            <td>
                <select name="NIK" size="1">
                    <option value="">Pilih NIK</option>
                    <?php
                    // Mengambil data NIK dari tabel karyawan
                    $sql = "SELECT NIK FROM karyawan";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        // Output data setiap baris
                        while($row = $result->fetch_assoc()) {
                            echo '<option value="' . $row["NIK"] . '">' . $row["NIK"] . '</option>';
                        }
                    } else {
                        echo '<option value="">Tidak ada karyawan tersedia</option>';
                    }

                    // Menutup koneksi
                    $conn->close();
                    ?>
                </select>
            </td>
        </tr>
        
        <tr>
            <td><br><input class="tombol" type="submit" value="Tambah"></td>
        </tr>
    </table>
</form>
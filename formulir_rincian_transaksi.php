<h2>Formulir Rincian Transaksi</h2>
<hr color="#0263A0">
<br>

<form action="input_rincian_transaksi.php" method="POST">
    <table>
        <tr>
            <td>ID Rincian</td>
        </tr>
        <tr>
            <td><input type="text" name="IDRincian" size="25px" maxlength="10" placeholder="Ketikkan ID rincian.."></td>
        </tr>
        
        <tr>
            <td>Jumlah</td>
        </tr>
        <tr>
            <td><input type="text" name="Jumlah" size="25px" placeholder="Ketikkan jumlah.."></td>
        </tr>
        
        <tr>
            <td>No Transaksi</td>
        </tr>
        <tr>
            <td>
                <select name="NoTransaksi" size="1">
                    <option value="">Pilih Nomor Transaksi</option>
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

                    // Mengambil data no_transaksi dari tabel transaksi
                    $sql = "SELECT notransaksi FROM transaksi";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        // Output data setiap baris
                        while($row = $result->fetch_assoc()) {
                            echo '<option value="' . $row["notransaksi"] . '">' . $row["notransaksi"] . '</option>';
                        }
                    } else {
                        echo '<option value="">Tidak ada transaksi tersedia</option>';
                    }
                    ?>
                </select>
            </td>
        </tr>
        
        <tr>
            <td>ID Jenis Pakaian</td>
        </tr>
        <tr>
            <td>
                <select name="IDJenisPakaian" size="1">
                    <option value="">Pilih Jenis Pakaian</option>
                    <?php
                    // Mengambil data id_jenis_pakaian dari tabel tarif
                    $sql = "SELECT idjenispakaian FROM tarif";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        // Output data setiap baris
                        while($row = $result->fetch_assoc()) {
                            echo '<option value="' . $row["idjenispakaian"] . '">' . $row["idjenispakaian"] . '</option>';
                        }
                    } else {
                        echo '<option value="">Tidak ada jenis pakaian tersedia</option>';
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

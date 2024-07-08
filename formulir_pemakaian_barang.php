<h2>Formulir Pendaftaran Pemakaian Barang</h2>
<hr color="#0263A0">
<br>

<form action="input_pemakaian_barang.php" method="POST">
    <table>
        <tr>
            <td>Kode Pengeluaran</td>
        </tr>
        <tr>
            <td><input type="text" name="KodePengeluaran" size="25px" maxlength="10" placeholder="Ketikkan kode pengeluaran.."></td>
        </tr>
        
        <tr>
            <td>Jumlah</td>
        </tr>
        <tr>
            <td><input type="number" name="Jumlah" size="25px" placeholder="Ketikkan jumlah.."></td>
        </tr>
        
        <tr>
            <td>Kode Barang</td>
        </tr>
        <tr>
            <td>
                <select name="KodeBarang" size="1">
                    <option value="">Pilih Kode Barang</option>
                    <?php
                    // Koneksi ke database
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

                    // Mengambil data Kode Barang dari tabel barang
                    $sql = "SELECT KodeBarang FROM barang";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        // Output data setiap baris
                        while($row = $result->fetch_assoc()) {
                            echo '<option value="' . $row["KodeBarang"] . '">' . $row["KodeBarang"] . '</option>';
                        }
                    } else {
                        echo '<option value="">Tidak ada barang tersedia</option>';
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
                    // Koneksi ke database (bisa menggunakan koneksi yang sama)
                    $conn = new mysqli($servername, $username, $password, $dbname);

                    // Memeriksa koneksi
                    if ($conn->connect_error) {
                        die("Koneksi gagal: " . $conn->connect_error);
                    }

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


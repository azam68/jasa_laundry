<h2>Formulir Rincian Pembelian</h2>
<hr color="#0263A0">
<br>

<form action="input_rincian_pembelian.php" method="POST">
    <table>
        <tr>
            <td>No Rincian</td>
        </tr>
        <tr>
            <td><input type="text" name="NoRincian" size="25px" maxlength="10" placeholder="Ketikkan nomor rincian.."></td>
        </tr>
        
        <tr>
            <td>Jumlah</td>
        </tr>
        <tr>
            <td><input type="text" name="Jumlah" size="25px" placeholder="Ketikkan jumlah.."></td>
        </tr>
        
        <tr>
            <td>No Pembelian</td>
        </tr>
        <tr>
            <td>
                <select name="NoPembelian" size="1">
                    <option value="">Pilih Nomor Pembelian</option>
                    <?php
                    // Koneksi ke database (gunakan koneksi yang sudah dibuat)
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

                    // Mengambil data No Pembelian dari tabel pembelian
                    $sql = "SELECT NoPembelian FROM pembelian";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        // Output data setiap baris
                        while($row = $result->fetch_assoc()) {
                            echo '<option value="' . $row["NoPembelian"] . '">' . $row["NoPembelian"] . '</option>';
                        }
                    } else {
                        echo '<option value="">Tidak ada pembelian tersedia</option>';
                    }
                    ?>
                </select>
            </td>
        </tr>
        
        <tr>
            <td>Kode Barang</td>
        </tr>
        <tr>
            <td>
                <select name="KodeBarang" size="1">
                    <option value="">Pilih Kode Barang</option>
                    <?php
                    // Koneksi ke database (gunakan koneksi yang sudah dibuat)
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

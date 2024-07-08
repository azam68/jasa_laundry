<h2>Form Pendaftaran Pembelian</h2>
<hr color="#0263A0"><br>

<form action="input_pembelian.php" method="POST">
    <table>
        <tr>
            <td>No Pembelian</td>
        </tr>
        <tr>
            <td><input type="text" name="NoPembelian" size="25px" maxlength="10" placeholder="Ketikkan nomor pembelian.."></td>
        </tr>
        
        <tr>
            <td>Tanggal Pembelian</td>
        </tr>
        <tr>
            <td><input type="date" name="TglPembelian" size="25px"></td>
        </tr>
        
        <tr>
            <td>ID Supplier</td>
        </tr>
        <tr>
            <td>
                <select name="IDSupplier" size="1">
                    <option value="">Pilih ID Supplier</option>
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

                    // Mengambil data ID Supplier dari tabel supplier
                    $sql = "SELECT IDSupplier FROM supplier";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        // Output data setiap baris
                        while($row = $result->fetch_assoc()) {
                            echo '<option value="' . $row["IDSupplier"] . '">' . $row["IDSupplier"] . '</option>';
                        }
                    } else {
                        echo '<option value="">Tidak ada supplier tersedia</option>';
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

<?php
// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "tugas_kpw");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Cek apakah ada parameter pencarian (search) di URL
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Query SQL untuk mengambil data, dengan filter pencarian jika ada
if ($search) {
    // Jika ada pencarian, cari berdasarkan nama
    $sql = "SELECT * FROM daftar WHERE name LIKE '%$search%'";
} else {
    // Jika tidak ada pencarian, tampilkan semua data
    $sql = "SELECT * FROM daftar";
}

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="asset/style1.css">
    <title>Registrasi</title>
</head>
<body>
    <div class="container">
        <h2>Daftar User</h2>
        <a href="create.php" class="btn">Tambah Pendaftaran</a>
        
        <!-- Search Form -->
        <form action="" method="GET" class="search">
            <input type="text" name="search" placeholder="Cari berdasarkan nama..." autocomplete="off" value="<?php echo htmlspecialchars($search); ?>">
            <button type="submit" class="cari">Cari</button>
        </form>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Telepon</th>
                        <th>Jenis Kelamin</th>
                        <th>Cabang Olahraga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>" . $row["id"] . "</td>
                                    <td>" . $row["name"] . "</td>
                                    <td>" . $row["email"] . "</td>
                                    <td>" . $row["no_Hp"] . "</td>
                                    <td>" . $row["jenis_kelamin"] . "</td>
                                    <td>" . $row["cabang_olahraga"] . "</td>
                                    <td>
                                        <a href='update.php?id=" . $row["id"] . "' class='btn-edit'>Edit</a>
                                        <a href='delete.php?id=" . $row["id"] . "' class='btn-delete'>Hapus</a>
                                    </td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>Tidak ada data yang ditemukan</td></tr>";
                    }
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
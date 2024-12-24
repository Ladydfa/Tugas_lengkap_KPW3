<?php
// 1. Membuat koneksi ke database
$conn = new mysqli("localhost", "root", "", "crud_db");

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// 2. Memeriksa apakah ada ID yang dikirim melalui URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // 3. Mengambil data pengguna berdasarkan ID
    $sql = "SELECT * FROM pendaftar WHERE id=$id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        //4. Menghindari tanda < muncul di form
        $name = htmlspecialchars($row['name']);
        $email = htmlspecialchars($row['email']);
        $phone = htmlspecialchars($row['phone']);
        ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #ffe6f2;
            margin: 0;
        }
        form {
            background-color: #fff0f5;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            width: 350px;
        }
        form h2 {
            text-align: center;
            color: #e60073;
            margin-bottom: 20px;
        }
        label {
            color: #d147a3;
            font-weight: bold;
        }
        input[type="text"], input[type="email"] {
            width: 100%;
            padding: 10px;
            margin: 12px 0;
            border: 1px solid #ffb3cc;
            border-radius: 5px;
            box-sizing: border-box;
            transition: all 0.3s ease;
        }
        input[type="text"]:focus, input[type="email"]:focus {
            border-color: #ff66b2;
            outline: none;
        }
        button {
            width: 100%;
            padding: 12px;
            background-color: #ff66b2;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #e60073;
        }
    </style>
</head>
<body>
    <form method="POST" action="">
        <h2>Edit User</h2>
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        
        <label for="name">Nama:</label>
        <input type="text" id="name" name="name" value="<?php echo $name; ?>" required><br>
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo $email; ?>" required><br>
        
        <label for="phone">Telepon:</label>
        <input type="text" id="phone" name="phone" value="<?php echo $phone; ?>" required><br>
        
        <button type="submit">Update</button>
    </form>
</body>
</html>
        <?php
    }
}

// 5. Memproses data dari formulir jika tombol submit ditekan
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    // 6. Memperbarui data pengguna di database
    $sql = "UPDATE users SET name='$name', email='$email', phone='$phone' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

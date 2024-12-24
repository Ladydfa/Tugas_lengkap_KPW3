<?php

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];

    // Koneksi database
    $conn = new mysqli("localhost","root", "","tugas_kpw");
    if($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }

    // Fungsi input data
    $sql = "INSERT INTO daftar (name, email, no_Hp, jenis_kelamin, cabang_olahraga ) VALUES ('$name','$email','$no_Hp','$jenis_kelamin','$cabang_olahraga')";

    // Jika data berhasil diinput, kembali ke halaman index.php; jika tidak, tampilkan error
    if($conn->query($sql) === TRUE){
        header("Location: index.php");
    } else {
        echo "Error: " . htmlspecialchars($sql) . "<br>" . htmlspecialchars($conn->error);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Input</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #ffe6f0;
            margin: 0;
        }
        form {
            background-color: #fff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
            width: 320px;
            border: 2px solid #ff99cc;
        }
        h2 {
            text-align: center;
            color: #ff66a3;
            font-size: 24px;
            margin-bottom: 20px;
        }
        label {
            color: #ff66a3;
            font-weight: bold;
        }
        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin: 12px 0 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }
        button {
            width: 100%;
            padding: 12px;
            background-color: #ff66a3;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #ff4d94;
        }
    </style>
</head>
<body>
    <form action="" method="post">
        <h2>Form Input</h2>
        <label for="name">Nama:</label>
        <input type="text" id="name" name="name" required>
        
        <label for="email">Email:</label>
        <input type="text" id="email" name="email" required>
        
        <label for="no_Hp">Telepon:</label>
        <input type="text" id="no_Hp" name="no_Hp" required>

        
    
        <button type="submit">Save</button>
    </form>
</body>
</html>


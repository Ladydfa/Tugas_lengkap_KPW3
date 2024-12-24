<?php
include "../tabelPendaftaran/koneksi.php";

session_start();


if ($_SERVER["REQUEST_METHOD"]== "POST"){
    $username = $_POST['username'];
    $password = $_POST['password'];

    //Query untuk mencari user berdasarkan username
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result ->fetch_assoc();

        //banding password dengan username
        if($password == $user['password']){
            $_SESSION['username'] = $username;
            echo "Berhasil Login";
            header("Location:../tabelPendaftaran/index.php");
            exit;
        }else {
            echo "Password salah";
        }
    }else{
        echo "Username tidak terdaftar";
    }
    $stmt->close();

}
$conn->close();
?>
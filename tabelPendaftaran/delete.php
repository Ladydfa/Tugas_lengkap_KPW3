<?php
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $conn = new mysqli("localhost","root","","tugas_kpw");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
}
$sql = "DELETE FROM daftar WHERE id=$id";
if ($conn->query($sql)===TRUE){
    header("Location: index.php");

}else{
    echo "Error: ". $conn->error;
}

$conn->close();
}
?>
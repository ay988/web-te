<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ayuseli";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];

    $id = $conn->real_escape_string($id);

    $sql = "DELETE FROM `proses_pinjam` WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        header("Location: tabelPinjam.php");
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>

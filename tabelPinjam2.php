<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login2.php");
    exit;
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ayuseli";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$email = $_SESSION['email'];
$sql = "SELECT * FROM proses_pinjam WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Data Peminjaman Barang</title>
    <style>
        table { width: 100%; border-collapse: collapse; }
        table, th, td { border: 1px solid black; padding: 10px; text-align: left; }
        th { background-color: #4CAF50; color: white; }
    </style>
</head>
<body>
    <h2>Data Peminjaman Barang</h2>
    <table>
        <tr>
            <th>No</th>
            <th>Nama Peminjam</th>
            <th>Nama Barang</th>
            <th>Tanggal Pinjam</th>
            <th>Tanggal Kembali</th>
            <th>Keterangan</th>
        </tr>
        <?php
        $no = 1;
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $no++ . "</td>";
                echo "<td>" . htmlspecialchars($row["nama"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["barang"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["tanggal_pinjam"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["tanggal_kembali"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["keterangan"]) . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>Tidak ada data peminjaman.</td></tr>";
        }
        $stmt->close();
        $conn->close();
        ?>
    </table>
    <br>
    <a href="formPinjam.php">tambahBarang</a>
    <a href="logout.php">Logout</a>
</body>
</html>
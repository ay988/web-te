<?php

$servername = "localhost";
$nama = "root"; 
$barang = "";     
$dbname = "ayuseli";

$conn = new mysqli($servername, $nama, $barang, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $barang = $_POST['barang'];
    $tanggal_pinjam = $_POST['tanggal_pinjam'];
    $tanggal_kembali = $_POST['tanggal_kembali'];
    $keterangan = $_POST['keterangan'];

    if ($tanggal_kembali < $tanggal_pinjam) {
        echo "Tanggal kembali tidak boleh lebih awal dari tanggal pinjam!";
        exit;
    }

    $stmt = $conn->prepare("INSERT INTO proses_pinjam (nama, barang, tanggal_pinjam, tanggal_kembali, keterangan) VALUES (?, ?, ?, ?, ?)");
    
    if ($stmt === false) {
        die('Error preparing the statement: ' . $conn->error);
    }

    $stmt->bind_param("sssss", $nama, $barang, $tanggal_pinjam, $tanggal_kembali, $keterangan);

    if ($stmt->execute()) {
        header("Location: tabelPinjam.php");
        exit;
    } else {
        echo "Gagal menyimpan data: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
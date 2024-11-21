<?php
require 'koneksi.php';

// Ambil daftar akun yang belum disetujui
$query_sql = "SELECT `id`, `fullname`, `username`, `email`, `is_approved` FROM `tabel_as` WHERE `is_approved` = 0"; // Pastikan kolom is_approved benar
$result = mysqli_query($conn, $query_sql);

echo "<h2>Daftar Pendaftaran Menunggu Persetujuan</h2>";

if ($result && mysqli_num_rows($result) > 0) { // Periksa jika ada hasil
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<p>";
        echo "Nama: " . htmlspecialchars($row['fullname']) . "<br>";
        echo "Username: " . htmlspecialchars($row['username']) . "<br>";
        echo "Email: " . htmlspecialchars($row['email']) . "<br>";
        echo "<a href='approve.php?id=" . $row['id'] . "'>Setujui</a>";
        echo "</p>";
    }
} else {
    echo "<p>Tidak ada pendaftaran yang menunggu persetujuan.</p>";
}
?>

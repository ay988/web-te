<?php
require 'koneksi.php';

// Ambil ID pengguna
$id = $_GET['id'];

// Update status akun menjadi disetujui
$query_sql = "UPDATE tabel_as SET is_approved = 1 WHERE id = $id";
if (mysqli_query($conn, $query_sql)) {
    // Ambil email pengguna
    $user_query = "SELECT email, fullname FROM tabel_as WHERE id = $id";
    $result = mysqli_query($conn, $user_query);
    $user = mysqli_fetch_assoc($result);

    // Kirim email notifikasi ke pengguna
    $email = $user['email'];
    $fullname = $user['fullname'];
    $subject = "Akun Anda Disetujui!";
    $message = "
        Hai $fullname,

        Selamat! Akun Anda telah disetujui oleh admin. Anda sekarang dapat login ke sistem.

        Salam,
        Tim Kami
    ";
    $headers = "From: no-reply@yourdomain.com";

    if (mail($email, $subject, $message, $headers)) {
        echo "Akun telah disetujui dan notifikasi dikirim ke email.";
    } else {
        echo "Akun disetujui, tetapi email notifikasi gagal dikirim.";
    }
} else {
    echo "Gagal menyetujui akun: " . mysqli_error($conn);
}
?>

<?php
require 'koneksi.php';

$fullname = $_POST["fullname"];
$username = $_POST["username"];
$password = $_POST["password"];
$email = $_POST["email"];

// Hash password untuk keamanan
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Query untuk memasukkan data ke dalam tabel
$query_sql = "INSERT INTO `tabel_as`(`fullname`, `username`, `password`, `email`) 
              VALUES ('$fullname', '$username', '$hashed_password', '$email')";

if (mysqli_query($conn, $query_sql)) {
    // Data berhasil ditambahkan, kirim email notifikasi

    // Email Admin
    $admin_email = "ayu608679@gmail.com"; // Ganti dengan email admin
    $admin_subject = "Pendaftaran Pengguna Baru";
    $admin_message = "
    Ada pendaftaran pengguna baru:
    Nama Lengkap: $fullname
    Username: $username
    Email: $email
    ";

    // Email ke Pengguna
    $user_subject = "Pendaftaran Berhasil";
    $user_message = "
    Hai $fullname,

    Terima kasih telah mendaftar di situs kami.
    Berikut adalah informasi akun kamu:
    - Username: $username
    - Email: $email

    Harap simpan informasi ini dengan baik.
    
    Salam,
    Tim Support
    ";

    // Header email (opsional untuk menghindari spam)
    $headers = "From: ayu608679@gmail.com\r\n"; // Ganti dengan alamat email valid
    $headers .= "Reply-To: ayu608679@gmail.com\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    // Kirim email ke admin
    mail($admin_email, $admin_subject, $admin_message, $headers);

    // Kirim email ke pengguna
    mail($email, $user_subject, $user_message, $headers);

    // Redirect ke halaman sukses
    header("Location: index.html");
    exit;
} else {
    // Gagal menambahkan data
    echo "PENDAFTARAN GAGAL: " . mysqli_error($conn);
}
?>

<?php
// Load PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "proses_pinjam";

// Buat koneksi ke database
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Mendapatkan data dari form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $barang = $_POST['barang'];
    $tanggal_pinjam = $_POST['tanggal_pinjam'];
    $tanggal_kembali = $_POST['tanggal_kembali'];
    $keterangan = $_POST['keterangan'];
    $email_penerima = $_POST['email'];

    // Validasi tanggal kembali tidak lebih awal dari tanggal pinjam
    if ($tanggal_kembali < $tanggal_pinjam) {
        echo "Tanggal kembali tidak boleh lebih awal dari tanggal pinjam!";
        exit;
    }

    // Simpan data peminjaman ke database
    $stmt = $conn->prepare("INSERT INTO proses_pinjam (nama, barang, tanggal_pinjam, tanggal_kembali, keterangan, email) VALUES (?, ?, ?, ?, ?, ?)");
    if ($stmt === false) {
        die('Error preparing the statement: ' . $conn->error);
    }
    $stmt->bind_param("ssssss", $nama, $barang, $tanggal_pinjam, $tanggal_kembali, $keterangan, $email_penerima);
    $stmt->execute();
    $stmt->close();

    // Mengirim email konfirmasi
    $mail = new PHPMailer(true);
    try {
        // Konfigurasi server SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Ganti dengan SMTP server kamu
        $mail->SMTPAuth = true;
        $mail->Username = 'your_email@gmail.com'; // Ganti dengan email kamu
        $mail->Password = 'your_password'; // Ganti dengan password email kamu
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Set email pengirim dan penerima
        $mail->setFrom('your_email@gmail.com', 'Nama Pengirim');
        $mail->addAddress($email_penerima);

        // Konten email
        $mail->isHTML(true);
        $mail->Subject = "Konfirmasi Peminjaman Barang";
        $mail->Body    = "<h2>Detail Peminjaman Barang</h2>" .
                         "<p><strong>Nama:</strong> $nama</p>" .
                         "<p><strong>Barang:</strong> $barang</p>" .
                         "<p><strong>Tanggal Pinjam:</strong> $tanggal_pinjam</p>" .
                         "<p><strong>Tanggal Kembali:</strong> $tanggal_kembali</p>" .
                         "<p><strong>Keterangan:</strong> $keterangan</p>";

        // Kirim email
        $mail->send();
        echo "Data berhasil disimpan dan email telah dikirim.";
    } catch (Exception $e) {
        echo "Data berhasil disimpan, tetapi email gagal dikirim. Error: {$mail->ErrorInfo}";
    }
}

// Tutup koneksi
$conn->close();
?>

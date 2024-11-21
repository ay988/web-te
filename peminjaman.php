<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Peminjaman Barang</title>
</head>
<body>
    <h2>Form Peminjaman Barang</h2>
    <form action="prosesPeminjaman.php" method="post">
        <label>Nama:</label><br>
        <input type="text" name="nama" required><br><br>

        <label>Barang yang Dipinjam:</label><br>
        <input type="text" name="barang" required><br><br>

        <label>Tanggal Pinjam:</label><br>
        <input type="date" name="tanggal_pinjam" required><br><br>

        <label>Tanggal Kembali:</label><br>
        <input type="date" name="tanggal_kembali" required><br><br>

        <label>Keterangan:</label><br>
        <textarea name="keterangan" rows="4" cols="50"></textarea><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>

        <input type="submit" value="Submit">
    </form>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>Data Peminjaman Barang</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            height: 150vh; 
            margin: 0; 
            background-color: #f2f2f2;
        }
        table {
            width: 100%; 
            border-collapse: collapse; 
            margin: 20px 0; 
            background-color: #fff;
        }
        table, th, td {
            border: 1px solid #ddd;
            padding: 10px; 
            text-align: left; 
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #ddd;
        }
        button {
            background-color: #f44336;
            color: white;
            border: none;
            padding: 10px 10px;
            cursor: pointer;
        }
        button:hover {
            background-color: #d32f2f;
        }
        .update-button {
            background-color: #4CAF50; 
        }
        .update-button:hover {
            background-color: #388E3C;
        }
    </style>
</head>
<body>

    <div>
        <h2>Data Peminjaman Barang</h2>
        <a class="btn btn-primary" href="pinjam.html" role="button">Tambah Barang</a>
        <table>
            <tr>
                <th>No</th> 
                <th>Nama Peminjam</th>
                <th>Nama Barang</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
                <th>Keterangan</th>
                <th>Aksi</th> 
            </tr>
            <?php
            $servername = "localhost";
            $nama = "root";
            $barang = "";
            $dbname = "ayuseli";

            $conn = new mysqli($servername, $nama, $barang, $dbname);

            if ($conn->connect_error) {
                die("Koneksi gagal: " . $conn->connect_error);
            }

            $sql = "SELECT * FROM proses_pinjam";
            $result = $conn->query($sql);

            $no = 1; 

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $no . "</td>";
                    echo "<td>" . htmlspecialchars($row["nama"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["barang"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["tanggal_pinjam"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["tanggal_kembali"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["keterangan"]) . "</td>";
                    echo "<td>";
                    
                    echo "<form action='update.php' method='post' style='display:inline;'>";
                    echo "<input type='hidden' name='id' value='" . htmlspecialchars($row["id"]) . "'>";
                                    echo "</form>";
                    echo "<form action='delete.php' method='post' style='display:inline;'>";
                    echo "<input type='hidden' name='id' value='" . htmlspecialchars($row["id"]) . "'>";
                    echo "<button type='submit' onclick=\"return confirm('Anda yakin akan menghapus data ini?');\">Delete</button>";
                    echo "</form>";
                    echo "</td>"; 
                    echo "</tr>";

                    $no++;
                }
            } else {
                echo "<tr><td colspan='8'>Tidak ada data peminjaman.</td></tr>"; 
            }
            $conn->close();
            ?>
        </table>
    </div>

</body>
</html>

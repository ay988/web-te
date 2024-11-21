<?php
require 'koneksi.php';
$fullname = $_POST ["fullname"];
$username = $_POST ["username"];
$password = $_POST ["password"];
$email = $_POST ["email"];

$query_sql = "INSERT INTO `tabel_as`(`fullname`, `username`, `password`, `email`) VALUES ('$fullname','$username','$password','$email')";

 if (mysqli_query($conn, $query_sql)){
    header("Location: index.html");
 }else{
    echo "PENDAFTARAN GAGAL : ".mysqli_error($conn);
 }
?>
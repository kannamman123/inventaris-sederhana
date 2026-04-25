<?php
$host     = "localhost";
$user     = "root"; // Sesuaikan dengan username database Anda
$password = "";     // Sesuaikan dengan password database Anda (biasanya kosong di XAMPP)
$db       = "pkl-inventaris";

$koneksi = mysqli_connect($host, $user, $password, $db);

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
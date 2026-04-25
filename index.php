<?php 
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}
// index.php
include 'koneksi.php'; 

// Menangkap input pencarian
$cari = isset($_GET['cari']) ? $_GET['cari'] : '';

// Menyiapkan Query
$query = "SELECT barang.id, barang.nama_barang, barang.stok, kategori.nama_kategori 
          FROM barang 
          LEFT JOIN kategori ON barang.kategori_id = kategori.id 
          WHERE barang.nama_barang LIKE ? 
          ORDER BY barang.id DESC";

$stmt = mysqli_prepare($koneksi, $query);
$search_param = "%$cari%";
mysqli_stmt_bind_param($stmt, "s", $search_param);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Simpan hasil query ke dalam array agar mudah dibaca oleh View
$data_barang = [];
while($row = mysqli_fetch_assoc($result)) {
    $data_barang[] = $row;
}

// Memanggil file View untuk menampilkan data
include 'views/v_index.php';
?>
<?php 
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

include 'koneksi.php'; 


$cari = isset($_GET['cari']) ? $_GET['cari'] : '';


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


$data_barang = [];
while($row = mysqli_fetch_assoc($result)) {
    $data_barang[] = $row;
}


include 'views/v_index.php';
?>
<?php

session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

include 'koneksi.php';

if(isset($_GET['id'])){
    $id = $_GET['id'];
    
    $query = "DELETE FROM barang WHERE id = ?";
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    
    mysqli_stmt_execute($stmt);
}

header("Location: index.php");
exit;
?>
<?php 
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

include 'koneksi.php'; 


if(isset($_POST['submit'])){
    $nama_barang = trim($_POST['nama_barang']);
    $stok = trim($_POST['stok']);
    $kategori_id = trim($_POST['kategori_id']);

 
    if(empty($nama_barang) || $stok === "" || empty($kategori_id)) {
        $error = "Semua kolom wajib diisi!";
    } else {
        $query = "INSERT INTO barang (nama_barang, stok, kategori_id) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($koneksi, $query);
        mysqli_stmt_bind_param($stmt, "sii", $nama_barang, $stok, $kategori_id);
        
        if(mysqli_stmt_execute($stmt)){
            header("Location: index.php");
            exit;
        } else {
            $error = "Gagal menyimpan data!";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Barang</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container" style="max-width: 500px;">
        <h2>Tambah Barang</h2>
        
        <?php if(isset($error)) echo "<div class='error-msg'>$error</div>"; ?>

        <form action="" method="POST">
            <div class="form-group">
                <label>Nama Barang:</label>
                <input type="text" name="nama_barang" required>
            </div>

            <div class="form-group">
                <label>Kategori:</label>
                <select name="kategori_id" required>
                    <option value="">-- Pilih Kategori --</option>
                    <?php
                    $q_kategori = mysqli_query($koneksi, "SELECT * FROM kategori ORDER BY nama_kategori ASC");
                    while($kat = mysqli_fetch_assoc($q_kategori)) {
                        echo "<option value='{$kat['id']}'>{$kat['nama_kategori']}</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label>Stok:</label>
                <input type="number" name="stok" required min="0">
            </div>

            <button type="submit" name="submit" class="btn btn-search">Simpan</button>
            <a href="index.php" class="btn btn-reset">Batal</a>
        </form>
    </div>
</body>
</html>
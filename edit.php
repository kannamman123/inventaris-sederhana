<?php 
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

include 'koneksi.php'; 

if(!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = $_GET['id'];


$query_select = "SELECT * FROM barang WHERE id = ?";
$stmt_select = mysqli_prepare($koneksi, $query_select);
mysqli_stmt_bind_param($stmt_select, "i", $id);
mysqli_stmt_execute($stmt_select);
$result_select = mysqli_stmt_get_result($stmt_select);
$data = mysqli_fetch_assoc($result_select);


if(!$data) {
    header("Location: index.php");
    exit;
}

if(isset($_POST['update'])){
    $nama_barang = trim($_POST['nama_barang']);
    $stok = trim($_POST['stok']);
    $kategori_id = trim($_POST['kategori_id']);

    if(empty($nama_barang) || $stok === "" || empty($kategori_id)) {
        $error = "Semua kolom wajib diisi!";
    } else {
        $query_update = "UPDATE barang SET nama_barang = ?, stok = ?, kategori_id = ? WHERE id = ?";
        $stmt_update = mysqli_prepare($koneksi, $query_update);
        mysqli_stmt_bind_param($stmt_update, "siii", $nama_barang, $stok, $kategori_id, $id);
        
        if(mysqli_stmt_execute($stmt_update)){
            $data['nama_barang'] = $nama_barang;
            $data['stok'] = $stok;
            $data['kategori_id'] = $kategori_id;
            
            $sukses = "Data berhasil diupdate!";
        } else {
            $error = "Gagal mengupdate data!";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Barang</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container" style="max-width: 500px;">
        <h2>Edit Barang</h2>
        
        <?php if(isset($error)) echo "<div class='error-msg'>$error</div>"; ?>
        <?php if(isset($sukses)) echo "<div class='error-msg' style='background-color:#d4edda; color:#155724; border-left: 4px solid #28a745;'>$sukses</div>"; ?>
        
        <form action="" method="POST">
            <div class="form-group">
                <label>Nama Barang:</label>
                <input type="text" name="nama_barang" value="<?= htmlspecialchars($data['nama_barang']) ?>" required>
            </div>

            <div class="form-group">
                <label>Kategori:</label>
                <select name="kategori_id" required>
                    <?php
                    $q_kategori = mysqli_query($koneksi, "SELECT * FROM kategori ORDER BY nama_kategori ASC");
                    while($kat = mysqli_fetch_assoc($q_kategori)) {
                        $selected = ($kat['id'] == $data['kategori_id']) ? "selected" : "";
                        echo "<option value='{$kat['id']}' $selected>{$kat['nama_kategori']}</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label>Stok:</label>
                <input type="number" name="stok" value="<?= htmlspecialchars($data['stok']) ?>" required min="0">
            </div>

            <button type="submit" name="update" class="btn btn-edit">Update Data</button>
            <a href="index.php" class="btn btn-reset">Kembali</a>
        </form>
    </div>
</body>
</html>
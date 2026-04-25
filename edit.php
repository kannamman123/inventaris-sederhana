<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Barang</title>
</head>
<body>
    <h2>Edit Barang</h2>
    <?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    
    <form action="" method="POST">
        <label>Nama Barang:</label><br>
        <input type="text" name="nama_barang" value="<?= htmlspecialchars($data['nama_barang']) ?>" required><br><br>

        <label>Kategori:</label><br>
        <select name="kategori_id" required>
            <?php
            $q_kategori = mysqli_query($koneksi, "SELECT * FROM kategori ORDER BY nama_kategori ASC");
            while($kat = mysqli_fetch_assoc($q_kategori)) {
                $selected = ($kat['id'] == $data['kategori_id']) ? "selected" : "";
                echo "<option value='{$kat['id']}' $selected>{$kat['nama_kategori']}</option>";
            }
            ?>
        </select><br><br>

        <label>Stok:</label><br>
        <input type="number" name="stok" value="<?= htmlspecialchars($data['stok']) ?>" required min="0"><br><br>

        <button type="submit" name="update">Update</button>
        <a href="index.php">Batal</a>
    </form>
</body>
</html>

<head>
    <meta charset="UTF-8">
    <title>Tambah Barang</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container" style="max-width: 500px;"> <h2>Tambah Barang</h2>
        
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
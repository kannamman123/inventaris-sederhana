<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Inventaris Barang</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Daftar Inventaris Barang</h2>
        
        <a href="tambah.php" class="btn btn-add">+ Tambah Barang</a>

        <form action="index.php" method="GET" class="search-form">
            <input type="text" name="cari" placeholder="Cari nama barang..." value="<?= htmlspecialchars($cari) ?>">
            <button type="submit" class="btn btn-search">Cari</button>
            <a href="index.php" class="btn btn-reset">Reset</a>
            <a href="logout.php" class="btn btn-delete" style="float: right;">Logout</a>
        </form>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Kategori</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if(count($data_barang) > 0): ?>
                    <?php $no = 1; foreach($data_barang as $row): ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= htmlspecialchars($row['nama_barang']); ?></td>
                            <td><?= htmlspecialchars($row['nama_kategori']); ?></td>
                            <td><?= htmlspecialchars($row['stok']); ?></td>
                            <td>
                                <a href="edit.php?id=<?= $row['id']; ?>" class="btn btn-edit">Edit</a>
                                <a href="hapus.php?id=<?= $row['id']; ?>" class="btn btn-delete" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan='5' style='text-align:center;'>Data tidak ditemukan</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
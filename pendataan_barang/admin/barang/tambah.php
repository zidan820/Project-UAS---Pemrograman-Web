<?php
session_start();
if (!isset($_SESSION['login'])) {
    header('Location: ../../login/index.php');
    exit;
}
include '../../config/koneksi.php';

if (isset($_POST['simpan'])) {
    $nama = $_POST['nama_barang'];
    $id_kategori = $_POST['id_kategori'];
    $id_supplier = $_POST['id_supplier'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    mysqli_query($koneksi, "INSERT INTO barang (nama_barang, id_kategori, id_supplier, harga, stok) 
        VALUES ('$nama', '$id_kategori', '$id_supplier', '$harga', '$stok')");
    header('Location: index.php');
    exit;
}

// Ambil data kategori & supplier
$kategori = mysqli_query($koneksi, "SELECT * FROM kategori");
$supplier = mysqli_query($koneksi, "SELECT * FROM supplier");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="d-flex">
    <div class="bg-dark text-white p-3" style="width:250px; min-height:100vh;">
        <h4 class="text-center">MENU</h4><hr>
        <ul class="nav flex-column">
            <li class="nav-item"><a href="../index.php" class="nav-link text-white">🏠 Dashboard</a></li>
            <li class="nav-item"><a href="../kategori/index.php" class="nav-link text-white">📁 Kategori</a></li>
            <li class="nav-item"><a href="../supplier/index.php" class="nav-link text-white">🏭 Supplier</a></li>
            <li class="nav-item"><a href="../pelanggan/index.php" class="nav-link text-white">👥 Pelanggan</a></li>
            <li class="nav-item"><a href="index.php" class="nav-link text-white">🛒 Barang</a></li>
            <li class="nav-item"><a href="../stok_masuk/index.php" class="nav-link text-white">➕ Stok Masuk</a></li>
            <li class="nav-item"><a href="../transaksi/index.php" class="nav-link text-white">💰 Transaksi</a></li>
            <li class="nav-item"><a href="../retur/index.php" class="nav-link text-white">🔄 Retur</a></li>
            <li class="nav-item"><a href="../users/index.php" class="nav-link text-white">🔑 User</a></li>
            <li class="nav-item"><a href="../laporan/index.php" class="nav-link text-white">📊 Laporan</a></li>
            <li class="nav-item"><a href="../../login/logout.php" class="nav-link text-danger">🚪 Logout</a></li>
        </ul>
    </div>

    <div class="p-4 flex-grow-1">
        <h3>Tambah Barang</h3>
        <form method="post">
            <div class="mb-3">
                <input type="text" name="nama_barang" class="form-control" placeholder="Nama Barang" required>
            </div>
            <div class="mb-3">
                <select name="id_kategori" class="form-control" required>
                    <option value="">Pilih Kategori</option>
                    <?php while ($k = mysqli_fetch_assoc($kategori)) { ?>
                        <option value="<?= $k['id']; ?>"><?= $k['nama_kategori']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="mb-3">
                <select name="id_supplier" class="form-control" required>
                    <option value="">Pilih Supplier</option>
                    <?php while ($s = mysqli_fetch_assoc($supplier)) { ?>
                        <option value="<?= $s['id']; ?>"><?= $s['nama_supplier']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="mb-3">
                <input type="number" name="harga" class="form-control" placeholder="Harga" required>
            </div>
            <div class="mb-3">
                <input type="number" name="stok" class="form-control" placeholder="Stok" required>
            </div>
            <button type="submit" name="simpan" class="btn btn-success">💾 Simpan</button>
            <a href="index.php" class="btn btn-secondary">↩️ Kembali</a>
        </form>
    </div>
</div>
</body>
</html>

<?php
session_start();
if (!isset($_SESSION['login'])) {
    header('Location: ../../login/index.php');
    exit;
}
include '../../config/koneksi.php';

// Hapus Supplier
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    mysqli_query($koneksi, "DELETE FROM supplier WHERE id='$id'");
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Manajemen Supplier</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="d-flex">
    <div class="bg-dark text-white p-3" style="width:250px; min-height:100vh;">
        <h4 class="text-center">MENU</h4><hr>
        <ul class="nav flex-column">
            <li class="nav-item"><a href="../index.php" class="nav-link text-white">🏠 Dashboard</a></li>
            <li class="nav-item"><a href="../kategori/index.php" class="nav-link text-white">📁 Kategori</a></li>
            <li class="nav-item"><a href="index.php" class="nav-link text-white">🏭 Supplier</a></li>
            <li class="nav-item"><a href="../pelanggan/index.php" class="nav-link text-white">👥 Pelanggan</a></li>
            <li class="nav-item"><a href="../barang/index.php" class="nav-link text-white">🛒 Barang</a></li>
            <li class="nav-item"><a href="../stok_masuk/index.php" class="nav-link text-white">➕ Stok Masuk</a></li>
            <li class="nav-item"><a href="../transaksi/index.php" class="nav-link text-white">💰 Transaksi</a></li>
            <li class="nav-item"><a href="../retur/index.php" class="nav-link text-white">🔄 Retur</a></li>
            <li class="nav-item"><a href="../users/index.php" class="nav-link text-white">🔑 User</a></li>
            <li class="nav-item"><a href="../laporan/index.php" class="nav-link text-white">📊 Laporan</a></li>
            <li class="nav-item"><a href="../../login/logout.php" class="nav-link text-danger">🚪 Logout</a></li>
        </ul>
    </div>

    <div class="p-4 flex-grow-1">
        <h3>Manajemen Supplier</h3>
        <a href="tambah.php" class="btn btn-primary btn-sm mb-3">➕ Tambah Supplier</a>
        <table class="table table-bordered">
            <tr>
                <th>No</th>
                <th>Nama Supplier</th>
                <th>Kontak</th>
                <th>Alamat</th>
                <th>Aksi</th>
            </tr>
            <?php
            $no = 1;
            $query = mysqli_query($koneksi, "SELECT * FROM supplier");
            while ($data = mysqli_fetch_assoc($query)) {
            ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $data['nama_supplier']; ?></td>
                <td><?= $data['kontak']; ?></td>
                <td><?= $data['alamat']; ?></td>
                <td>
                    <a href="edit.php?id=<?= $data['id']; ?>" class="btn btn-warning btn-sm">✏️ Edit</a>
                    <a href="?hapus=<?= $data['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin Hapus?')">🗑️ Hapus</a>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>
</div>
</body>
</html>

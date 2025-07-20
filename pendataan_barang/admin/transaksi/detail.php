<?php
session_start();
if (!isset($_SESSION['login'])) {
    header('Location: ../../login/index.php');
    exit;
}
include '../../config/koneksi.php';

$id = $_GET['id'];
$transaksi = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT transaksi.*, pelanggan.nama_pelanggan FROM transaksi JOIN pelanggan ON transaksi.id_pelanggan = pelanggan.id WHERE transaksi.id='$id'"));

$detail = mysqli_query($koneksi, "SELECT detail_transaksi.*, barang.nama_barang FROM detail_transaksi 
    JOIN barang ON detail_transaksi.id_barang = barang.id 
    WHERE id_transaksi='$id'");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Transaksi</title>
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
            <li class="nav-item"><a href="../barang/index.php" class="nav-link text-white">🛒 Barang</a></li>
            <li class="nav-item"><a href="../stok_masuk/index.php" class="nav-link text-white">➕ Stok Masuk</a></li>
            <li class="nav-item"><a href="index.php" class="nav-link text-white">💰 Transaksi</a></li>
            <li class="nav-item"><a href="../retur/index.php" class="nav-link text-white">🔄 Retur</a></li>
            <li class="nav-item"><a href="../index.php" class="nav-link text-white">🔑 User</a></li>
            <li class="nav-item"><a href="../laporan/index.php" class="nav-link text-white">📊 Laporan</a></li>
            <li class="nav-item"><a href="../../login/logout.php" class="nav-link text-danger">🚪 Logout</a></li>
        </ul>
    </div>

    <div class="p-4 flex-grow-1">
        <h3>Detail Transaksi</h3>
        <p><strong>Tanggal:</strong> <?= $transaksi['tanggal']; ?></p>
        <p><strong>Pelanggan:</strong> <?= $transaksi['nama_pelanggan']; ?></p>
        <p><strong>Total:</strong> <?= number_format($transaksi['total']); ?></p>

        <h5>Barang Dibeli:</h5>
        <table class="table table-bordered">
            <tr>
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th>Harga Satuan</th>
            </tr>
            <?php while ($d = mysqli_fetch_assoc($detail)) { ?>
            <tr>
                <td><?= $d['nama_barang']; ?></td>
                <td><?= $d['jumlah']; ?></td>
                <td><?= number_format($d['harga']); ?></td>
            </tr>
            <?php } ?>
        </table>
        <a href="index.php" class="btn btn-secondary">↩️ Kembali</a>
    </div>
</div>
</body>
</html>

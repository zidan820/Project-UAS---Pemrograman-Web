<?php
session_start();
if (!isset($_SESSION['login'])) {
    header('Location: ../../login/index.php');
    exit;
}
include '../../config/koneksi.php';

$tanggal_awal = isset($_GET['awal']) ? $_GET['awal'] : date('Y-m-01');
$tanggal_akhir = isset($_GET['akhir']) ? $_GET['akhir'] : date('Y-m-d');

$query = mysqli_query($koneksi, "
    SELECT transaksi.*, pelanggan.nama_pelanggan 
    FROM transaksi 
    JOIN pelanggan ON transaksi.id_pelanggan = pelanggan.id
    WHERE transaksi.tanggal BETWEEN '$tanggal_awal' AND '$tanggal_akhir'
");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Transaksi</title>
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
            <li class="nav-item"><a href="../transaksi/index.php" class="nav-link text-white">💰 Transaksi</a></li>
            <li class="nav-item"><a href="../retur/index.php" class="nav-link text-white">🔄 Retur</a></li>
            <li class="nav-item"><a href="../users/index.php" class="nav-link text-white">🔑 User</a></li>
            <li class="nav-item"><a href="index.php" class="nav-link text-white">📊 Laporan</a></li>
            <li class="nav-item"><a href="../../login/logout.php" class="nav-link text-danger">🚪 Logout</a></li>
        </ul>
    </div>

    <div class="p-4 flex-grow-1">
        <h3>Laporan Transaksi</h3>

        <form method="get" class="row mb-3">
            <div class="col-md-3">
                <input type="date" name="awal" value="<?= $tanggal_awal; ?>" class="form-control">
            </div>
            <div class="col-md-3">
                <input type="date" name="akhir" value="<?= $tanggal_akhir; ?>" class="form-control">
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary">🔍 Tampilkan</button>
                <a href="index.php" class="btn btn-secondary">🔄 Reset</a>
            </div>
        </form>

        <table class="table table-bordered">
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Pelanggan</th>
                <th>Total Transaksi</th>
            </tr>
            <?php
            $no = 1; $grand_total = 0;
            while ($data = mysqli_fetch_assoc($query)) {
                $grand_total += $data['total'];
            ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $data['tanggal']; ?></td>
                <td><?= $data['nama_pelanggan']; ?></td>
                <td><?= number_format($data['total']); ?></td>
            </tr>
            <?php } ?>
            <tr>
                <th colspan="3" class="text-end">Total Seluruh</th>
                <th><?= number_format($grand_total); ?></th>
            </tr>
        </table>
    </div>
</div>
</body>
</html>

<?php
session_start();
if (!isset($_SESSION['login'])) {
    header('Location: ../login/index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Pendataan Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="d-flex">
    <!-- Sidebar -->
    <div class="bg-dark text-white p-3" style="width: 250px; min-height: 100vh;">
        <h4 class="text-center">MENU</h4>
        <hr>
        <ul class="nav flex-column">
            <li class="nav-item"><a href="index.php" class="nav-link text-white">🏠 Dashboard</a></li>
            <li class="nav-item"><a href="kategori/index.php" class="nav-link text-white">📁 Kategori</a></li>
            <li class="nav-item"><a href="supplier/index.php" class="nav-link text-white">🏭 Supplier</a></li>
            <li class="nav-item"><a href="pelanggan/index.php" class="nav-link text-white">👥 Pelanggan</a></li>
            <li class="nav-item"><a href="barang/index.php" class="nav-link text-white">🛒 Barang</a></li>
            <li class="nav-item"><a href="stok_masuk/index.php" class="nav-link text-white">➕ Stok Masuk</a></li>
            <li class="nav-item"><a href="transaksi/index.php" class="nav-link text-white">💰 Transaksi</a></li>
            <li class="nav-item"><a href="retur/index.php" class="nav-link text-white">🔄 Retur</a></li>
            <li class="nav-item"><a href="users/index.php" class="nav-link text-white">🔑 User</a></li>
            <li class="nav-item"><a href="laporan/index.php" class="nav-link text-white">📊 Laporan</a></li>
            <li class="nav-item"><a href="../../login/logout.php" class="nav-link text-danger">🚪 Logout</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="p-4 flex-grow-1">
        <h3>Selamat Datang, <?= $_SESSION['nama']; ?>!</h3>
        <div class="alert alert-info">
            Ini adalah dashboard utama aplikasi pendataan barang.
        </div>
    </div>
</div>
</body>
</html>

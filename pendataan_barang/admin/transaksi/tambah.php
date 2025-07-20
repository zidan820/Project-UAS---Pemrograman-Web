<?php
session_start();
if (!isset($_SESSION['login'])) {
    header('Location: ../../login/index.php');
    exit;
}
include '../../config/koneksi.php';

if (isset($_POST['simpan'])) {
    $tanggal = $_POST['tanggal'];
    $id_pelanggan = $_POST['id_pelanggan'];
    $id_barang = $_POST['id_barang'];
    $jumlah = $_POST['jumlah'];

    $barang = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT harga, stok FROM barang WHERE id='$id_barang'"));

    $total = $barang['harga'] * $jumlah;

    // Simpan Transaksi Utama
$kode = 'TRX' . date('YmdHis');
mysqli_query($koneksi, "INSERT INTO transaksi (kode_transaksi, tanggal, id_pelanggan, total) VALUES ('$kode', '$tanggal', '$id_pelanggan', '$total')");

// Ambil ID Transaksi baru
$id_transaksi = mysqli_insert_id($koneksi);

// Looping Barang
foreach ($_POST['id_barang'] as $key => $id_barang) {
    $jumlah = $_POST['jumlah'][$key];
    
    // Ambil harga barang
    $q = mysqli_query($koneksi, "SELECT harga FROM barang WHERE id = '$id_barang'");
    $d = mysqli_fetch_assoc($q);
    $harga = $d['harga'];

    $subtotal = $harga * $jumlah;

    // Simpan ke Detail Transaksi
    mysqli_query($koneksi, "INSERT INTO detail_transaksi (id_transaksi, id_barang, harga, jumlah, subtotal) 
        VALUES ('$id_transaksi', '$id_barang', '$harga', '$jumlah', '$subtotal')");
}
    header('Location: index.php');
    exit;
}

$pelanggan = mysqli_query($koneksi, "SELECT * FROM pelanggan");
$barang = mysqli_query($koneksi, "SELECT * FROM barang");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Transaksi</title>
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
        <h3>Tambah Transaksi</h3>
        <form method="post">
            <div class="mb-3">
                <input type="date" name="tanggal" class="form-control" required>
            </div>
            <div class="mb-3">
                <select name="id_pelanggan" class="form-control" required>
                    <option value="">Pilih Pelanggan</option>
                    <?php while ($p = mysqli_fetch_assoc($pelanggan)) { ?>
                        <option value="<?= $p['id']; ?>"><?= $p['nama_pelanggan']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="mb-3">
                <select name="id_barang" class="form-control" required>
                    <option value="">Pilih Barang</option>
                    <?php while ($b = mysqli_fetch_assoc($barang)) { ?>
                        <option value="<?= $b['id']; ?>"><?= $b['nama_barang']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="mb-3">
                <input type="number" name="jumlah" class="form-control" placeholder="Jumlah" required>
            </div>
            <button type="submit" name="simpan" class="btn btn-success">💾 Simpan</button>
            <a href="index.php" class="btn btn-secondary">↩️ Kembali</a>
        </form>
    </div>
</div>
</body>
</html>

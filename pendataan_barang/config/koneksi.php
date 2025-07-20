<?php
$koneksi = mysqli_connect('localhost', 'root', '', 'db_pendataan_barang');

if (!$koneksi) {
    die('Koneksi ke Database Gagal: ' . mysqli_connect_error());
}
?>

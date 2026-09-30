<?php require "auth.php"; require "../config/koneksi.php"; $title="Dashboard"; include "header.php";
$booking=$koneksi->query("SELECT COUNT(*) total FROM booking")->fetch_assoc()['total'];
$layanan=$koneksi->query("SELECT COUNT(*) total FROM layanan")->fetch_assoc()['total'];
$galeri=$koneksi->query("SELECT COUNT(*) total FROM galeri")->fetch_assoc()['total'];
?>
<div class="admin-wrap"><h1>Dashboard</h1><p>Selamat datang di panel admin Luna Beauty.</p><div class="admin-grid" style="margin-top:25px"><div class="admin-card"><h3>Total Booking</h3><h2><?= $booking ?></h2></div><div class="admin-card"><h3>Total Layanan</h3><h2><?= $layanan ?></h2></div><div class="admin-card"><h3>Total Galeri</h3><h2><?= $galeri ?></h2></div></div></div>
<?php include "footer.php"; ?>
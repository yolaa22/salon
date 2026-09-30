<?php
require "config/koneksi.php"; $title="Layanan";
$data=$koneksi->query("SELECT * FROM layanan ORDER BY id_layanan DESC");
include "includes/header.php";
?>
<div class="page-title"><div class="container"><div class="eyebrow">Our Services</div><h1>Layanan & Harga</h1><p>Pilih layanan yang paling sesuai dengan kebutuhanmu.</p></div></div>
<section class="section"><div class="container"><div class="cards">
<?php while($row=$data->fetch_assoc()): ?>
<div class="card"><div class="icon"><?= htmlspecialchars($row['ikon']) ?></div><h3><?= htmlspecialchars($row['nama_layanan']) ?></h3><p><?= htmlspecialchars($row['deskripsi']) ?></p><div class="price">Rp <?= number_format($row['harga'],0,',','.') ?></div></div>
<?php endwhile; ?>
</div></div></section>
<?php include "includes/footer.php"; ?>
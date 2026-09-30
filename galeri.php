<?php
require "config/koneksi.php"; $title="Galeri";
$data=$koneksi->query("SELECT * FROM galeri ORDER BY id_galeri DESC");
include "includes/header.php";
?>
<div class="page-title"><div class="container"><div class="eyebrow">Our Work</div><h1>Galeri</h1><p>Beberapa inspirasi hasil dan suasana Yola Beauty.</p></div></div>
<section class="section"><div class="container"><div class="gallery">
<?php while($row=$data->fetch_assoc()): ?>
<img src="<?= htmlspecialchars($row['gambar']) ?>" alt="<?= htmlspecialchars($row['judul']) ?>" title="<?= htmlspecialchars($row['judul']) ?>">
<?php endwhile; ?>
</div></div></section>
<?php include "includes/footer.php"; ?>
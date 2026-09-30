<?php
if (session_status() === PHP_SESSION_NONE) session_start();
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= isset($title) ? $title . " | Luna Beauty Salon" : "Luna Beauty Salon" ?></title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<header class="navbar">
  <div class="container nav-wrap">
    <a href="index.php" class="logo"><span>L</span> Luna Beauty</a>
    <button class="menu-btn" onclick="document.querySelector('.nav-links').classList.toggle('show')">☰</button>
    <nav class="nav-links">
      <a href="index.php">Beranda</a>
      <a href="tentang.php">Tentang</a>
      <a href="layanan.php">Layanan</a>
      <a href="galeri.php">Galeri</a>
      <a href="booking.php" class="nav-cta">Booking</a>
    </nav>
  </div>
</header>

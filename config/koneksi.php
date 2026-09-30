<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "salon_makeup";

$koneksi = new mysqli($host, $user, $pass, $db);
if ($koneksi->connect_error) {
    die("Koneksi database gagal: " . $koneksi->connect_error);
}
$koneksi->set_charset("utf8mb4");
?>
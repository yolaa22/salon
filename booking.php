<?php
require "config/koneksi.php";
$title = "Booking";

$layanan = $koneksi->query("SELECT * FROM layanan ORDER BY nama_layanan");
$pesan = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nama = trim($_POST['nama']);
    $no_hp = trim($_POST['no_hp']);
    $email = trim($_POST['email']);
    $id_layanan = (int) $_POST['id_layanan'];
    $tanggal = $_POST['tanggal'];
    $jam = $_POST['jam'];
    $catatan = trim($_POST['catatan']);

    if ($nama && $no_hp && $tanggal && $jam && $id_layanan) {

        $stmt = $koneksi->prepare("
            INSERT INTO booking
            (nama, no_hp, email, id_layanan, tanggal, jam, catatan, status)
            VALUES (?, ?, ?, ?, ?, ?, ?, 'Menunggu')
        ");

        $stmt->bind_param(
            "sssisss",
            $nama,
            $no_hp,
            $email,
            $id_layanan,
            $tanggal,
            $jam,
            $catatan
        );

        if ($stmt->execute()) {

            $query_layanan = $koneksi->query(
                "SELECT nama_layanan, harga FROM layanan WHERE id_layanan = $id_layanan"
            );

            $data_layanan = $query_layanan->fetch_assoc();

            $nama_layanan = $data_layanan['nama_layanan'];
            $harga = number_format($data_layanan['harga'], 0, ',', '.');

            $tanggal_format = date('d-m-Y', strtotime($tanggal));

            $pesan_wa =
                "Halo Luna Beauty Salon 👋%0A%0A" .
                "Saya ingin melakukan booking:%0A%0A" .
                "Nama: " . $nama . "%0A" .
                "No. WhatsApp: " . $no_hp . "%0A" .
                "Email: " . $email . "%0A" .
                "Layanan: " . $nama_layanan . "%0A" .
                "Harga: Rp " . $harga . "%0A" .
                "Tanggal: " . $tanggal_format . "%0A" .
                "Jam: " . $jam . "%0A" .
                "Catatan: " . ($catatan ?: "-") . "%0A%0A" .
                "Mohon konfirmasi booking saya. Terima kasih 🙏";

            $nomor_wa = "62882006614246";

            $url_wa = "https://wa.me/" . $nomor_wa . "?text=" . $pesan_wa;

            header("Location: " . $url_wa);
            exit;

        } else {
            $pesan = "Booking gagal disimpan.";
        }

    } else {
        $pesan = "Mohon lengkapi data booking.";
    }
}

include "includes/header.php";
?>

<div class="page-title">
    <div class="container">
        <div class="eyebrow">Appointment</div>
        <h1>Booking Salon</h1>
        <p>Isi formulir berikut untuk membuat reservasi.</p>
    </div>
</div>

<section class="section">
    <div class="container">

        <div class="booking-box">

            <?php if ($pesan): ?>

                <div class="alert error">
                    <?= htmlspecialchars($pesan) ?>
                </div>

            <?php endif; ?>

            <form method="post">

                <div class="form-grid">

                    <div class="form-group">
                        <label>Nama Lengkap *</label>
                        <input
                            type="text"
                            name="nama"
                            required
                        >
                    </div>

                    <div class="form-group">
                        <label>No. WhatsApp *</label>
                        <input
                            type="text"
                            name="no_hp"
                            required
                            placeholder="08xxxxxxxxxx"
                        >
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input
                            type="email"
                            name="email"
                            placeholder="email@gmail.com"
                        >
                    </div>

                    <div class="form-group">
                        <label>Layanan *</label>

                        <select name="id_layanan" required>

                            <option value="">
                                -- Pilih Layanan --
                            </option>

                            <?php while ($l = $layanan->fetch_assoc()): ?>

                                <option value="<?= $l['id_layanan'] ?>">

                                    <?= htmlspecialchars($l['nama_layanan']) ?>

                                    - Rp
                                    <?= number_format($l['harga'], 0, ',', '.') ?>

                                </option>

                            <?php endwhile; ?>

                        </select>

                    </div>

                    <div class="form-group">
                        <label>Tanggal *</label>

                        <input
                            type="date"
                            name="tanggal"
                            min="<?= date('Y-m-d') ?>"
                            required
                        >
                    </div>

                    <div class="form-group">
                        <label>Jam *</label>

                        <input
                            type="time"
                            name="jam"
                            required
                        >
                    </div>

                    <div class="form-group full">
                        <label>Catatan / Request</label>

                        <textarea
                            name="catatan"
                            rows="4"
                            placeholder="Contoh: makeup natural, warna soft pink, dll."
                        ></textarea>
                    </div>

                </div>

                <button
                    class="btn"
                    type="submit"
                >
                    📱 Booking & Kirim WhatsApp
                </button>

            </form>

        </div>

    </div>
</section>

<?php include "includes/footer.php"; ?>
CREATE DATABASE IF NOT EXISTS salon_makeup CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE salon_makeup;

CREATE TABLE admin (
 id_admin INT AUTO_INCREMENT PRIMARY KEY,
 username VARCHAR(50) NOT NULL UNIQUE,
 password VARCHAR(255) NOT NULL
);

CREATE TABLE layanan (
 id_layanan INT AUTO_INCREMENT PRIMARY KEY,
 nama_layanan VARCHAR(100) NOT NULL,
 deskripsi TEXT NOT NULL,
 harga INT NOT NULL,
 ikon VARCHAR(20) DEFAULT '💄'
);

CREATE TABLE galeri (
 id_galeri INT AUTO_INCREMENT PRIMARY KEY,
 judul VARCHAR(150) NOT NULL,
 gambar TEXT NOT NULL
);

CREATE TABLE booking (
 id_booking INT AUTO_INCREMENT PRIMARY KEY,
 nama VARCHAR(100) NOT NULL,
 no_hp VARCHAR(30) NOT NULL,
 email VARCHAR(120),
 id_layanan INT NOT NULL,
 tanggal DATE NOT NULL,
 jam TIME NOT NULL,
 catatan TEXT,
 status ENUM('Menunggu','Dikonfirmasi','Selesai','Dibatalkan') DEFAULT 'Menunggu',
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 FOREIGN KEY (id_layanan) REFERENCES layanan(id_layanan) ON DELETE CASCADE
);

INSERT INTO admin(username,password) VALUES
('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEaYf1f9fQ3K7jV5Z6w6p3n7G1e2');

INSERT INTO layanan(nama_layanan,deskripsi,harga,ikon) VALUES
('Makeup Natural','Makeup ringan dan fresh untuk tampilan sehari-hari.',150000,'💄'),
('Makeup Wisuda','Makeup elegan untuk hari wisuda dan foto bersama.',250000,'🎓'),
('Makeup Party','Makeup glam untuk pesta dan acara spesial.',300000,'✨'),
('Hairdo','Penataan rambut sesuai konsep acara.',150000,'💇'),
('Nail Art','Perawatan dan nail art dengan desain pilihan.',100000,'💅'),
('Facial Beauty','Perawatan wajah untuk membantu kulit terasa lebih segar.',125000,'🧖');

INSERT INTO galeri(judul,gambar) VALUES
('Makeup Look 1','https://images.unsplash.com/photo-1487412720507-e7ab37603c6f?auto=format&fit=crop&w=900&q=85'),
('Beauty Look','https://images.unsplash.com/photo-1526045478516-99145907023c?auto=format&fit=crop&w=900&q=85'),
('Salon Beauty','https://images.unsplash.com/photo-1560066984-138dadb4c035?auto=format&fit=crop&w=900&q=85'),
('Makeup Artist','https://images.unsplash.com/photo-1516975080664-ed2fc6a32937?auto=format&fit=crop&w=900&q=85'),
('Hair Styling','https://images.unsplash.com/photo-1562322140-8baeececf3df?auto=format&fit=crop&w=900&q=85'),
('Beauty Care','https://images.unsplash.com/photo-1512496015851-a90fb38ba796?auto=format&fit=crop&w=900&q=85');
CREATE DATABASE IF NOT EXISTS laboratory_inventory CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE laboratory_inventory;

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nama VARCHAR(100) NOT NULL,
  username VARCHAR(50) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  role ENUM('admin','staff') NOT NULL DEFAULT 'staff',
  aktif TINYINT(1) NOT NULL DEFAULT 1,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE barang (
  id INT AUTO_INCREMENT PRIMARY KEY,
  kode VARCHAR(20) NOT NULL UNIQUE,
  nama VARCHAR(120) NOT NULL,
  kategori VARCHAR(80) NOT NULL,
  stok INT NOT NULL DEFAULT 0,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE peminjaman (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nama_peminjam VARCHAR(120) NOT NULL,
  barang_id INT NOT NULL,
  jumlah INT NOT NULL,
  tanggal_pinjam DATE NOT NULL,
  tanggal_kembali DATE NULL,
  status ENUM('Dipinjam','Selesai') NOT NULL DEFAULT 'Dipinjam',
  petugas_id INT NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (barang_id) REFERENCES barang(id),
  FOREIGN KEY (petugas_id) REFERENCES users(id)
);

-- Password demo untuk kedua akun: password
-- Hash dibuat dengan password_hash('password', PASSWORD_DEFAULT)
INSERT INTO users (nama, username, password, role) VALUES
('Administrator', 'admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin'),
('Petugas Laboratorium', 'staff', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'staff');

INSERT INTO barang (kode,nama,kategori,stok) VALUES
('BR001','Laptop Lenovo','Laptop',5),
('BR002','Mouse Logitech','Aksesoris',10),
('BR003','Keyboard Mechanical','Aksesoris',8),
('BR004','Proyektor Epson','Proyektor',3),
('BR005','Monitor LG','Monitor',6);

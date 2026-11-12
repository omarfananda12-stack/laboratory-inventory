# Laboratory Inventory & Borrowing Management System

Aplikasi inventaris laboratorium berbasis HTML, CSS, Bootstrap, JavaScript, PHP, dan MySQL.

## Menjalankan di XAMPP
1. Salin folder `laboratory_inventory` ke `C:\xampp\htdocs\`.
2. Jalankan Apache dan MySQL dari XAMPP.
3. Buka `http://localhost/phpmyadmin`.
4. Pilih tab Import, pilih file `database.sql`, lalu klik Import/Go.
5. Periksa `config/database.php`. Default XAMPP: user `root`, password kosong.
6. Buka `http://localhost/laboratory_inventory`.

## Akun demo
- Admin: `admin` / `password`
- Staff: `staff` / `password`

Segera ganti password demo sebelum aplikasi dipublikasikan.

## Fitur
- Login dan pembatasan role Admin/Staff.
- Dashboard ringkasan.
- CRUD barang (Admin).
- Pengelolaan akun Staff (Admin).
- Peminjaman dan pengembalian barang (Admin dan Staff).
- Stok otomatis berkurang saat dipinjam dan bertambah saat dikembalikan.

## Catatan hosting
XAMPP hanya server lokal. Agar dosen dapat membuka aplikasi dari internet, unggah source code ke layanan hosting yang mendukung PHP dan MySQL, lalu buat database online dan sesuaikan kredensial di `config/database.php`. GitHub menyimpan source code, bukan menjalankan aplikasi PHP/MySQL secara otomatis.

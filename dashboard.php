<?php
require_once 'functions.php'; wajib_login();
$total=(int)$pdo->query("SELECT COUNT(*) FROM barang")->fetchColumn();
$tersedia=(int)$pdo->query("SELECT COALESCE(SUM(stok),0) FROM barang")->fetchColumn();
$dipinjam=(int)$pdo->query("SELECT COALESCE(SUM(jumlah),0) FROM peminjaman WHERE status='Dipinjam'")->fetchColumn();
$transaksi=(int)$pdo->query("SELECT COUNT(*) FROM peminjaman")->fetchColumn();
$recent=$pdo->query("SELECT p.*,b.nama AS barang,u.nama AS petugas FROM peminjaman p JOIN barang b ON b.id=p.barang_id JOIN users u ON u.id=p.petugas_id ORDER BY p.id DESC LIMIT 8")->fetchAll();
require 'partials/header.php';
?>
<h3>Dashboard</h3><p class="text-muted">Ringkasan aktivitas inventaris laboratorium.</p>
<div class="row g-3 mb-4">
<?php foreach([['Total jenis barang',$total],['Stok tersedia',$tersedia],['Barang sedang dipinjam',$dipinjam],['Total transaksi',$transaksi]] as $c): ?>
<div class="col-md-3"><div class="card stat-card"><div class="card-body"><div class="text-muted"><?=e($c[0])?></div><div class="display-6 fw-bold"><?=e($c[1])?></div></div></div></div>
<?php endforeach; ?>
</div>
<div class="card"><div class="card-header bg-white fw-bold">Aktivitas Terbaru</div><div class="table-responsive"><table class="table table-striped mb-0"><thead><tr><th>Peminjam</th><th>Barang</th><th>Jumlah</th><th>Tanggal</th><th>Status</th><th>Petugas</th></tr></thead><tbody>
<?php foreach($recent as $r): ?><tr><td><?=e($r['nama_peminjam'])?></td><td><?=e($r['barang'])?></td><td><?=e($r['jumlah'])?></td><td><?=e($r['tanggal_pinjam'])?></td><td><?=e($r['status'])?></td><td><?=e($r['petugas'])?></td></tr><?php endforeach; ?>
<?php if(!$recent): ?><tr><td colspan="6" class="text-center">Belum ada transaksi.</td></tr><?php endif; ?>
</tbody></table></div></div>
<?php require 'partials/footer.php'; ?>

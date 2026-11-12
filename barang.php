<?php
require_once '../functions.php'; wajib_login();
$rows=$pdo->query("SELECT * FROM barang ORDER BY nama")->fetchAll();
require '../partials/header.php';
?>
<h3>Daftar Barang</h3><p class="text-muted">Staff dapat melihat stok barang, tetapi tidak dapat menambah, mengubah, atau menghapus barang.</p>
<div class="card"><div class="card-body table-responsive"><table class="table table-striped"><thead><tr><th>Kode</th><th>Nama</th><th>Kategori</th><th>Stok Tersedia</th><th>Status</th></tr></thead><tbody>
<?php foreach($rows as $r): ?><tr><td><?=e($r['kode'])?></td><td><?=e($r['nama'])?></td><td><?=e($r['kategori'])?></td><td><?=e($r['stok'])?></td><td><?= $r['stok']>0?'Tersedia':'Habis' ?></td></tr><?php endforeach; ?>
</tbody></table></div></div>
<?php require '../partials/footer.php'; ?>

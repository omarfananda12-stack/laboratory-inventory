<?php
require_once 'functions.php'; wajib_login();
if(isset($_GET['kembali'])){
 $id=(int)$_GET['kembali'];
 try{
  $pdo->beginTransaction();$st=$pdo->prepare("SELECT * FROM peminjaman WHERE id=? AND status='Dipinjam' FOR UPDATE");$st->execute([$id]);$p=$st->fetch();
  if(!$p)throw new Exception();
  $st=$pdo->prepare("UPDATE barang SET stok=stok+? WHERE id=?");$st->execute([$p['jumlah'],$p['barang_id']]);
  $st=$pdo->prepare("UPDATE peminjaman SET status='Selesai',tanggal_kembali=? WHERE id=?");$st->execute([date('Y-m-d'),$id]);
  $pdo->commit();pesan('Pengembalian berhasil diproses.');
 }catch(Throwable $e){if($pdo->inTransaction())$pdo->rollBack();pesan('Pengembalian gagal atau transaksi sudah selesai.','danger');}
 header('Location: pengembalian.php');exit;
}
$rows=$pdo->query("SELECT p.*,b.nama barang FROM peminjaman p JOIN barang b ON b.id=p.barang_id ORDER BY p.id DESC")->fetchAll();
require 'partials/header.php';
?>
<h3>Pengembalian Barang</h3><div class="card"><div class="card-body table-responsive"><table class="table table-striped"><thead><tr><th>Peminjam</th><th>Barang</th><th>Jumlah</th><th>Tanggal Pinjam</th><th>Status</th><th>Aksi</th></tr></thead><tbody>
<?php foreach($rows as $r): ?><tr><td><?=e($r['nama_peminjam'])?></td><td><?=e($r['barang'])?></td><td><?=e($r['jumlah'])?></td><td><?=e($r['tanggal_pinjam'])?></td><td><?=e($r['status'])?></td><td><?php if($r['status']==='Dipinjam'): ?><a class="btn btn-sm btn-success" data-confirm="Proses pengembalian barang ini?" href="?kembali=<?=$r['id']?>">Proses Kembali</a><?php else: ?>- (<?=e($r['tanggal_kembali'])?>)<?php endif; ?></td></tr><?php endforeach; ?>
<?php if(!$rows): ?><tr><td colspan="6" class="text-center">Belum ada transaksi.</td></tr><?php endif; ?></tbody></table></div></div>
<?php require 'partials/footer.php'; ?>

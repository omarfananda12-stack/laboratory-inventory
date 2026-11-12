<?php
require_once 'functions.php'; wajib_login();
if($_SERVER['REQUEST_METHOD']==='POST'){
 $barang=(int)$_POST['barang_id'];$jumlah=(int)$_POST['jumlah'];$nama=trim($_POST['nama_peminjam']);$tgl=$_POST['tanggal_pinjam'];
 try{
  if($jumlah<1||$nama==='')throw new Exception();
  $pdo->beginTransaction();
  $st=$pdo->prepare("SELECT stok FROM barang WHERE id=? FOR UPDATE");$st->execute([$barang]);$b=$st->fetch();
  if(!$b||$b['stok']<$jumlah)throw new Exception();
  $st=$pdo->prepare("UPDATE barang SET stok=stok-? WHERE id=?");$st->execute([$jumlah,$barang]);
  $st=$pdo->prepare("INSERT INTO peminjaman(nama_peminjam,barang_id,jumlah,tanggal_pinjam,petugas_id) VALUES(?,?,?,?,?)");
  $st->execute([$nama,$barang,$jumlah,$tgl,$_SESSION['user']['id']]);
  $pdo->commit();pesan('Peminjaman berhasil dicatat.');
 }catch(Throwable $e){if($pdo->inTransaction())$pdo->rollBack();pesan('Peminjaman gagal. Periksa stok dan data yang diisi.','danger');}
 header('Location: peminjaman.php');exit;
}
$barang=$pdo->query("SELECT * FROM barang WHERE stok>0 ORDER BY nama")->fetchAll();
$rows=$pdo->query("SELECT p.*,b.nama barang FROM peminjaman p JOIN barang b ON b.id=p.barang_id ORDER BY p.id DESC")->fetchAll();
require 'partials/header.php';
?>
<h3>Transaksi Peminjaman</h3><div class="row g-3"><div class="col-lg-4"><div class="card"><div class="card-header fw-bold">Input Peminjaman</div><div class="card-body"><form method="post">
<label class="form-label">Nama Peminjam</label><input class="form-control mb-2" name="nama_peminjam" required>
<label class="form-label">Barang</label><select class="form-select mb-2" name="barang_id" required><option value="">Pilih barang</option><?php foreach($barang as $b): ?><option value="<?=$b['id']?>"><?=e($b['nama'])?> (stok <?=$b['stok']?>)</option><?php endforeach; ?></select>
<label class="form-label">Jumlah</label><input class="form-control mb-2" type="number" min="1" name="jumlah" required>
<label class="form-label">Tanggal Peminjaman</label><input class="form-control mb-3" type="date" name="tanggal_pinjam" value="<?=date('Y-m-d')?>" required>
<button class="btn btn-primary">Simpan Peminjaman</button></form></div></div></div>
<div class="col-lg-8"><div class="card"><div class="card-body table-responsive"><table class="table table-striped"><thead><tr><th>Peminjam</th><th>Barang</th><th>Jumlah</th><th>Tanggal</th><th>Status</th></tr></thead><tbody><?php foreach($rows as $r): ?><tr><td><?=e($r['nama_peminjam'])?></td><td><?=e($r['barang'])?></td><td><?=e($r['jumlah'])?></td><td><?=e($r['tanggal_pinjam'])?></td><td><?=e($r['status'])?></td></tr><?php endforeach; ?></tbody></table></div></div></div></div>
<?php require 'partials/footer.php'; ?>

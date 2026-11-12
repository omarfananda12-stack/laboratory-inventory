<?php
require_once '../functions.php'; admin_saja();
if($_SERVER['REQUEST_METHOD']==='POST'){
 $id=(int)($_POST['id']??0);$nama=trim($_POST['nama']);$username=trim($_POST['username']);$aktif=(int)($_POST['aktif']??1);$password=$_POST['password']??'';
 try{
  if($id){if($password!==''){$st=$pdo->prepare("UPDATE users SET nama=?,username=?,aktif=?,password=? WHERE id=? AND role='staff'");$st->execute([$nama,$username,$aktif,password_hash($password,PASSWORD_DEFAULT),$id]);}
  else{$st=$pdo->prepare("UPDATE users SET nama=?,username=?,aktif=? WHERE id=? AND role='staff'");$st->execute([$nama,$username,$aktif,$id]);}}
  else{if($password==='')throw new Exception();$st=$pdo->prepare("INSERT INTO users(nama,username,password,role,aktif) VALUES(?,?,?,'staff',?)");$st->execute([$nama,$username,password_hash($password,PASSWORD_DEFAULT),$aktif]);}
  pesan('Data Staff berhasil disimpan.');
 }catch(Throwable $e){pesan('Gagal menyimpan. Periksa username unik dan password.','danger');}
 header('Location: pengguna.php');exit;
}
$edit=null;if(isset($_GET['edit'])){$st=$pdo->prepare("SELECT * FROM users WHERE id=? AND role='staff'");$st->execute([(int)$_GET['edit']]);$edit=$st->fetch();}
$rows=$pdo->query("SELECT * FROM users WHERE role='staff' ORDER BY id DESC")->fetchAll();
require '../partials/header.php';
?>
<h3>Manajemen Staff</h3><div class="row g-3"><div class="col-lg-4"><div class="card"><div class="card-header fw-bold"><?= $edit?'Edit':'Tambah' ?> Staff</div><div class="card-body"><form method="post">
<input type="hidden" name="id" value="<?=e($edit['id']??'')?>"><label class="form-label">Nama</label><input class="form-control mb-2" name="nama" required value="<?=e($edit['nama']??'')?>"><label class="form-label">Username</label><input class="form-control mb-2" name="username" required value="<?=e($edit['username']??'')?>"><label class="form-label">Password <?= $edit?'(kosongkan jika tidak diubah)':'' ?></label><input class="form-control mb-2" type="password" name="password" <?= $edit?'':'required' ?>><label class="form-label">Status</label><select class="form-select mb-3" name="aktif"><option value="1" <?=(!$edit||$edit['aktif'])?'selected':''?>>Aktif</option><option value="0" <?=($edit&&!$edit['aktif'])?'selected':''?>>Nonaktif</option></select><button class="btn btn-primary">Simpan</button></form></div></div></div>
<div class="col-lg-8"><div class="card"><div class="card-body table-responsive"><table class="table"><thead><tr><th>Nama</th><th>Username</th><th>Status</th><th>Aksi</th></tr></thead><tbody><?php foreach($rows as $r): ?><tr><td><?=e($r['nama'])?></td><td><?=e($r['username'])?></td><td><?= $r['aktif']?'Aktif':'Nonaktif' ?></td><td><a class="btn btn-sm btn-warning" href="?edit=<?=$r['id']?>">Edit</a></td></tr><?php endforeach; ?></tbody></table></div></div></div></div>
<?php require '../partials/footer.php'; ?>

<?php require_once __DIR__ . '/../functions.php'; wajib_login(); ?>
<!doctype html><html lang="id"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title>Laboratory Inventory</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="<?= (str_contains($_SERVER['PHP_SELF'], '/admin/') || str_contains($_SERVER['PHP_SELF'], '/staff/')) ? '../' : '' ?>assets/css/style.css" rel="stylesheet">
</head><body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary"><div class="container">
<a class="navbar-brand fw-bold" href="<?= (str_contains($_SERVER['PHP_SELF'], '/admin/') || str_contains($_SERVER['PHP_SELF'], '/staff/')) ? '../' : '' ?>dashboard.php">LAB INVENTORY</a>
<div class="text-white ms-auto">Halo, <?= e($_SESSION['user']['nama']) ?> (<?= e(strtoupper($_SESSION['user']['role'])) ?>) |
<a class="text-white" href="<?= (str_contains($_SERVER['PHP_SELF'], '/admin/') || str_contains($_SERVER['PHP_SELF'], '/staff/')) ? '../' : '' ?>logout.php">Logout</a></div>
</div></nav><main class="container py-4">
<div class="mb-3 d-flex flex-wrap gap-2">
<a class="btn btn-outline-primary btn-sm" href="<?= (str_contains($_SERVER['PHP_SELF'], '/admin/') || str_contains($_SERVER['PHP_SELF'], '/staff/')) ? '../' : '' ?>dashboard.php">Dashboard</a>
<a class="btn btn-outline-primary btn-sm" href="<?= (str_contains($_SERVER['PHP_SELF'], '/admin/') || str_contains($_SERVER['PHP_SELF'], '/staff/')) ? '../' : '' ?>peminjaman.php">Peminjaman</a>
<a class="btn btn-outline-primary btn-sm" href="<?= (str_contains($_SERVER['PHP_SELF'], '/admin/') || str_contains($_SERVER['PHP_SELF'], '/staff/')) ? '../' : '' ?>pengembalian.php">Pengembalian</a>
<?php if ($_SESSION['user']['role']==='admin'): ?>
<a class="btn btn-outline-primary btn-sm" href="<?= (str_contains($_SERVER['PHP_SELF'], '/admin/') || str_contains($_SERVER['PHP_SELF'], '/staff/')) ? '../' : '' ?>admin/barang.php">Data Barang</a>
<a class="btn btn-outline-primary btn-sm" href="<?= (str_contains($_SERVER['PHP_SELF'], '/admin/') || str_contains($_SERVER['PHP_SELF'], '/staff/')) ? '../' : '' ?>admin/pengguna.php">Data Staff</a>
<?php else: ?>
<a class="btn btn-outline-primary btn-sm" href="<?= (str_contains($_SERVER['PHP_SELF'], '/admin/') || str_contains($_SERVER['PHP_SELF'], '/staff/')) ? '../' : '' ?>staff/barang.php">Daftar Barang</a>
<?php endif; ?>
</div>
<?php tampil_pesan(); ?>

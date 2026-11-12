<?php
require_once 'functions.php';
if (!empty($_SESSION['user'])) { header('Location: dashboard.php'); exit; }
$error = '';
if ($_SERVER['REQUEST_METHOD']==='POST') {
    $stmt=$pdo->prepare("SELECT * FROM users WHERE username=? AND aktif=1 LIMIT 1");
    $stmt->execute([trim($_POST['username'] ?? '')]); $u=$stmt->fetch();
    if ($u && password_verify($_POST['password'] ?? '', $u['password'])) {
        session_regenerate_id(true);
        $_SESSION['user']=['id'=>$u['id'],'nama'=>$u['nama'],'username'=>$u['username'],'role'=>$u['role']];
        header('Location: dashboard.php'); exit;
    } else $error='Username atau password salah / akun tidak aktif.';
}
?>
<!doctype html><html lang="id"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title>Login - Lab Inventory</title><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"><link href="assets/css/style.css" rel="stylesheet"></head>
<body class="login-bg"><div class="container"><div class="login-card card shadow"><div class="card-body p-4">
<h3 class="text-center mb-1">LAB INVENTORY</h3><p class="text-center text-muted mb-4">Silakan masuk ke akun Anda</p>
<?php if($error): ?><div class="alert alert-danger"><?=e($error)?></div><?php endif; ?>
<form method="post"><div class="mb-3"><label class="form-label">Username</label><input class="form-control" name="username" required autofocus></div>
<div class="mb-3"><label class="form-label">Password</label><input class="form-control" type="password" name="password" required></div>
<button class="btn btn-primary w-100">Login</button></form>
<hr><small class="text-muted">Demo Admin: admin / password<br>Demo Staff: staff / password</small>
</div></div></div></body></html>

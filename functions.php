<?php
if (session_status() === PHP_SESSION_NONE) session_start();
require_once __DIR__ . '/config/database.php';

function e($value) { return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8'); }
function wajib_login() {
    if (empty($_SESSION['user'])) { header('Location: login.php'); exit; }
}
function admin_saja() {
    wajib_login();
    if ($_SESSION['user']['role'] !== 'admin') { http_response_code(403); exit('Akses ditolak. Halaman ini khusus Admin.'); }
}
function pesan($text, $type='success') { $_SESSION['flash'] = ['text'=>$text, 'type'=>$type]; }
function tampil_pesan() {
    if (!empty($_SESSION['flash'])) {
        $f = $_SESSION['flash']; unset($_SESSION['flash']);
        echo '<div class="alert alert-'.e($f['type']).'">'.e($f['text']).'</div>';
    }
}

<?php
require_once 'functions.php';
header('Location: '.(empty($_SESSION['user']) ? 'login.php' : 'dashboard.php'));
exit;

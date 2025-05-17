<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: ../login.php');
    exit();
}
// Kiểm tra vai trò nếu cần
$allowed_roles =array(2); // Các vai trò được phép truy cập
if (!in_array($_SESSION['user']['role'], $allowed_roles)) {
    header('Location: ../login.php');
    exit();
}
?>
<?php
ini_set('session.cookie_lifetime', 0);
require_once '../check_login.php';
include("../class/clsdoimk.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Đổi mật khẩu NVBH</title>
  <link rel="stylesheet" href="../CSS/doimatkhau.css">
  <link rel="stylesheet" href="../CSS/style.css">

  <style>
     a {
      text-decoration: none; /* Xóa gạch chân */
      color: inherit; /* Giữ nguyên màu chữ */
    }
  </style>
</head>
<body>
<header class="header">
    <h1>Hệ Thống Quản Lý Kho</h1>
  </header>
  <div class="container">
    <aside class="sidebar">
      <ul>
        <li><a href="">Trang chủ</a></li>
        <li><a href="theodoisp.php">Theo dõi sản phẩm</a></li>
        <li><a href="yeucauxuatSP.php">Yêu cầu xuất sản phẩm</a></li>
        <li><a href="thongtin.php">Thông tin cá nhân</a></li>
      </ul>
      <button class="logout">Đăng xuất</button>
    </aside>
    <main class="content">
        <h2>Trang chủ</h2>

    </main>
  </div>
  <footer class="footer">
    <p>Bản quyền © 2025 - Hệ Thống Quản Lý Kho</p>
  </footer>
</body>
</html>

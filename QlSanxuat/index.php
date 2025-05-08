<?php
ini_set('session.cookie_lifetime', 0);
require_once '../check_login.php';
session_start();
include('../class/clstrangchu.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Thông tin QLSX</title>
  <link rel="stylesheet" href="../CSS/dropdown.css">
  <link rel="stylesheet" href="../CSS/style.css">
  <link rel="stylesheet" href="../CSS/trangchu.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>

</head>
<body>
<header class="header">
    <h1>Hệ Thống Quản Lý Kho</h1>
  </header>
  <div class="container">
    <aside class="sidebar">
      <ul>
        <li>Trang chủ</li>
        <li class="dropdown">
           Quản lý yêu cầu
          <ul class="dropdown-content">
            <li>Yêu cầu xuất nguyên liệu</li>
            <li>Yêu cầu sản xuất</li>
          </ul>
       </li>
        <li>Theo dõi sản phẩm</li>
        <li>Theo dõi nguyên liệu</li>
        <li>Thông tin cá nhân</li>
      </ul>
      <button class="logout">Đăng xuất</button>
    </aside>
    <main class="content">
    <div class="welcome-message">
    <h2>Xin chào quản lý sản xuất!</h2>
      <p>Chào mừng bạn đến với hệ thống</p>
    </div>
    <div class="stats-grid">
        <div class="stat-card">
            <i class="fas fa-clock"></i>
            <h3>Yêu cầu sản xuất chờ xử lý</h3>
            <div class="count"><?php echo $yeusx['total']; ?></div>
        </div>
        
        <div class="stat-card">
            <i class="fas fa-box-open" style="color: #e74c3c;"></i>
            <h3>Yêu cầu xuất nguyên liệu chờ xử lí</h3>
            <div class="count"><?php echo $yeuxuatnl['total']; ?></div>
        </div>
        </div>
  </main>
  </div>
  <footer class="footer">
    <p>Bản quyền © 2025 - Hệ Thống Quản Lý Kho</p>
  </footer>
</body>
</html>

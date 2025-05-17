<?php
ini_set('session.cookie_lifetime', 0);
require_once '../check_login3.php';
session_start();
include('../class/clstrangchu.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Trang chủ</title>

  <link rel="stylesheet" href="../CSS/style.css">
  <script src="../JS/thongbao.js" defer></script> 
  <script src="../JS/reset.js" defer></script> 
  <link rel="stylesheet" href="../CSS/trangchu.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
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
      <li><a href="index.php">Trang chủ</a></li>
        <li><a href="YCnhapNL.php">Yêu cầu nhập nguyên liệu</a></li>
        <li><a href="theodoisp.php">Theo dõi sản phẩm</a></li>
        <li><a href="theodoiNL.php">Theo dõi nguyên liệu</a></li>
        <li><a href="dskiemke.php">Kiểm kê nguyên liệu</a></li>
        <li><a href="dsQRNL.php">Tạo mã QR nguyên liệu</a></li>
        <li><a href="thongtin.php">Thông tin cá nhân</a></li>
      </ul>
      <button onclick="window.location.href='../logout.php'" class="logout">Đăng xuất</button>
    </aside>
    <main class="content">
    <div class="welcome-message">
    <h2>Xin chào quản lý kho!</h2>
      <p>Chào mừng bạn trở lại hệ thống quản lý kho</p>
    </div>
    <div class="stats-grid">
        <div class="stat-card">
            <i class="fas fa-clock"></i>
            <h3>Yêu cầu chờ xử lý</h3>
            <div class="count"><?php echo $yeucaunhap['total']; ?></div>
        </div>
        
        <div class="stat-card">
            <i class="fas fa-boxes" style="color: #e74c3c;"></i>
            <h3> Tổng Nguyên liệu hết hàng</h3>
            <div class="count"><?php echo $nl_hethang['total']; ?></div>
        </div>
        
        <div class="stat-card">
            <i class="fas fa-box-open" style="color: #e74c3c;"></i>
            <h3>Tổng Sản phẩm hết hàng</h3>
            <div class="count"><?php echo $sp_hethang['total']; ?></div>
        </div>
    </div>

    <div class="stats-grid">
        <div class="stat-card">
            <i class="fas fa-boxes"></i>
            <h3>Tổng nguyên liệu</h3>
            <div class="count"><?php echo $tong_nl['total']; ?></div>
        </div>
        <div class="stat-card">
            <i class="fas fa-box-open"></i>
            <h3>Tổng sản phẩm</h3>
            <div class="count"><?php echo $tong_sp['total']; ?></div>
        </div>
        <div class="stat-card">
            <i class="	fas fa-clipboard"></i>
            <h3>Tổng phiếu kiểm kê</h3>
            <div class="count"><?php echo $kiemke['total']; ?></div>
        </div>
    </div>
  </main>

  </div>
  <footer class="footer">
    <p>Bản quyền © 2025 - Hệ Thống Quản Lý Kho</p>
  </footer>
</body>
</html>

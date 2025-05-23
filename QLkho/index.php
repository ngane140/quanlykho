
<?php
ini_set('session.cookie_lifetime', 0);
require_once '../check_login.php';
session_start();
include('../class/clstrangchu.php');
?>

<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Trang chủ QLK</title>
  <link rel="stylesheet" href="../CSS/style.css">
  <link rel="stylesheet" href="../CSS/dropdown.css">
  <link rel="stylesheet" href="../CSS/trangchu.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
    <script src="../JS/dangxuat.js" defer></script> 
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
        <li><a href="quanlinv.php">Quản lý nhân viên kho</a></li>
        <li><a href="theodoisp.php">Quản lý sản phẩm</a></li>
        <li><a href="theodoiNL.php">Quản lý nguyên liệu</a></li>
        <li class="dropdown">
            Quản lý yêu cầu
            <ul class="dropdown-content">
              <li><a href="yeucauxuatNL.php">Đề xuất nhập nguyên liệu</a></li>
              <li><a href="yeucaunhapNL.php">Yêu cầu nhập nguyên liệu</a></li>
              <li><a href="yeucauSX.php">Yêu cầu sản xuất sản phẩm</a></li>
              <li><a href="yeucauxuatSP.php">Yêu cầu xuất sản phẩm</a></li>
            </ul>
       </li>
       <li><a href="dsQRSP.php">Tạo mã QR sản phẩm</a></li>
        <li><a href="thongtin.php">Thông tin cá nhân</a></li>
      </ul>
         <button onclick="confirmLogout()" class="logout">Đăng xuất</button>
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
            <div class="count"><?php echo $yeucau['total']; ?></div>
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
            <i class="	fas fa-user-gear"></i>
            <h3>Tổng Nhân viên</h3>
            <div class="count"><?php echo $tong_nv['total']; ?></div>
        </div>
    </div>
  </main>
</div>

<footer class="footer">
  <p>Bản quyền © 2025 - Hệ Thống Quản Lý Kho</p>
</footer>


</body>
</html>
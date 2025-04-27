<?php
ini_set('session.cookie_lifetime', 0);
require_once '../check_login.php';
include_once('../class/clsthongtin.php'); 

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Thông tin QLSX</title>
  <link rel="stylesheet" href="../CSS/cssthongtin.css">
  <link rel="stylesheet" href="../CSS/dropdown.css">
  <link rel="stylesheet" href="../CSS/style.css">
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
      <h1>Thông tin</h1>
      <div class="profile-card">
        <div class="avatar"></div>
        <h2><?php echo $row['hoTen']; ?></h2>
        <p><?php echo $row['tenLoaiNguoiDung']; ?><br></p>
        <button class="change-password"><a href="doimk.php">Đổi mật khẩu</a></button>
      </div>
      <div class="info-table">
      <p><strong>Mã nhân viên:</strong> <?php echo $row['username']; ?></p>
        <p><strong>Họ và tên:</strong> <?php echo $row['hoTen']; ?></p>
        <p><strong>Email:</strong> <?php echo $row['email']; ?></p>
        <p><strong>Số điện thoại:</strong> <?php echo $row['SDT']; ?></p>
        <p><strong>Ngày sinh:</strong> <?php echo $row['ngaysinh']; ?></p>
      </div>
    </main>
  </div>
  <footer class="footer">
    <p>Bản quyền © 2025 - Hệ Thống Quản Lý Kho</p>
  </footer>
</body>
</html>

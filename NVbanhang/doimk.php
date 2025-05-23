<?php
ini_set('session.cookie_lifetime', 0);
require_once '../check_login4.php';
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
  <script src="../JS/jquery-3.7.1.min.js"></script>
  <script src="../JS/thongbao.js" defer></script> 
  <script src="../JS/reset.js" defer></script>
  <script src="../JS/thongtin.js" defer></script> 
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
        <li><a href="theodoisp.php">Theo dõi sản phẩm</a></li>
        <li><a href="yeucauxuatSP.php">Yêu cầu xuất sản phẩm</a></li>
        <li><a href="thongtin.php">Thông tin cá nhân</a></li>
      </ul>
      <button onclick="confirmLogout()" class="logout">Đăng xuất</button>
    </aside>
    <main class="content">
        <h2>Thay đổi mật khẩu</h2>
      <!-- Hiển thị thông báo nếu có -->
        <?php if ($message): ?>
            <div class="message"><?php echo $message; ?></div>
        <?php endif; ?>
        <form class="password-form" method="POST" action="">
        <div class="input-group">
            <label for="oldPassword">Mật khẩu cũ</label>
            <input type="password" id="oldPassword" name="oldPassword" placeholder="Nhập mật khẩu cũ" required>
            
        </div>
        <div class="input-group">
            <label for="newPassword">Mật khẩu mới</label>
            <input type="password" id="newPassword" name="newPassword" placeholder="Nhập mật khẩu mới" required>
            <span id="errPW" class="err text-danger"></span>
        </div>
        <div class="input-group">
            <label for="confirmPassword">Xác nhận mật khẩu</label>
            <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Nhập lại mật khẩu mới" required>
        </div>  
        <div class="form-buttons">
            <button type="submit" name="btnsua" id="btnsua" class="button" value="Cập Nhật">Đổi mật khẩu</button>
            <button type="button" onclick="cancelChange()">Hủy bỏ</button>
        </div>
        </form>
    </main>
  </div>
  <footer class="footer">
    <p>Bản quyền © 2025 - Hệ Thống Quản Lý Kho</p>
  </footer>
</body>
</html>

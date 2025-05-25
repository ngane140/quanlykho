<?php
ini_set('session.cookie_lifetime', 0);
require_once '../check_login2.php';
include("../class/clsdoimk.php")
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>đổi mật khẩu QLSX</title>
  <link rel="stylesheet" href="../CSS/doimatkhau.css">
  <link rel="stylesheet" href="../CSS/dropdown.css">
  <link rel="stylesheet" href="../CSS/style.css">
  <script src="../JS/jquery-3.7.1.min.js"></script>
  <script src="../JS/thongbao.js" defer></script> 
  <script src="../JS/reset.js" defer></script> 
  <script src="../JS/thongtin.js" defer></script> 
    <script src="../JS/dangxuat.js" defer></script> 
</head>
<body>
<header class="header">
    <h1>Hệ Thống Quản Lý Kho</h1>
  </header>
  <div class="container">
    <aside class="sidebar">
      <ul>
                <li><a href="index.php" style="text-decoration: none; color: white;">Trang chủ</a></li>
                <li class="dropdown">
                  Quản lý yêu cầu
                  <ul class="dropdown-content">
                      <li><a href="guiyeucauxuatnguyenlieu.php">Đề xuất nhập nguyên liệu</a></li>
                      <li><a href="yeucausanxuat.php">Yêu cầu sản xuất sản phẩm</a></li>
                  </ul>
                </li>
                <li><a href="theodoiNL.php">Theo dõi nguyên liệu</a></li>
                <li><a href="thongtin.php" style="text-decoration: none;  color: white;">Thông tin cá nhân</a></li>
            </ul>
       </li>
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
    </main>
  </div>
  <footer class="footer">
    <p>Bản quyền © 2025 - Hệ Thống Quản Lý Kho</p>
  </footer>
</body>
</html>

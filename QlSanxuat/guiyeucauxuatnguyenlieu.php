<?php
ini_set('session.cookie_lifetime', 0);
require_once '../check_login2.php';
include("../docapi/clsguiycxnl.php");
$p = new docapi();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Đề xuất nhập nguyên liệu</title>
  <link rel="stylesheet" href="../CSS/style.css">
  <link rel="stylesheet" href="../CSS/danhsach.css">
  <link rel="stylesheet" href="../CSS/dropdown.css">
    <script src="../JS/dangxuat.js" defer></script> 
  <style>
     a {
      text-decoration: none; /* Xóa gạch chân */
      color: inherit; /* Giữ nguyên màu chữ */
    }
    .scrollable-table {
    max-height: 350px; /* hoặc chiều cao bạn muốn */
    overflow-y: auto;
    border: 1px solid #ccc; /* tùy chọn, giúp dễ nhìn */
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
        <li class="dropdown">
           Quản lý yêu cầu
          <ul class="dropdown-content">
            <li><a href="guiyeucauxuatnguyenlieu.php">Đề xuất nhập nguyên liệu</a></li>
            <li><a href="yeucausanxuat.php">Yêu cầu sản xuất sản phẩm</a></li>
          </ul>
       </li>
       <li><a href="theodoiNL.php">Theo dõi nguyên liệu</a></li>
        <li><a href="thongtin.php">Thông tin cá nhân</a></li>
      </ul>
       <button onclick="confirmLogout()" class="logout">Đăng xuất</button>
    </aside>
    <main class="content">
        <div class="header-section">
        <h2>Danh sách Đề xuất nhập nguyên liệu</h2>
        <button class="btn-create" name="nut" value="" type="button" onclick="window.location.href='taophieuxuatnguyenlieu.php'" style="margin-right: 50px;">+ Tạo phiếu</button>
        </div>
       
           <?php
                $p->xemdsyeucauxuatnl("http://localhost/kho/quanlykho/api/api_guiyeucauxuatNL.php");
           ?>
        
    </main>

    
</div>
<footer class="footer">
    <p>Bản quyền © 2025 - Hệ Thống Quản Lý Kho</p>
</footer>

</body>
</html>
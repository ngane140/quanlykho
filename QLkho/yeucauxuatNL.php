<?php
ini_set('session.cookie_lifetime', 0);
require_once '../check_login.php';
include("../docapi/clsnhanycxnl.php");
$p = new docapi();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Yêu cầu xuất Nguyên liệu</title>
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
        <h2>Danh sách Đề xuất nhập nguyên liệu</h2>
        
           <?php
           $p->xuatds("http://localhost/kho/quanlykho/api/api_yeucauxuatNL.php");
           
           ?>
           
    </main>

    
</div>
<footer class="footer">
    <p>Bản quyền © 2025 - Hệ Thống Quản Lý Kho</p>
</footer>

</body>
</html>
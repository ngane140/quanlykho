<?php
ini_set('session.cookie_lifetime', 0);
require_once '../check_login.php';
include("../class/clsdsnhanyeucausanxuatsp.php");
$p = new qlykho();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Yêu cầu xuất sản phẩm</title>
  <link rel="stylesheet" href="../CSS/style.css">
  <link rel="stylesheet" href="../CSS/danhsach.css">
  <link rel="stylesheet" href="../CSS/dropdown.css">
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
        <li>Trang chủ</li>
        <li class="dropdown">
           Quản lý yêu cầu
          <ul class="dropdown-content">
            <li>Yêu cầu xuất nguyên liệu</li>
            <li><a href="yeucausanxuat.php">Yêu cầu sản xuất sản phẩm</a></li>
          </ul>
       </li>
        <li>Theo dõi sản phẩm</li>
        <li>Theo dõi nguyên liệu</li>
        <li><a href="thongtin.php"></a>Thông tin cá nhân</li>
      </ul>
      <button class="logout">Đăng xuất</button>
    </aside>
    <main class="content">
        <h2>Danh sách yêu cầu sản xuấtxuất sản phẩm</h2>
        
           <?php
           $p->xemdsyeucausanxuatsp("select * from yeucausanxuatsanpham");
           
           ?>
           
    </main>

    
</div>
<footer class="footer">
    <p>Bản quyền © 2025 - Hệ Thống Quản Lý Kho</p>
</footer>

</body>
</html>
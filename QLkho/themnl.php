<?php
ini_set('session.cookie_lifetime', 0);
require_once '../check_login.php';
include("../class/clsthemnl.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Quản lí nguyên liệu</title>
  <link rel="stylesheet" href="../CSS/dropdown.css">
  <link rel="stylesheet" href="../CSS/style.css">
  <link rel="stylesheet" href="../CSS/themnv.css">
  <link rel="stylesheet" href="../CSS/danhsach.css">
  <link rel="stylesheet" href="../CSS/huy.css">
  <script src="../JS/thongbao.js"></script>
  <script src="../JS/dangxuat.js" defer></script> 
  <script src="../JS/donvitinh.js" defer></script> 

 
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
    <div class="form-container">
          <?php if (!empty($errorMessage)): ?>
              <div class="message">
                  <?php echo $errorMessage; ?>
              </div>
          <?php endif; ?>
            <h2>Thêm Nguyên Liệu</h2>
            <form action="" method="POST">
                <label for="maNL">Mã Nguyên liệu</label>
                <input type="text" id="maNL" name="maNL" value="<?php echo $NewMaterialCode; ?>" readonly>
              
                <label for="tenNguyenLieu">Tên Nguyên Liệu</label>
                <input type="text" id="tenNguyenLieu" name="tenNguyenLieu" required>

                <label for="HSDChoPhep">Ngày sử dụng tối đa</label>
                <input type="number" id="HSDChoPhep" name="HSDChoPhep" required min="1" step="1">

                <label for="moTa">Mô Tả</label>
                <input type="text" id="moTa" name="moTa">
                
                <label for="donGia">Giá</label>
                <input type="number" id="donGia" name="donGia" required min="1000" step="100">

                <label for="donViTinh">Đơn Vị Tính</label>
                <!-- <input type="text" id="donViTinh" name="donViTinh" required> -->
                 <input type="text" id="donViTinh" name="donViTinh" oninput="goiYDonViTinh()" autocomplete="off" required>
                 <span id="donViTinhLoi" style="color:red;"></span>


                <div class="form-buttons">
                    <button type="submit">Xác Nhận</button>
                    <button type="button" onclick="window.location.href='theodoiNL.php';">Hủy Bỏ</button>
                </div>
            </form>
        </div>
    </main>
</div>
<footer class="footer">
    <p>Bản quyền © 2025 - Hệ Thống Quản Lý Kho</p>
</footer>
</body>
</html>
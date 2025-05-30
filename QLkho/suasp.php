<?php
ini_set('session.cookie_lifetime', 0);
require_once '../check_login.php';
    include("../class/clssuasp.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Quản lí nhân viên kho</title>
  <link rel="stylesheet" href="../CSS/dropdown.css">
  <link rel="stylesheet" href="../CSS/style.css">
  <link rel="stylesheet" href="../CSS/themnv.css">
  <link rel="stylesheet" href="../CSS/danhsach.css">
  <link rel="stylesheet" href="../CSS/huy.css">
  <script src="../JS/thongbao.js" defer></script> 
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
        <div class="form-container">
            <?php if (!empty($errorMessage)): ?>
                <div class="message"><?php echo $errorMessage; ?></div>
            <?php endif; ?>
            <h2>Sửa Sản Phẩm</h2>
            <form action="suasp.php?maSP=<?php echo $product['maSP']; ?>" method="POST">
               <label for="maSP">Mã sản phẩm:</label>
                <input type="text" id="maSP" name="maSP" value="<?php echo $product['maSP']; ?>" readonly />

                <label for="tensanPham">Tên sản phẩm:</label>
                <input type="text" id="tensanPham" name="tensanPham" value="<?php echo $product['tensanPham']; ?>" readonly />
        
                <label for="HSDChoPhep">Ngày sử dụng tối đa</label>
                <input type="number" id="HSDChoPhep" name="HSDChoPhep" value="<?php echo $product['HSDChoPhep']; ?>" required min="1" step="1"  />

                <label for="moTa">Mô tả:</label>
                <input type="text" id="moTa" name="moTa" value="<?php echo $product['moTa']; ?>" />
           
                <label for="donGia">Đơn giá:</label>
                <input type="number" id="donGia" name="donGia" value="<?php echo number_format($product['donGia'], 0, '', ''); ?>" required min="1000" step="100" />
           
                <label for="donViTinh">Đơn vị tính:</label>
                <input type="text" id="donViTinh" name="donViTinh" value="<?php echo $product['donViTinh']; ?>"  readonly  />
            <div class="form-buttons">
                <button type="submit">Cập nhật</button>
                <button type="button" onclick="window.location.href='theodoisp.php';">Hủy bỏ</button>
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

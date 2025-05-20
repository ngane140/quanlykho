<?php
ini_set('session.cookie_lifetime', 0);
require_once '../check_login.php';
    include("../class/clschitietSP.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Danh sách Sản Phẩm</title>
  <link rel="stylesheet" href="../CSS/style.css">
  <link rel="stylesheet" href="../CSS/danhsach.css">
  <link rel="stylesheet" href="../CSS/dropdown.css">
  <link rel="stylesheet" href="../CSS/btnxoasua.css">
  <link rel="stylesheet" href="../CSS/btnql.css"> 
  <link rel="stylesheet" href="../CSS/btnfilter.css">
  <link rel="stylesheet" href="../CSS/chitietSP.css">
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
      <button onclick="window.location.href='../logout.php'" class="logout">Đăng xuất</button>
    </aside>
    <main class="content">
            <h2>Sản phẩm <?php echo $tensanPham; ?> </h2>
            <p><strong>Mã sản phẩm:</strong> <?php echo $maSP; ?></p> 
            <p><strong>Đơn giá:</strong> <?php echo number_format($donGia, 0, ',', '.'); ?> VNĐ</p>
            <p><strong>Số lượng:</strong> <?php echo $soLuong .' '. $donViTinh ?></p>
            <p><strong>Ngày sản xuất:</strong> <?php echo date('d/m/Y', strtotime($ngaySanXuat)); ?></p>
            <p><strong>Hạn sử dụng:</strong> <?php echo $ngayHetHan; ?></p>
            <p><strong>Mô tả:</strong> <?php echo !empty($moTa) ? nl2br($moTa) : 'Không có mô tả'; ?></p>
            <p><strong>Mã QR:</strong> 
            <?php 

                if (!empty($maQR)) {
                    echo "<img src='". $maQR . "' alt='QR Code' width='100' height='100'>";
                } else {
                    echo 'Chưa có';
                }
            ?>
            </p>
            <a href="dsQRSP.php"><button class="btn" style="float: right;">Quay lại</button></a>
              <!-- Form tạo mã QR -->
  
    <?php 
    // Kiểm tra nếu sản phẩm chưa có mã QR thì mới hiển thị nút tạo mã
    if (empty($maQR)) {
        // echo '<a href="dsQRSP.php"><button class="btn" style="float: right;">Quay lại</button></a>';
        echo '<form action="create_qr.php" method="post" id="createQRForm">
                  <input type="hidden" name="idSanPham" value="' . $idSanPham . '">
                  <input type="hidden" name="maSP" value="' . $maSP . '">
                  <input type="hidden" name="tensanPham" value="' . $tensanPham . '">
                  <input type="hidden" name="donGia" value="' . $donGia . '">
                  <input type="hidden" name="soLuong" value="' . $soLuong . '">
                  <input type="hidden" name="donViTinh" value="' . $donViTinh . '">
                  <input type="hidden" name="ngaySanXuat" value="' . $ngaySanXuat . '">
                  <input type="hidden" name="ngayHetHan" value="' . $ngayHetHan . '">
                  <input type="hidden" name="moTa" value="' . $moTa . '">
                  <button type="submit" class="btn" style="float: right;">Tạo QR</button>
              </form>';
    }
?>
</main>
<footer class="footer">
    <p>Bản quyền © 2025 - Hệ Thống Quản Lý Kho</p>
</footer>
</body>
</html>
<?php
ini_set('session.cookie_lifetime', 0);
require_once '../check_login.php';
include("../class/clschitietNL.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Đổi mật khẩu QLK</title>
  <link rel="stylesheet" href="../CSS/dropdown.css">
  <link rel="stylesheet" href="../CSS/btnxoasua.css">
  <link rel="stylesheet" href="../CSS/style.css">
  <link rel="stylesheet" href="../CSS/btnql.css"> 
  <link rel="stylesheet" href="../CSS/danhsach.css">
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
        <li><a href="YCnhapNL.php">Yêu cầu nhập nguyên liệu</a></li>
        <li><a href="theodoisp.php">Theo dõi sản phẩm</a></li>
        <li><a href="theodoiNL.php">Theo dõi nguyên liệu</a></li>
        <li><a href="dskiemke.php">Kiểm kê nguyên liệu</a></li>
        <li><a href="dsQRNL.php">Tạo mã QR nguyên liệu</a></li>
        <li><a href="thongtin.php">Thông tin cá nhân</a></li>
      </ul>
      <button onclick="window.location.href='../logout.php'" class="logout">Đăng xuất</button>
    </aside>
    <main class="content">
            <h2>Nguyên Liệu <?php echo $tenNguyenLieu; ?> </h2>
            <p><strong>Mã nguyên liệu:</strong> <?php echo $maNL; ?></p> 
            <p><strong>Đơn giá:</strong> <?php echo number_format($donGia, 0, ',', '.'); ?> VNĐ</p>
            <p><strong>Số lượng:</strong> <?php echo $soLuongTon .' '. $donViTinh ?></p>
            <p><strong>Ngày sản xuất:</strong> <?php echo date('d/m/Y', strtotime($ngayNhap)); ?></p>
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
            <a href="dsQRNL.php"><button class="btn" style="float: right;">Quay lại</button></a>
              <!-- Form tạo mã QR -->
  
    <?php 
    // Kiểm tra nếu sản phẩm chưa có mã QR thì mới hiển thị nút tạo mã
    if (empty($maQR)) {
        // echo '<a href="dsQRSP.php"><button class="btn" style="float: right;">Quay lại</button></a>';
        echo '<form action="create_qrNL.php" method="post" id="createQRForm">
                  <input type="hidden" name="idNguyenLieu" value="' . $idNguyenLieu . '">
                  <input type="hidden" name="maNL" value="' . $maNL . '">
                  <input type="hidden" name="tenNguyenLieu" value="' . $tenNguyenLieu . '">
                  <input type="hidden" name="donGia" value="' . $donGia . '">
                  <input type="hidden" name="soLuongTon" value="' . $soLuongTon . '">
                  <input type="hidden" name="donViTinh" value="' . $donViTinh . '">
                  <input type="hidden" name="ngayNhap" value="' . $ngayNhap . '">
                  <input type="hidden" name="ngayHetHan" value="' . $ngayHetHan . '">
                  <input type="hidden" name="moTa" value="' . $moTa . '">
                  <button type="submit" class="btn" style="float: right;">Tạo QR</button>
              </form>';
    }
?>
</main>
  </div>
  <footer class="footer">
    <p>Bản quyền © 2025 - Hệ Thống Quản Lý Kho</p>
  </footer>
</body>
</html>

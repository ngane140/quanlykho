<?php
include_once('../class/clschitietphieukiemke.php'); 

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Thông tin NVK</title>
  <link rel="stylesheet" href="../CSS/cssthongtin.css">
  <link rel="stylesheet" href="../CSS/style.css">
  <link rel="stylesheet" href="../CSS/danhsach.css">
  <link rel="stylesheet" href="../CSS/btnql.css"> 


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
      <li><a href="">Trang chủ</a></li>
        <li><a href="">Yêu cầu nhập nguyên liệu</a></li>
        <li><a href="theodoisp.php">Theo dõi sản phẩm</a></li>
        <li><a href="theodoiNL.php">Theo dõi nguyên liệu</a></li>
        <li><a href="dskiemke.php">Kiểm kê nguyên liệu</a></li>
        <li><a href="">Tạo mã QR nguyên liệu</a></li>
        <li><a href="thongtin.php">Thông tin cá nhân</a></li>
      </ul>
      <button class="logout">Đăng xuất</button>
    </aside>    
    <main class="content">
  <h1>Phiếu kiểm kê</h1>
  <?php if ($thongTin): ?>
    <p><strong>Mã phiếu:</strong> <?php echo $thongTin['maPhieu']; ?></p>
    <p><strong>Ngày kiểm kê:</strong> <?php echo $thongTin['ngayKiemKe']; ?></p>
    <p><strong>Người kiểm kê:</strong> <?php echo $thongTin['hoTen']; ?></p>
    <p><strong>Chức vụ:</strong> <?php echo $thongTin['tenLoaiNguoiDung']; ?></p>
<?php else: ?>
    <p>Không tìm thấy thông tin phiếu kiểm kê.</p>
<?php endif; ?>
 
  <table class="product-table">
    <thead>
      <tr>
        <th>STT</th>
        <th>Tên Nguyên Liệu</th>
        <th>Số Lượng tồn</th>
        <th>Số Lượng Thực Tế</th>
        <th>Chênh Lệch</th>
        <th>Ghi chú</th>
      </tr>
    </thead>
    <tbody>
  <?php 
  $stt = 1;
  if (!empty($resultChiTiet)):
    foreach ($resultChiTiet as $row): ?>
      <tr>
    
        <td><?php echo $stt++; ?></td>
        <td><?php echo $row['tenNguyenLieu']; ?></td>    
        <td><?php echo $row['soLuongKiemKe']; ?></td>
        <td><?php echo $row['soLuongThucTe']; ?></td> 
        <td><?php echo $row['soLuongChenhLech']; ?></td>
        <td><?php echo $row['ngayNhap']; ?></td>
      </tr>
    <?php endforeach; ?>
  <?php else: ?>
    <tr><td colspan="6">Không có dữ liệu kiểm kê.</td></tr>
  <?php endif; ?>
</tbody>
  </table>
  <br>
  <a href="dskiemke.php"><button class="btn" style="float: right;">Quay lại</button></a>
</main>
  </div>
  <footer class="footer">
    <p>Bản quyền © 2025 - Hệ Thống Quản Lý Kho</p>
  </footer>
</body>
</html>

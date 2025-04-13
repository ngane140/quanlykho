<?php
include_once('../class/clsthemphieukiemke.php'); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Thông tin NVK</title>
  <link rel="stylesheet" href="../CSS/cssthongtin.css">
  <link rel="stylesheet" href="../CSS/style.css">
  
  <link rel="stylesheet" href="../CSS/btnql.css"> 
  <link rel="stylesheet" href="../CSS/themphieukiemke.css"> 
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    const nguyenLieus = <?php echo json_encode($nguyenLieus); ?>;
    console.log(nguyenLieus);
  
</script>
<script src="../JS/themphieukiemke.js"></script>


  <style>
     a {
      text-decoration: none;
      color: inherit;
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
    <h2>Thêm Phiếu Kiểm Kê</h2>
    <?php if ($thongTinNguoiDung): ?>
    <div class="thongtin">
        <div class="box-item">
            <p><strong>Mã phiếu: </strong> <?php echo $maPhieu; ?></p>
        </div>
        <div class="box-item">
            <p><strong>Ngày: </strong><?php echo date('d/m/Y H:i:s'); ?></p>
        </div>
        <div class="box-item">
            <p><strong>Người kiểm kê: </strong><?php echo $thongTinNguoiDung['hoTen']; ?>
        </div>
        <div class="box-item">
            <p><strong>Chức vụ: </strong><?php echo $thongTinNguoiDung['chucVu']; ?></p>
        </div>
    </div>
<?php else: ?>
    <p style="color:red;">Không tìm thấy người dùng!</p>
<?php endif; ?>

    <form action="" method="POST">
    <div style="position: relative;">
        <input type="text" id="timNguyenLieu" placeholder="Tìm nguyên liệu...">
        <div id="goiYNguyenLieu"></div>
    </div>

    <div class="thanhcuon">
        <table class="product-table">
            <thead>
                <tr>
                    <th>Mã NL</th>
                    <th>Tên nguyên liệu</th>
                    <th>Số lượng tồn</th>
                    <th>Thực tế</th>
                    <th>Chênh lệch</th>
                    <th>Hạn sử Dụng</th>
                    <th>Xóa</th>
                </tr>
            </thead>
            <tbody id="tbodyNguyenLieu">
                <!-- Dòng được thêm động -->
            </tbody>
        </table>
    </div><br>
        <div style="float: right;">
            <button type="button" class="btnql" onclick="window.location.href='dskiemke.php'">Hủy bỏ</button>
            <button id="luuPhieu" class="btn">Lưu phiếu</button>
        </div>
        
    </form>
</main>
</div>

<footer class="footer">
  <p>Bản quyền © 2025 - Hệ Thống Quản Lý Kho</p>
</footer>


</body>
</html>

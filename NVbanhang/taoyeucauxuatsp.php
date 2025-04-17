<?php
include('../class/clsthemyeucauxuatSP.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Thông tin NVBH</title>
  <link rel="stylesheet" href="../CSS/cssthongtin.css">
  <link rel="stylesheet" href="../CSS/style.css">
  <link rel="stylesheet" href="../CSS/da,sach.css">
  <link rel="stylesheet" href="../CSS/btnql.css"> 
  <link rel="stylesheet" href="../CSS/themphieukiemke.css"> 
  <script src="../JS/themyeucauxuatSP.js"></script>
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
        <li><a href="theodoisp.php">Theo dõi sản phẩm</a></li>
        <li><a href="yeucauxuatSP.php">Yêu cầu xuất sản phẩm</a></li>
        <li><a href="thongtin.php">Thông tin cá nhân</a></li>
      </ul>
      <button class="logout">Đăng xuất</button>
    </aside>
    <main class="content">
<h2>Thêm Yêu Cầu Xuất Sản Phẩm</h2>

<form method="post" action="">

<table>
    <tr>
        <td><label for="maYC">Mã yêu cầu:</label></td>
        <td><input type="text" name="maYC" id="maYC" value="<?php echo $maYC; ?>" readonly></td>
    </tr>
    <tr>
        <td><label for="ngayYC">Ngày yêu cầu:</label></td>
        <td><input type="text" name="ngayYC" id="ngayYC" value="<?php echo $ngayTao; ?>" readonly></td>
    </tr>
    <tr>
        <td><label for="sdtKH">SĐT Khách Hàng:</label></td>
        <td>
            <input type="text" id="sdtKH" name="sdtKH">
            <button type="button" onclick="timKhachHang()">Tìm</button>
        </td>
    </tr>
    <tr>
        <td><label for="tenKH">Họ tên KH:</label></td>
        <td><input type="text" id="tenKH" name="tenKH" readonly></td>
    </tr>
</table>

   
    <div style="position: relative;">
        <input type="text" id="timSP" onkeyup="timSanPham()" autocomplete="off" placeholder="Tìm sản phẩm   ..">
        <input type="hidden" id="maSP">
        <div id="suggestions" style=" max-height: 80px; /* hoặc bao nhiêu tùy bạn, ví dụ 250px */
    overflow-y: auto;
    border: 1px solid #ccc;
    border-radius: 4px;
    background: white;
    position: absolute;
    z-index: 1000;
    width: 100%; /* hoặc cố định, ví dụ 300px nếu bạn thích */
    box-shadow: 0 4px 6px rgba(204, 182, 182, 0.1);"></div>
</div>
    <!-- Bảng hiển thị sản phẩm được chọn -->
    <div class="thanhcuon">
        <table class="product-table" id="bangSanPham" border="1" cellpadding="5" cellspacing="0">
            <thead>
                <tr>
                    <th>Mã sản phẩm</th>
                    <th>Tên sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Xóa</th>
                    
                </tr>
            </thead>
            <tbody>
                <!-- Dòng sản phẩm sẽ được thêm tại đây -->
            </tbody>
        </table>
    </div> <br>
        <div style="float: right;">
        <input type="hidden" id="idNguoiDung" name="idNguoiDung" value="<?php echo $idNguoiDung; ?>">

            <button type="button" class="btnql" onclick="window.location.href='yeucauxuatSP.php'">Hủy bỏ</button>
            <button id="luuPhieu" class="btn" onclick="kiemTraTruocKhiLuu(event)">Lưu phiếu</button>
        </div>
</form>

</body>
</html>

<?php
ini_set('session.cookie_lifetime', 0);
require_once '../check_login.php';
include('../class/clsthemYCnhapNL.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Thêm yêu cầu nhập nguyên liệu</title>
  <link rel="stylesheet" href="../CSS/cssthongtin.css">
  <link rel="stylesheet" href="../CSS/style.css">
  <link rel="stylesheet" href="../CSS/danhsach.css">
  <link rel="stylesheet" href="../CSS/btnql.css"> 
  <link rel="stylesheet" href="../CSS/dropdown.css">
  <link rel="stylesheet" href="../CSS/themphieukiemke.css"> 
  <script src="../JS/themyeucaunhapNL.js"></script>
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
              <li><a href="yeucauxuatNL.php">Yêu cầu xuất nguyên liệu</a></li>
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
<h2>Thêm Yêu Cầu Nhập Nguyên Liệu</h2>

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
</table>

   
    <div style="position: relative;">
        <input type="text" id="timSP" onkeyup="timNguyenLieu()" autocomplete="off" placeholder="Tìm nguyên liệu   ..">
        <input type="hidden" id="maSP">
        <div id="suggestions" style=" max-height: 80px; 
    overflow-y: auto;
    border: 1px solid #ccc;
    border-radius: 4px;
    background: white;
    position: absolute;
    z-index: 1000;
    width: 100%; 
    box-shadow: 0 4px 6px rgba(204, 182, 182, 0.1);"></div>
</div>
    <!-- Bảng hiển thị sản phẩm được chọn -->
    <div class="thanhcuon">
        <table class="product-table" id="bangNguyenLieu" border="1" cellpadding="5" cellspacing="0">
            <thead>
                <tr>
                    <th>Mã Nguyên Liệu</th>
                    <th>Tên Nguyên Liệu</th>
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
        
        <input type="hidden" id="idNguoiDung" name="idNguoiDung" value="<?php echo $_SESSION['user']['id']; ?>">

            <button type="button" class="btnql" onclick="window.location.href='yeucaunhapNL.php'">Hủy bỏ</button>
            <button id="luuPhieu" class="btn" onclick="kiemTraTruocKhiLuu(event)">Lưu phiếu</button>
        </div>
</form>

</body>
</html>

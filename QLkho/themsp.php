<?php
ini_set('session.cookie_lifetime', 0);
require_once '../check_login.php';
include("../class/clsthemsp.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Quản lí sản phẩm</title>
  <link rel="stylesheet" href="../CSS/dropdown.css">
  <link rel="stylesheet" href="../CSS/style.css">
  <link rel="stylesheet" href="../CSS/themnv.css">
  <link rel="stylesheet" href="../CSS/danhsach.css">
  <link rel="stylesheet" href="../CSS/huy.css">
  <script src="../JS/thongbao.js"></script>
  <script src="../JS/themNLtaoSP.js"></script>
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
              <div class="message">
                  <?php echo $errorMessage; ?>
              </div>
          <?php endif; ?>
            <h2>Thêm Sản Phẩm</h2>
            
            <form action="" method="POST">
              <div class="table-container">
            <table class="product-table">
                <label for="maSP">Mã Sản Phẩm</label>
                <input type="text" id="maSP" name="maSP" value="<?php echo $newProductCode; ?>" readonly>
              
                <label for="tensanPham">Tên Sản Phẩm</label>
                <input type="text" id="tensanPham" name="tensanPham" required>

                <label for="HSDChoPhep">Ngày sử dụng tối đa</label>
                <input type="number" id="HSDChoPhep" name="HSDChoPhep" required min="1" step="1">

                <label for="moTa">Mô Tả</label>
                <input type="text" id="moTa" name="moTa">
                
                <label for="donGia">Giá</label>
                <input type="number" id="donGia" name="donGia" required min="1000" step="100">

                <label for="donViTinh">Đơn Vị Tính</label>
                <input type="text" id="donViTinh" name="donViTinh" required>
                <!--  -->
                <h3>Nguyên liệu tạo thành</h3>
                <div id="nguyenlieu-container">
                    <div class="nguyenlieu-row">
                        <select name="nguyenlieu[]" required onchange="capNhatDonViTinh(this)">
                            <option value="">-- Chọn nguyên liệu --</option>
                            <?php
                            $kho = new quanlikho();
                            $conn = $kho->connect();
                            $result = $conn->query("SELECT maNL, tenNguyenLieu, donViTinh FROM nguyenlieu GROUP BY maNL");
                            while ($row = $result->fetch_assoc()) {
                                echo "<option value='" . $row['maNL'] . "' data-dvt='" . $row['donViTinh'] . "'>" . $row['tenNguyenLieu'] . " (" . $row['maNL'] . ")</option>";
                            }
                            ?>
                        </select>
                        <input type="number" name="soLuongNL[]" placeholder="Số lượng" required>
                        <input type="text" name="donViTinhNL[]" placeholder="Đơn vị tính" required readonly>
                        <button type="button" onclick="removeRow(this)">Xóa Nguyên liệu</button>
                    </div>
                </div>
                <button type="button" onclick="addNguyenLieu()">+ Thêm nguyên liệu</button>
           </table>
        </div>
                <!--  -->
                <div class="form-buttons">
                    <button type="submit">Xác Nhận</button>
                    <button type="button" onclick="window.location.href='theodoisp.php';">Hủy Bỏ</button>
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
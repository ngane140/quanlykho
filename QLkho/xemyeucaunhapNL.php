<?php
ini_set('session.cookie_lifetime', 0);
require_once '../check_login.php';
include('../class/clschitietyeucaunhapNL.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Yêu cầu xuất sản phẩm</title>
  <link rel="stylesheet" href="../CSS/style.css">
  <link rel="stylesheet" href="../CSS/danhsach.css">
  <link rel="stylesheet" href="../CSS/btnql.css"> 
  <link rel="stylesheet" href="../CSS/dropdown.css">
  <link rel="stylesheet" href="../CSS/themphieukiemke.css"> 
  <style>
     a {
      text-decoration: none; /* Xóa gạch chân */
      color: inherit; /* Giữ nguyên màu chữ */
    }
    .info-group {
        display: inline-block;
        min-width: 400px; /* bạn có thể điều chỉnh theo ý muốn */
        margin-bottom: 5px;
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
    <h2>Yêu cầu nhập Nguyên Liệu</h2>
    <!-- <form  method="post">
      <button class="btn-create" name="nut" value="Xac nhan xuat" type="submit" style="float: right;">Xác nhận Xuất</button>
    </form> -->
    <?php if ($thongTin): ?>
        <p>
        <span class="info-group"><strong>Mã phiếu:</strong> <?php echo "YCNNL" . $thongTin['idYeuCauNhapNL']; ?></span>  
    </p>
    <p>
    <span class="info-group"><strong>Ngày yêu cầu:</strong> <?php echo date("d/m/Y H:i", strtotime($thongTin['ngayYeuCau'])); ?></span>   
    </p>
<?php else: ?>
    <p>Không tìm thấy thông tin phiếu .</p>
<?php endif; ?>


    <div class="thanhcuon">
        <table class="product-table">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Mã Nguyên Liệu</th>
                    <th>Tên Nguyên Liệu</th>
                    <th>Số lượng Nhập</th>
                    <th>Đơn vị tính</th>
                    <th>Đơn giá</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $stt=1;
            if (!empty($chiTietSP)):
                foreach ($chiTietSP as $row): ?>
                  <tr>
                
                    <td><?php echo $stt++; ?></td>
                    <td><?php echo $row['maNL']; ?></td>   
                    <td><?php echo $row['tenNguyenLieu']; ?></td>    
                    <td><?php echo $row['soLuongNhap']; ?></td>
                    <td><?php echo $row['donViTinh']; ?></td> 
                    <td><?php echo number_format($row['donGia'], 0, ',', '.') . ' VNĐ'; ?></td>
                  </tr>
                <?php endforeach; ?>
              <?php else: ?>
                <tr><td colspan="6">Không có dữ liệu xuất.</td></tr>
              <?php endif; ?>
            </tbody>
              </table>
            </div> <br>
            
              <a href="yeucaunhapNL.php"><button class="btn" style="float: right;">Quay lại</button></a>
    </main>
</div>
<footer class="footer">
    <p>Bản quyền © 2025 - Hệ Thống Quản Lý Kho</p>
</footer>
</body>
</html>
<?php
include('../class/clsxemchitietyeucauxuatSP.php');
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
        <li><a href="">Trang chủ</a></li>
        <li><a href="theodoisp.php">Theo dõi sản phẩm</a></li>
        <li><a href="yeucauxuatSP.php">Yêu cầu xuất sản phẩm</a></li>
        <li><a href="thongtin.php">Thông tin cá nhân</a></li>
      </ul>
      <button class="logout">Đăng xuất</button>
    </aside>
    <main class="content">
    <h2>Yêu cầu xuất Sản Phẩm</h2>
    <?php if ($thongTin): ?>
        <p>
        <span class="info-group"><strong>Mã phiếu:</strong> <?php echo "YCXSP" . $thongTin['idYeuCauXuatSP']; ?></span>
        <span class="info-group"><strong>Ngày yêu cầu:</strong> <?php echo date("d/m/Y H:i", strtotime($thongTin['ngayYeuCau'])); ?></span>
    </p>
    <p>
        <span class="info-group"><strong>Khách hàng:</strong> <?php echo $thongTin['hoTen']; ?></span>
        <span class="info-group"><strong>Email:</strong> <?php echo $thongTin['email']; ?></span>
        
    </p>
    <p>
    <span class="info-group"><strong>SĐT:</strong> <?php echo $thongTin['SDT']; ?></span>
        <span class="info-group"><strong>Địa chỉ:</strong> <?php echo $thongTin['diaChi']; ?></span>
    </p>
<?php else: ?>
    <p>Không tìm thấy thông tin phiếu yêu cầu xuất sản phẩm.</p>
<?php endif; ?>
        
    <div class="thanhcuon">
        <table class="product-table">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Mã sản Phẩm</th>
                    <th>Tên sản phẩm</th>
                    <th>Số lượng xuất</th>
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
                    <td><?php echo $row['maSP']; ?></td>   
                    <td><?php echo $row['tensanPham']; ?></td>    
                    <td><?php echo $row['soLuongXuat']; ?></td>
                    <td><?php echo $row['donViTinh']; ?></td> 
                    <td><?php echo $row['donGia']; ?></td>
                  </tr>
                <?php endforeach; ?>
              <?php else: ?>
                <tr><td colspan="6">Không có dữ liệu xuất.</td></tr>
              <?php endif; ?>
            </tbody>
              </table>
            </div> <br>
              <a href="yeucauxuatSP.php"><button class="btn" style="float: right;">Quay lại</button></a>
    </main>
</div>
<footer class="footer">
    <p>Bản quyền © 2025 - Hệ Thống Quản Lý Kho</p>
</footer>
</body>
</html>
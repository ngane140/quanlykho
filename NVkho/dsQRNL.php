<?php
ini_set('session.cookie_lifetime', 0);
require_once '../check_login3.php';
include("../class/clsdsNLmaQR.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Đổi mật khẩu QLK</title>

  <link rel="stylesheet" href="../CSS/dropdown.css">
  <link rel="stylesheet" href="../CSS/danhsach.css">
  <link rel="stylesheet" href="../CSS/btnxoasua.css">
  <link rel="stylesheet" href="../CSS/style.css">
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
        <li><a href="YCnhapNL.php">Yêu cầu nhập nguyên liệu</a></li>
        <li><a href="theodoisp.php">Theo dõi sản phẩm</a></li>
        <li><a href="theodoiNL.php">Theo dõi nguyên liệu</a></li>
        <li><a href="dskiemke.php">Kiểm kê nguyên liệu</a></li>
        <li><a href="dsQRNL.php">Tạo mã QR nguyên liệu</a></li>
        <li><a href="thongtin.php">Thông tin cá nhân</a></li>
      </ul>
      < <button onclick="confirmLogout()" class="logout">Đăng xuất</button>
    </aside>
    <main class="content">
    <h2>Danh sách Nguyên Liệu</h2>
            <div class="table-container">
        <table class="product-table">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Mã nguyên liệu</th>
                    <th>Tên nguyên liệu</th>
                    <th>Số lượng</th>
                    <th>Hạn sử dụng</th>
                    <th>Tác vụ</th>

                </tr>
            </thead>
            <tbody>
                <?php
                if (count($products) > 0) {
                    foreach ($products as $index => $product) {
                                    // Tính ngày hết hạn
                    $ngayNhap = $product['ngayNhap'];
                    $hsdChoPhep = $product['HSDChoPhep'];

                    $ngayHetHan = '';
                    if (!empty($ngayNhap) && !empty($hsdChoPhep)) {
                        $date = new DateTime($ngayNhap);
                        $date->modify("+$hsdChoPhep days");
                        $ngayHetHan = $date->format('d/m/Y'); 
                    } else {
                        $ngayHetHan = 'Không xác định';
                    }

                        echo "<tr>";
                        echo "<td>" . ($index + 1) . "</td>";
                        echo "<td>" . $product['maNL'] . "</td>"; 
                        echo "<td>" . $product['tenNguyenLieu'] . "</td>"; 
                        echo "<td>" . $product['soLuongTon'] . "</td>"; 
                        echo "<td>" . $ngayHetHan . "</td>"; 
                    echo "<td>";
                        if (!empty($product['maQR'])) {
                            echo "<a href='xemchitietNL.php?id=" . $product['idNguyenLieu'] . "' class='btn-edit'>Xem</a>";
                        } else {
                            echo "<a href='xemchitietNL.php?id=" . $product['idNguyenLieu'] . "' class='btn-edit'>Tạo mã QR</a>";
                        }
                        echo "</td>";
                    }
                } else {
                    echo "<tr><td colspan='6'>Không có nguyên liệu nào!</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    
    </main>
  </div>
  <footer class="footer">
    <p>Bản quyền © 2025 - Hệ Thống Quản Lý Kho</p>
  </footer>
</body>
</html>

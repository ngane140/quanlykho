<?php
ini_set('session.cookie_lifetime', 0);
require_once '../check_login.php';
    include("../class/clsdsSPmaQR.php");
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
  <link rel="stylesheet" href="../CSS/btnfilter.css">
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
              <li><a href="">Yêu cầu xuất nguyên liệu</a></li>
              <li><a href="yeucaunhapNL.php">Yêu cầu nhập nguyên liệu</a></li>
              <li><a href="yeucauSX.php">Yêu cầu sản xuất</a></li>
              <li><a href="yeucauxuatSP.php">Yêu cầu xuất sản phẩm</a></li>
            </ul>
       </li>
        <li><a href="dsQRSP.php">Tạo mã QR sản phẩm</a></li>
        <li><a href="thongtin.php">Thông tin cá nhân</a></li>
      </ul>
      <button onclick="window.location.href='../logout.php'" class="logout">Đăng xuất</button>
    </aside>
    <main class="content">
            <h2>Danh sách sản phẩm </h2>
            <div class="table-container">
        <table class="product-table">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Mã sản phẩm</th>
                    <th>Tên sản phẩm</th>
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
                    $ngaySanXuat = $product['ngaySanXuat'];
                    $hsdChoPhep = $product['HSDChoPhep'];

                    $ngayHetHan = '';
                    if (!empty($ngaySanXuat) && !empty($hsdChoPhep)) {
                        $date = new DateTime($ngaySanXuat);
                        $date->modify("+$hsdChoPhep days");
                        $ngayHetHan = $date->format('d/m/Y'); 
                    } else {
                        $ngayHetHan = 'Không xác định';
                    }

                        echo "<tr>";
                        echo "<td>" . ($index + 1) . "</td>";
                        echo "<td>" . $product['maSP'] . "</td>"; 
                        echo "<td>" . $product['tensanPham'] . "</td>"; 
                        echo "<td>" . $product['soLuong'] . "</td>"; 
                        echo "<td>" . $ngayHetHan . "</td>"; 
                    //     echo "<td>
                    //     <a href='xemchitietsp.php?id=" . $product['idSanPham'] . "' class='btn-edit'>xem</a>
                    //   </td>";
                    echo "<td>";
                        if (!empty($product['maQR'])) {
                            echo "<a href='xemchitietsp.php?id=" . $product['idSanPham'] . "' class='btn-edit'>Xem</a>";
                        } else {
                            echo "<a href='xemchitietsp.php?id=" . $product['idSanPham'] . "' class='btn-edit'>Tạo mã QR</a>";
                        }
                        echo "</td>";
                    }
                } else {
                    echo "<tr><td colspan='6'>Không có sản phẩm nào!</td></tr>";
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
<?php
    ini_set('session.cookie_lifetime', 0);
require_once '../check_login4.php';
    include("../class/clsxemsp.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Theo dõi sản phẩm</title>
  <link rel="stylesheet" href="../CSS/style.css">
  <link rel="stylesheet" href="../CSS/danhsach.css">
  <link rel="stylesheet" href="../CSS/btnfilter.css">
    <script src="../JS/dangxuat.js" defer></script> 
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
        <li><a href="index.php">Trang chủ</a></li>
        <li><a href="theodoisp.php">Theo dõi sản phẩm</a></li>
        <li><a href="yeucauxuatSP.php">Yêu cầu xuất sản phẩm</a></li>
        <li><a href="thongtin.php">Thông tin cá nhân</a></li>
      </ul>
      <button onclick="confirmLogout()" class="logout">Đăng xuất</button>
    </aside>
    <main class="content">
        <h2>Danh sách sản phẩm tồn kho</h2>
        <div class="filter-buttons">
                <a href="?filter=available">
                    <button class="btn-filter  <?php echo ($filter === 'available') ? 'active' : ''; ?>">Còn hàng</button>
                </a>
                <a href="?filter=outofstock">
                    <button class="btn-filter  <?php echo ($filter === 'outofstock') ? 'active' : ''; ?>">Hết hàng</button>
                </a>
                <a href="theodoisp.php">
                    <button class="btn-filter  <?php echo ($filter === '') ? 'active' : ''; ?>">Tất cả</button>
                </a>
            </div>
     <div class="table-container">
        <table class="product-table">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Mã sản phẩm</th>
                    <th>Tên sản phẩm</th>
                    <th>Đơn vị tính</th>
                    <th>Số lượng tồn kho</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (count($products) > 0) {
                    foreach ($products as $index => $product) {
                        echo "<tr>";
                        echo "<td>" . ($index + 1) . "</td>";
                        echo "<td>" . $product['maSP'] . "</td>"; 
                        echo "<td>" . $product['tensanPham'] . "</td>"; 
                        echo "<td>" . $product['donViTinh'] . "</td>"; 
                        echo "<td>" . $product['tongSoLuong'] . "</td>"; 
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>Không có sản phẩm nào!</td></tr>";
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
<?php
ini_set('session.cookie_lifetime', 0);
require_once '../check_login.php';
    include("../class/clsxemnl.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Theo dõi nguyên liệu</title>
  <link rel="stylesheet" href="../CSS/dropdown.css">
  <link rel="stylesheet" href="../CSS/style.css">
  <link rel="stylesheet" href="../CSS/danhsach.css">
  <link rel="stylesheet" href="../CSS/btnxoasua.css">
  <link rel="stylesheet" href="../CSS/btnfilter.css">
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
    <div class="header-section">
            <h2>Danh sách nguyên liệu</h2>
           
            <a href="themnl.php">
                <button class="btn-create">+ Thêm Nguyên Liệu</button>
            </a></div>
            <div class="filter-buttons">
                <a href="?filter=available">
                    <button class="btn-filter  <?php echo ($filter === 'available') ? 'active' : ''; ?>">Còn hàng</button>
                </a>
                <a href="?filter=outofstock">
                    <button class="btn-filter  <?php echo ($filter === 'outofstock') ? 'active' : ''; ?>">Hết hàng</button>
                </a>
                <a href="theodoiNL.php">
                    <button class="btn-filter  <?php echo ($filter === '') ? 'active' : ''; ?>">Tất cả</button>
                </a>
            </div>
            <div class="table-container">
        <table class="product-table">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Mã nguyên liệu</th>
                    <th>Tên nguyên liệu</th>
                    <th>Đơn vị tính</th>
                    <th>Số lượng tồn kho</th>
                    <th>Tác vụ</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (count($products) > 0) {
                    foreach ($products as $index => $product) {
                        echo "<tr>";
                        echo "<td>" . ($index + 1) . "</td>";
                        echo "<td>" . $product['maNL'] . "</td>"; 
                        echo "<td>" . $product['tenNguyenLieu'] . "</td>"; 
                        echo "<td>" . $product['donViTinh'] . "</td>"; 
                        $value = $product['tongSoLuongTon'];
                            if (fmod($value, 1) == 0) {
                                echo "<td>" . (int)$value . "</td>";
                            } else {
                                echo "<td>" . rtrim(rtrim(number_format($value, 4), '0'), '.') . "</td>";
                            }

                        echo "<td>

                    <a href='../class/clsxoanl.php?maNL=" . $product['maNL'] . "' class='btn-delete' onclick=\"return confirm('Bạn có chắc chắn muốn xóa nguyên liệu này không?');\">Xóa</a>
                       <a href='suanl.php?maNL=" . $product['maNL'] . "' class='btn-edit'>Sửa</a>
                      </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan=''>Không có nguyên liệu nào!</td></tr>";
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
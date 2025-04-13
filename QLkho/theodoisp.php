<?php
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
        <li><a href="">Trang chủ</a></li>
        <li><a href="quanlinv.php">Quản lý nhân viên kho</a></li>
        <li><a href="theodoisp.php">Quản lý sản phẩm</a></li>
        <li><a href="theodoiNL.php">Quản lý nguyên liệu</a></li>
        <li class="dropdown">
            Quản lý yêu cầu
            <ul class="dropdown-content">
              <li><a href="">Yêu cầu xuất nguyên liệu</a></li>
              <li><a href="">Yêu cầu nhập nguyên liệu</a></li>
              <li><a href="yeucausanxuat.php">Yêu cầu sản xuất</a></li>
              <li><a href="yeucauxuatSP.php">Yêu cầu xuất sản phẩm</a></li>
            </ul>
       </li>
        <li><a href="">Tạo mã QR sản phẩm</a></li>
        <li><a href="thongtin.php">Thông tin cá nhân</a></li>
      </ul>
      <button class="logout">Đăng xuất</button>
    </aside>
    <main class="content">
        <div class="header-section">
            <h2>Danh sách sản phẩm </h2>
            <a href="themsp.php">
                <button class="btn-create">+ Thêm Sản Phẩm</button>
            </a>
        </div>
        <div class="filter-buttons">
                <a href="?id=<?php echo $id; ?>&filter=available">
                    <button class="btn-filter  <?php echo ($filter === 'available') ? 'active' : ''; ?>">Còn hàng</button>
                </a>
                <a href="?id=<?php echo $id; ?>&filter=outofstock">
                    <button class="btn-filter  <?php echo ($filter === 'outofstock') ? 'active' : ''; ?>">Hết hàng</button>
                </a>
                <a href="?id=<?php echo $id; ?>">
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
                    <th>Đơn Giá</th>
                    <th>Tác vụ</th>

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
                        echo "<td>" . $product['soLuong'] . "</td>"; 
                        echo "<td>" . number_format($product['donGia'], 0, ',', '.') . " VND</td>"; 
                        echo "<td>
                        <a href='../class/clsxoasp.php?id=" . $product['idSanPham'] . "' class='btn-delete' onclick=\"return confirm('Bạn có chắc chắn muốn xóa sản phẩm này không?');\">Xóa</a>
                        <a href='suasp.php?id=" . $product['idSanPham'] . "' class='btn-edit'>Sửa</a>
                      </td>";
                        echo "</tr>";
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
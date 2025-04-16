<?php
include("../class/clsdskiemke.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Phiếu Kiểm Kê</title>
  <link rel="stylesheet" href="../CSS/style.css">
  <link rel="stylesheet" href="../CSS/danhsach.css">
  <link rel="stylesheet" href="../CSS/btnxoasua.css">
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
        <li><a href="">Yêu cầu nhập nguyên liệu</a></li>
        <li><a href="theodoisp.php">Theo dõi sản phẩm</a></li>
        <li><a href="theodoiNL.php">Theo dõi nguyên liệu</a></li>
        <li><a href="dskiemke.php">Kiểm kê nguyên liệu</a></li>
        <li><a href="">Tạo mã QR nguyên liệu</a></li>
        <li><a href="thongtin.php">Thông tin cá nhân</a></li>
      </ul>
      <button class="logout">Đăng xuất</button>
    </aside>
    <main class="content">
        
        <div class="header-section">
        <h2>Danh Sách phiếu kiểm kê</h2>
            <a href="themphieukiemke.php">
                <button class="btn-create">+ Thêm phiếu kiểm kê</button>
            </a>
        </div>
        <div class="table-container">
        <table class="product-table">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Mã Phiếu</th>
                    <th>Ngày Kiểm Kê</th>
                    <th>Người Kiểm Kê</th>
                    <th>Chức vụ</th>
                    <th>Tác vụ</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (count($kiemke) > 0)  {
                    foreach ($kiemke as $index => $row) {
                        echo "<tr>";
                        echo "<td>" . ($index + 1) . "</td>";
                        echo "<td>" . $row['maPhieu'] . "</td>";
                        echo "<td>" . date("d/m/Y H:i", strtotime($row['ngayKiemKe'])) . "</td>";

                        echo "<td>" . $row['hoTen'] . "</td>";
                        echo "<td>" . $row['tenLoaiNguoiDung'] . "</td>";
                        echo "<td>
                          <a href='xemphieukiemke.php?id=" . $row['idPhieuKiemKe'] . "' class='btn-edit'>xem</a>

                              </td>";
                              
                              
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>Không có phiếu nào.</td></tr>";
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

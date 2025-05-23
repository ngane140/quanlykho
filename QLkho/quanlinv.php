<?php
ini_set('session.cookie_lifetime', 0);
require_once '../check_login.php';
    include("../class/clsdsnhanvien.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Quản lí nhân viên kho</title>
  <link rel="stylesheet" href="../CSS/dropdown.css">
  <link rel="stylesheet" href="../CSS/style.css">
  <link rel="stylesheet" href="../CSS/danhsach.css">
  <link rel="stylesheet" href="../CSS/btnxoasua.css">
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
            <h2>Danh sách nhân viên kho</h2>
            <a href="themnv.php">
                <button class="btn-create">+ Thêm Nhân Viên</button>
            </a>
        </div>
        <div class="table-container">
        <table class="product-table">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Mã Nhân Viên</th>
                    <th>Tên Nhân viên</th>
                    <th>SDT</th>
                    <th>Email</th>
                    <th>Địa Chỉ</th>
                    <th>Ngày Sinh</th>
                    <th>Tác vụ</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Hiển thị danh sách nhân viên nếu có dữ liệu
                if (count($employees) > 0)  {
                    foreach ($employees as $index => $employee) {
                        echo "<tr>";
                        echo "<td>" . ($index + 1) . "</td>";
                        echo "<td>" . $employee['username'] . "</td>";
                        echo "<td>" . $employee['hoTen'] . "</td>";
                        echo "<td>" . $employee['SDT'] . "</td>";
                        echo "<td>" . $employee['email'] . "</td>";
                        echo "<td>" . $employee['diaChi'] . "</td>";
                        echo "<td>" . $employee['ngaysinh'] . "</td>";
                        echo "<td>
                        <a href='../class/clsxoanv.php?id=" . $employee['idNguoiDung'] . "' class='btn-delete' onclick=\"return confirm('Bạn có chắc chắn muốn xóa nhân viên này không?');\">Xóa</a>
                        <a href='suanv.php?id=" . $employee['idNguoiDung'] . "' class='btn-edit'>Sửa</a>
                      </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='8'>Không có nhân viên kho nào.</td></tr>";
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

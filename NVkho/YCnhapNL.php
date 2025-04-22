<?php
ini_set('session.cookie_lifetime', 0);
require_once '../check_login.php';
include("../class/clsdsyeucaunhapNL.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Yêu cầu sản xuất</title>
  <link rel="stylesheet" href="../CSS/style.css">
  <link rel="stylesheet" href="../CSS/danhsach.css">
  <link rel="stylesheet" href="../CSS/dropdown.css">
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
        <h2>Danh Sách Yêu Cầu Nhập Nguyên Liệu</h2>
        <div class="table-container">
        <table class="product-table">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Mã yêu cầu</th>
                    <th>Ngày yêu cầu</th>
                    <th>Trạng thái</th>
                    <th>Tác vụ</th>
                </tr>
            </thead>
            <tbody>
            <?php
                if (count($danhsach) > 0)  {
                    foreach ($danhsach as $index => $row) {
                        echo "<tr>";
                        echo "<td>" . ($index + 1) . "</td>";
                        echo "<td> YCNNL" . $row['idYeuCauNhapNL'] . "</td>";
                        echo "<td>" . date("d/m/Y H:i", strtotime($row['ngayYeuCau'])) . "</td>";
                        $status = '';
                        switch ($row['trangThai']) {
                            case 0:
                                $status = "Chờ nhập";
                                break;
                            case 1:
                                $status = "Đã nhập";
                                break;
                            default:
                               break;
                        }

                        echo "<td>" . $status . "</td>";

                        echo "<td>
                          <a href='nhanYCnhapNL.php?id=" . $row['idYeuCauNhapNL'] . "' class='btn-edit'>xem</a>

                              </td>";
                              
                              
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>Không có phiếu nào.</td></tr>";
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
<?php
ini_set('session.cookie_lifetime', 0);
require_once '../check_login.php';
include("../class/clsdsyeucauSX.php");
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
        <h2>Danh Sách Yêu Cầu Sản Xuất Sản Phẩm</h2>
            <a href="themyeucauSX.php">
                <button class="btn-create">+ Tạo yêu cầu</button>
            </a>
        </div>
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
                        echo "<td> YCSXSP" . $row['idYeuCauSXSP'] . "</td>";
                        echo "<td>" . date("d/m/Y H:i", strtotime($row['ngayYeuCau'])) . "</td>";
                        $status = '';
                        switch ($row['trangThai']) {
                            case 0:
                                $status = "Chờ Sản Xuất";
                                break;
                            case 1:
                                $status = "Chờ nhập nguyên liệu";
                                break;
                            case 2:
                                $status = "Đang sản xuất";
                                break;
                            case 3:
                                $status = "Đã sản xuất";
                                break;
                            default:
                               break;
                        }

                        echo "<td>" . $status . "</td>";

                        echo "<td>
                          <a href='xemyeucauSX.php?id=" . $row['idYeuCauSXSP'] . "' class='btn-edit'>xem</a>

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
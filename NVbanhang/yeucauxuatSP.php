<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Yêu cầu xuất sản phẩm</title>
  <link rel="stylesheet" href="../CSS/style.css">
  <link rel="stylesheet" href="../CSS/danhsach.css">
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
        <li><a href="theodoisp.php">Theo dõi sản phẩm</a></li>
        <li><a href="yeucauxuatSP.php">Yêu cầu xuất sản phẩm</a></li>
        <li><a href="thongtin.php">Thông tin cá nhân</a></li>
      </ul>
      <button class="logout">Đăng xuất</button>
    </aside>
    <main class="content">
        <div class="header-section">
            <h2>Danh sách yêu cầu xuất sản phẩm</h2>
            <button class="btn-create" onclick="openCreateRequest()">+ Thêm Yêu Cầu</button>
        </div>
        <table class="product-table">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Mã yêu cầu</th>
                    <th>Tên khách hàng</th>
                    <th>Ngày yêu cầu</th>
                    <th>Trạng thái</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>SP001</td>
                    <td>Tên khách hàng</td>
                    <td>Cái</td>
                    <td>Xác nhận xuất</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>SP001</td>
                    <td>Tên khách hàng</td>
                    <td>Cái</td>
                    <td>Chờ sản xuất</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>SP001</td>
                    <td>Tên khách hàng</td>
                    <td>Cái</td>
                    <td>Từ chối</td>
                </tr>
            </tbody>
        </table>
    </main>
</div>
<footer class="footer">
    <p>Bản quyền © 2025 - Hệ Thống Quản Lý Kho</p>
</footer>
</body>
</html>
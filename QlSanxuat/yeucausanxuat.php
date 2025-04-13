<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Yêu cầu sản xuất</title>
  <link rel="stylesheet" href="../CSS/style.css">
  <link rel="stylesheet" href="../CSS/danhsach.css">
  <link rel="stylesheet" href="../CSS/dropdown.css">
</head>
<body>
<header class="header">
    <h1>Hệ Thống Quản Lý Kho</h1>
</header>
<div class="container">
    <aside class="sidebar">
      <ul>
        <li>Trang chủ</li>
        <li class="dropdown">
           Quản lý yêu cầu
          <ul class="dropdown-content">
            <li>Yêu cầu xuất nguyên liệu</li>
            <li>Yêu cầu sản xuất</li>
          </ul>
       </li>
        <li>Theo dõi sản phẩm</li>
        <li>Theo dõi nguyên liệu</li>
        <li>Thông tin cá nhân</li>
      </ul>
      <button class="logout">Đăng xuất</button>
    </aside>
    <main class="content">
            <h2>Danh sách yêu cầu sản xuất</h2>
        <table class="product-table">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Mã yêu cầu</th>
                    <th>Ngày yêu cầu</th>
                    <th>Trạng thái</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>SP001</td>
                    <td>Cái</td>
                    <td>Đã sản xuất</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>SP001</td>
                    <td>Cái</td>
                    <td>Chờ nguyên liệu</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>SP001</td>
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
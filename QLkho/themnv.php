<?php
    include("../class/clsthemnv.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Quản lí nhân viên kho</title>
  <link rel="stylesheet" href="../CSS/dropdown.css">
  <link rel="stylesheet" href="../CSS/style.css">
  <link rel="stylesheet" href="../CSS/themnv.css">
  <link rel="stylesheet" href="../CSS/danhsach.css">
  <link rel="stylesheet" href="../CSS/huy.css">
 
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
    <div class="form-container">
          <?php if (!empty($errorMessage)): ?>
              <div class="message">
                  <?php echo $errorMessage; ?>
              </div>
          <?php endif; ?>
            <h2>Thêm Nhân Viên</h2>
            <form action="" method="POST">
            <label for="username">Mã Nhân Viên</label>
            <input type="text" id="username" name="username" value="<?php echo $newUsername; ?>" readonly>

                <label for="hoTen">Họ và Tên</label>
                <input type="text" id="hoTen" name="hoTen" required>

                <label for="SDT">Số Điện Thoại</label>
                <input type="text" id="SDT" name="SDT" required>

                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>

                <label for="diaChi">Địa Chỉ</label>
                <input type="text" id="diaChi" name="diaChi" required>

                <label for="ngaysinh">Ngày Sinh</label>
                <input type="date" id="ngaysinh" name="ngaysinh" required>
                <div class="form-buttons">
                  <button type="submit">Thêm Nhân Viên</button>
                  <button type="button" onclick="window.location.href='quanlinv.php';">Hủy bỏ</button>
              </div>
                <!-- <button type="submit">Thêm Nhân Viên</button> -->
            </form>
        </div>
    </main>
</div>
<footer class="footer">
    <p>Bản quyền © 2025 - Hệ Thống Quản Lý Kho</p>
</footer>
</body>
</html>
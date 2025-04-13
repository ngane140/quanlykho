<?php
    include("../class/clssuanv.php");
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

  <script src="../JS/thongbao.js" defer></script> 
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
                <div class="message"><?php echo $errorMessage; ?></div>
            <?php endif; ?>
            <h2>Sửa Nhân Viên</h2>
            <form action="suanv.php?id=<?php echo $employee['idNguoiDung']; ?>" method="POST">
            <label for="username">Mã Nhân Viên:</label>
            <input type="text" id="username" name="username" value="<?php echo $employee['username']; ?>" required><br>

            <label for="hoTen">Họ Tên:</label>
            <input type="text" id="hoTen" name="hoTen" value="<?php echo $employee['hoTen']; ?>" required><br>

            <label for="SDT">Số điện thoại:</label>
            <input type="text" id="SDT" name="SDT" value="<?php echo $employee['SDT']; ?>" required><br>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $employee['email']; ?>" required><br>

            <label for="diaChi">Địa chỉ:</label>
            <input type="text" id="diaChi" name="diaChi" value="<?php echo $employee['diaChi']; ?>" required><br>

            <label for="ngaysinh">Ngày sinh:</label>
            <input type="date" id="ngaysinh" name="ngaysinh" value="<?php echo $employee['ngaysinh']; ?>" required><br>
            <div class="form-buttons">
                  <button type="submit">Cập nhật</button>
                  <button type="button" onclick="window.location.href='quanlinv.php';">Hủy bỏ</button>
              </div>
            
        </form>
        </div>
    </main>
</div>
<footer class="footer">
    <p>Bản quyền © 2025 - Hệ Thống Quản Lý Kho</p>
</footer>
</body>
</html>
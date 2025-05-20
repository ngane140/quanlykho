<?php
ini_set('session.cookie_lifetime', 0);
require_once '../check_login2.php';
include("../class/clsdsguiycxuatnl.php");
$p = new qlykho();
$layid=$_REQUEST['id'];
$layngayYeuCau= $p->laycot("select ngayYeuCau from yeucauxuatnguyenlieu where idYeuCauXuatNL = '$layid'");
$laytrangThai= $p->laycot("select trangThai from yeucauxuatnguyenlieu where idYeuCauXuatNL = '$layid'");
$laymaNL= $p->laycot("SELECT maNL FROM chitietyeucauxuatnguyenlieu WHERE idYeuCauXuatNL ='$layid'");
$laysoLuongXuat = $p->laycot("select soLuongXuat from chitietyeucauxuatnguyenlieu where maNL='$laymaSP' and idYeuCauXuatNL ='$layid'");

if ($laytrangThai == 0) {
    $laytrangThaiText = "Chờ xử lý";
} else if($laytrangThai == 1) {
    $laytrangThaiText = "Chờ xuất nguyên liệu";
}
else if($laytrangThai == 2) {
    $laytrangThaiText = "Đã duyệt";
}
else {
    $laytrangThaiText = "Từ chối";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Chi tiết yêu đề xuất nhập nguyên liệu</title>
  <link rel="stylesheet" href="../CSS/style.css">
  <link rel="stylesheet" href="../CSS/danhsach.css">
  <link rel="stylesheet" href="../CSS/dropdown.css">
  <link rel="stylesheet" href="../CSS/btnql.css"> 
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
                <li class="dropdown">
                Quản lý yêu cầu
                <ul class="dropdown-content">
                    <li><a href="guiyeucauxuatnguyenlieu.php">Yêu cầu xuất nguyên liệu</a></li>
                    <li><a href="yeucausanxuat.php">Yêu cầu sản xuất sản phẩm</a></li>
                </ul>
            </li>
                <li><a href="thongtin.php">Thông tin cá nhân</a></li>
            </ul>
            <button onclick="window.location.href='../logout.php'" class="logout">Đăng xuất</button>
            </aside>
    
        <main class="content">
            <div class="header-section">
                <h2>Chi tiết phiếu yêu cầu xuất nguyên iệu </h2>
                
              
            </div>
            <div>
                <p>Mã phiếu yêu cầu: <?php echo $layid ?></p>
                <p>Ngày yêu cầu: <?php echo $layngayYeuCau?></p>
                <p>Trạng thái phiếu: <?php echo $laytrangThaiText?></p>
            </div>
           
            <?php
                $p->chitietxuatnguyenlieu("select * from chitietyeucauxuatnguyenlieu where idYeuCauXuatNL='$layid'");
            ?> 
            <button class="btn-cancel" name="nut" value="" type="button" onclick="window.location.href='guiyeucauxuatnguyenlieu.php'" style="float:right; margin-top:50px; margin-right:50px;">Quay lại</button>              
        </main>

        
</div>
<footer class="footer">
    <p>Bản quyền © 2025 - Hệ Thống Quản Lý Kho</p>
</footer>
</body>
</html>
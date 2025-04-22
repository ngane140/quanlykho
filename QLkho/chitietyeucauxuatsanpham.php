<?php
ini_set('session.cookie_lifetime', 0);
require_once '../check_login.php';
include("../class/clsdsnhanyeucauxuatSP.php");
$p = new qlykho();
$layid=$_REQUEST['id'];
$layidKhachHang= $p->laycot("select idKhachHang from yeucauxuatsanpham where idYeuCauXuatSP = '$layid'");
$laytenKH = $p->laycot("select hoTen from khachhang where idKhachHang = '$layidKhachHang'");
$layngayYeuCau= $p->laycot("select ngayYeuCau from yeucauxuatsanpham where idYeuCauXuatSP = '$layid'");
$laytrangThai= $p->laycot("select trangThai from yeucauxuatsanpham where idYeuCauXuatSP = '$layid'");
$laymaSP= $p->laycot("SELECT maSP FROM chitietyeucauxuatsanpham WHERE idYeuCauXuatSP ='$layid'");
$laysoLuongXuat = $p->laycot("select soLuongXuat from chitietyeucauxuatsanpham where maSP='$laymaSP'");

if ($laytrangThai == 0) {
    $laytrangThaiText = "Chờ xử lý";
} else if($laytrangThai == 1) {
    $laytrangThaiText = "Chờ sản xuất";
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
  <title>Chi tiết yêu cầu xuất SP</title>
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
        <li><a href="quanlinv.php">Quản lý nhân viên kho</a></li>
        <li><a href="theodoisp.php">Quản lý sản phẩm</a></li>
        <li><a href="theodoiNL.php">Quản lý nguyên liệu</a></li>
        <li class="dropdown">
            Quản lý yêu cầu
            <ul class="dropdown-content">
              <li><a href="">Yêu cầu xuất nguyên liệu</a></li>
              <li><a href="yeucaunhapNL.php">Yêu cầu nhập nguyên liệu</a></li>
              <li><a href="yeucauSX.php">Yêu cầu sản xuất</a></li>
              <li><a href="yeucauxuatSP.php">Yêu cầu xuất sản phẩm</a></li>
            </ul>
       </li>
        <li><a href="">Tạo mã QR sản phẩm</a></li>
        <li><a href="thongtin.php">Thông tin cá nhân</a></li>
      </ul>
      <button onclick="window.location.href='../logout.php'" class="logout">Đăng xuất</button>
    </aside>
    
        <main class="content">
            <div class="header-section">
                <h2>Chi tiết phiếu yêu cầu xuất sản phẩm </h2>
                <h2>Mã phiếu yêu cầu: <?php echo $layid ?></h2>
                <form  method="post">
                <?php if($laytrangThai == 0): ?>
                <button class="btn-cancel" name="nut" value="Tu choi phieu" type="submit">Từ chối phiếu</button>
                <button class="btn-create" name="nut" value="Xac nhan xuat" type="submit" style="margin-right: 100px;">Xác nhận Xuất</button>
                <?php elseif($laytrangThai == 1): ?>
                    <button class="btn-create" 
                            onclick="window.open('taoycsxsp.php', '_blank')" 
                            style="background-color: #4CAF50; margin-right: 100px;">
                        Tạo yêu cầu sản xuất
                    </button>
                    <button class="btn-create" name="nut" value="Xac nhan xuat" type="submit" style="margin-right: 100px;">Xác nhận Xuất</button>
                <?php elseif($laytrangThai == 3): ?>
                    
                <?php endif; ?>
                    <?php
                         if (isset($_POST['nut'])) {
                            switch($_POST['nut']){
                                case 'Xac nhan xuat': {
                                    // Lấy danh sách sản phẩm trong phiếu
                                    $sql_sanpham = "SELECT maSP, soLuongXuat FROM chitietyeucauxuatsanpham WHERE idYeuCauXuatSP = '$layid'";
                                    $ketqua_sanpham = mysql_query($sql_sanpham);
                                    $duDieuKien = true;
                                    
                                    // Kiểm tra từng sản phẩm
                                    while($row = mysql_fetch_array($ketqua_sanpham)) {
                                        $laymaSP = $row['maSP'];
                                        $laysoLuongXuat = $row['soLuongXuat'];
                                        $laysoluong = $p->laycot("SELECT soLuong FROM sanpham WHERE maSP = '$laymaSP'");
                                        
                                        if($laysoLuongXuat > $laysoluong) {
                                            $duDieuKien = false;
                                            break; // Thoát vòng lặp nếu có ít nhất 1 sản phẩm không đủ
                                        }
                                    }
                                    
                                    if(!$duDieuKien) {
                                        echo '<script language="javascript">
                                                alert("Hiện tại số lượng hiện tại không đủ để xuất kho. Vui lòng tạo phiếu yêu cầu sản phẩm");
                                                window.location.href = "chitietyeucauxuatsanpham.php?id='.$layid.'";
                                              </script>';
                                        // Cập nhật trạng thái thành 1 (Đã duyệt)
                                        $p->themxoasua("UPDATE yeucauxuatsanpham SET trangThai = 1 WHERE idYeuCauXuatSP = '$layid'");
                                    } else {
                                        echo '<script language="javascript">
                                        alert("Xuất sản phẩm thành công");
                                        window.location.href = "chitietyeucauxuatsanpham.php?id='.$layid.'";
                                      </script>';
                                        // Nếu đủ số lượng, thực hiện xử lý xuất kho
                                        $p->themxoasua("UPDATE yeucauxuatsanpham SET trangThai = 2 WHERE idYeuCauXuatSP = '$layid'");
                                        mysql_data_seek($ketqua_sanpham, 0); // Đặt lại con trỏ result
                                        while($row = mysql_fetch_array($ketqua_sanpham)) {
                                            $laymaSP = $row['maSP'];
                                            $laysoLuongXuat = $row['soLuongXuat'];
                                            
                                            $p->themxoasua("UPDATE sanpham SET soLuong = soLuong - $laysoLuongXuat WHERE maSP = '$laymaSP'");
                                        }
                                    }
                                    break;
                                }

                                case 'Tu choi phieu':{
                                    if($p->themxoasua("UPDATE yeucauxuatsanpham SET trangThai = 3 WHERE idYeuCauXuatSP = '$layid'")==1){
                                         echo '<script language="javascript">alert("Bạn có chắc chắn muốn từ chối phiếu");
                                                window.location = "chitietyeucauxuatSP.php?id='.$layid.'";</script>';
                                    }
                                
                                }
                            }
                        }
                    ?>
                </form>
                
            </div>
            <table class="product-table">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên khách hàng</th>
                        <th>Ngày yêu cầu</th>
                        <th>Sản phẩm</th>
                        <th>Trạng thái</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td><?php echo $laytenKH ?></td>
                        <td><?php echo $layngayYeuCau ?></td>
                        <td ><?php  $p->chitietsanpham("select * from chitietyeucauxuatsanpham where idYeuCauXuatSP = '$layid'")?></td>
                        <td><?php echo $laytrangThaiText ?></td>
                    </tr>
                    
                </tbody>
            </table>
            <a href="yeucauxuatSP.php"><button class="btn" style="float: right;">Quay lại</button></a>
        </main>

        
</div>
<footer class="footer">
    <p>Bản quyền © 2025 - Hệ Thống Quản Lý Kho</p>
</footer>
</body>
</html>
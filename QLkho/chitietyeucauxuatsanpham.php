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
$laysoLuongXuat = $p->laycot("select soLuongXuat from chitietyeucauxuatsanpham where maSP='$laymaSP' and idYeuCauXuatSP ='$layid'");

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
       <li><a href="dsQRSP.php">Tạo mã QR sản phẩm</a></li>
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
                                switch ($_POST['nut']) {
                                    case 'Xac nhan xuat': {
                                        // Lấy tất cả sản phẩm trong yêu cầu xuất
                                        $dsSanPham = $p->laydanhsach("SELECT maSP, soLuongXuat FROM chitietyeucauxuatsanpham WHERE idYeuCauXuatSP = '$layid'");
                                        
                                        $coTheXuat = true;
                                        $thongBao = "";
                                        
                                        // Kiểm tra tồn kho cho từng sản phẩm
                                        foreach ($dsSanPham as $sp) {
                                            $maSP = $sp['maSP'];
                                            $soLuongXuat = $sp['soLuongXuat'];
                                            
                                            $soluongton = $p->laycot("SELECT SUM(soLuong) FROM sanpham WHERE maSP = '$maSP' AND trangThai = 1");
                                            
                                            if($soluongton < $soLuongXuat) {
                                                $coTheXuat = false;
                                                $thongBao .= "Sản phẩm $maSP không đủ số lượng tồn kho (Cần: $soLuongXuat, Tồn: $soluongton)\\n";
                                            }
                                        }
                                        
                                        if(!$coTheXuat) {
                                            echo '<script>
                                                    alert("'.$thongBao.'");
                                                    window.location.href = "chitietyeucauxuatsanpham.php?id='.$layid.'";
                                                  </script>';
                                            $p->themxoasua("UPDATE yeucauxuatsanpham SET trangThai = 1 WHERE idYeuCauXuatSP = '$layid'");
                                        }
                                        else {
                                            // Xử lý xuất kho từng sản phẩm
                                            foreach ($dsSanPham as $sp) {
                                                $maSP = $sp['maSP'];
                                                $soLuongXuat = $sp['soLuongXuat'];
                                                $soLuongConLai = $soLuongXuat;
                                                
                                                // Xuất theo FIFO
                                                while($soLuongConLai > 0) {
                                                    // Lấy lô hàng cũ nhất
                                                    $loHang = $p->laydanhsach("SELECT idSanPham, soLuong FROM sanpham 
                                                                             WHERE maSP = '$maSP' AND soLuong > 0 
                                                                             ORDER BY ngaySanXuat ASC LIMIT 1");
                                                    
                                                    if(empty($loHang)) break;
                                                    
                                                    $idSanPham = $loHang[0]['idSanPham'];
                                                    $soLuongLo = $loHang[0]['soLuong'];
                                                    
                                                    $soLuongXuatLo = min($soLuongLo, $soLuongConLai);
                                                    
                                                    // Thực hiện xuất kho
                                                    $p->themxoasua("UPDATE sanpham SET soLuong = soLuong - $soLuongXuatLo 
                                                                  WHERE idSanPham = '$idSanPham'");
                                                    
                                                    $soLuongConLai -= $soLuongXuatLo;
                                                }
                                            }
                                            
                                            echo '<script>
                                                    alert("Xuất kho thành công");
                                                    window.location.href = "chitietyeucauxuatsanpham.php?id='.$layid.'";
                                                  </script>';
                                            $p->themxoasua("UPDATE yeucauxuatsanpham SET trangThai = 2 WHERE idYeuCauXuatSP = '$layid'");
                                        }
                                        break;
                                    }
                            
                                    case 'Tu choi phieu': {
                                        if ($p->themxoasua("UPDATE yeucauxuatsanpham SET trangThai = 3 WHERE idYeuCauXuatSP = '$layid'") == 1) {
                                            echo '<script>
                                                    alert("Bạn đã từ chối phiếu!");
                                                    window.location.href = "chitietyeucauxuatsanpham.php?id=' . $layid . '";
                                                  </script>';
                                        }
                                        break;
                                    }
                                }
                            }
                            
                        ?>
                </form>
                
            </div>
            <div>
                <p>Tên khách hàng: <?php echo $laytenKH ?></p>
                <p>Ngày yêu cầu: <?php echo $layngayYeuCau?></p>
                <p>Trạng thái phiếu: <?php echo $laytrangThaiText?></p>
            </div>
           
            <?php
                $p->chitietsanpham("select * from chitietyeucauxuatsanpham where idYeuCauXuatSP='$layid'");
            ?>               
        </main>

        
</div>
<footer class="footer">
    <p>Bản quyền © 2025 - Hệ Thống Quản Lý Kho</p>
</footer>
</body>
</html>
<?php
ini_set('session.cookie_lifetime', 0);
require_once '../check_login.php';
include('../class/clschitietyeucaunhapNL.php');
$p = new nvkho();
$layid=$_REQUEST['id'];
$laytrangThaiPhieu = $p->laycot("select trangThai from yeucaunhapnguyenlieu where idYeuCauNhapNL='$layid'");
$laymaNL = $p->laycot("select maNL from chitietyecaunhapnguyenlieu where idYeuCauNhapNL='$layid'");
$laysoLuongNhap = $p->laycot("select soluongNhap from chitietyecaunhapnguyenlieu where idYeuCauNhapNL='$layid' and maNL = '$laymaNL' ");
$laytenNguyenLieu = $p->laycot("select tenNguyenLieu from nguyenlieu where maNL = '$laymaNL' ");
$laydonGia = $p->laycot("select donGia from nguyenlieu where maNL = '$laymaNL' ");
$laydonViTinh = $p->laycot("select donViTinh from nguyenlieu where maNL = '$laymaNL' ");
$laytrangThai = $p->laycot("select trangThai from nguyenlieu where maNL = '$laymaNL' ");
$layngayNhap = $p->laycot("select ngayNhap from nguyenlieu where maNL = '$laymaNL' ");
$layHSDChoPhep = $p->laycot("select HSDChoPhep from nguyenlieu where maNL = '$laymaNL' ");
$laytrangThai = $p->laycot("select trangThai from nguyenlieu where maNL = '$laymaNL' ");
$laysoLuongTon = $p->laycot("select soLuongTon from nguyenlieu where maNL = '$laymaNL' ");

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Yêu cầu xuất sản phẩm</title>
  <link rel="stylesheet" href="../CSS/style.css">
  <link rel="stylesheet" href="../CSS/danhsach.css">
  <link rel="stylesheet" href="../CSS/btnql.css"> 
  <link rel="stylesheet" href="../CSS/themphieukiemke.css"> 
  <style>
     a {
      text-decoration: none; /* Xóa gạch chân */
      color: inherit; /* Giữ nguyên màu chữ */
    }
    .info-group {
        display: inline-block;
        min-width: 400px; /* bạn có thể điều chỉnh theo ý muốn */
        margin-bottom: 5px;
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
        <li><a href="YCnhapNL.php">Yêu cầu nhập nguyên liệu</a></li>
        <li><a href="theodoisp.php">Theo dõi sản phẩm</a></li>
        <li><a href="theodoiNL.php">Theo dõi nguyên liệu</a></li>
        <li><a href="dskiemke.php">Kiểm kê nguyên liệu</a></li>
        <li><a href="dsQRNL.php">Tạo mã QR nguyên liệu</a></li>
        <li><a href="thongtin.php">Thông tin cá nhân</a></li>
      </ul>
      <button onclick="window.location.href='../logout.php'" class="logout">Đăng xuất</button>
    </aside>
    <main class="content">
    <h2>Yêu cầu nhập Nguyên Liệu</h2>
    <?php if ($thongTin): ?>
        <p>
        <span class="info-group"><strong>Mã phiếu:</strong> <?php echo "YCNNL" . $thongTin['idYeuCauNhapNL']; ?></span>  
    </p>
    <p>
    <span class="info-group"><strong>Ngày yêu cầu:</strong> <?php echo date("d/m/Y H:i", strtotime($thongTin['ngayYeuCau'])); ?></span>   
    </p>
<?php else: ?>
    <p>Không tìm thấy thông tin phiếu .</p>
<?php endif; ?>
        
    <div class="thanhcuon">
        <table class="product-table">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Mã Nguyên Liệu</th>
                    <th>Tên Nguyên Liệu</th>
                    <th>Số lượng Nhập</th>
                    <th>Đơn vị tính</th>
                    <th>Đơn giá</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $stt=1;
            
            if (!empty($chiTietSP)):
                foreach ($chiTietSP as $row): 
                  $maNL= $row['maNL'];
                  $tenNguyenLieu = $row['tenNguyenLieu'];?>
                  <tr>

                    <td><?php echo $stt++; ?></td>
                    <td><?php echo $maNL; ?></td>   
                    <td><?php echo $tenNguyenLieu; ?></td>    
                    <td><?php echo $row['soLuongNhap']; ?></td>
                    <td><?php echo $row['donViTinh']; ?></td> 
                    <td><?php echo number_format($row['donGia'], 0, ',', '.') . ' VNĐ'; ?></td>
                  </tr>
                <?php endforeach; ?>
              <?php else: ?>
                <tr><td colspan="6">Không có dữ liệu xuất.</td></tr>
              <?php endif; ?>
            </tbody>
              </table>
            </div> <br>
            <form  method="post">
            <?php if($laytrangThaiPhieu == 0): ?>
            <a href=""><button class="btn" style="float: right; margin-left: 30px;margin-right: 30px;" name="nut" value="Nhap">Nhập</button></a>
            <button type="button" onclick="window.location.href='YCnhapNL.php'" class="btn" style="float: right;">Quay lại</button>
            <?php elseif($laytrangThaiPhieu == 1): ?>
              <button type="button" onclick="window.location.href='YCnhapNL.php'" class="btn" style="float: right; margin-right:50px;">Quay lại</button>
              <?php endif; ?>
            <?php
              if (isset($_POST['nut'])) {
                switch ($_POST['nut']) {
                  case 'Nhap': {
                    // echo '<script> alert("Nhập nguyên liệu thành công");
                    //       window.location.href = "nhanYCnhapNL.php?id='.$layid.'";
                    //       </script>';
                    // $p->themxoasua("INSERT INTO qlkho.nguyenlieu(maNL, tenNguyenLieu,donGia,donViTinh,soLuongTon,trangThai,ngayNhap,HSDChoPhep)
                    //                     VALUES ('$laymaNL', '$laytenNguyenLieu', $laydonGia, '$laydonViTinh', $laysoLuongNhap, 1, NOW( ) , $layHSDChoPhep); ");
                  // Lấy toàn bộ danh sách nguyên liệu cần nhập
                $dsNguyenLieu = $p->laydanhsach("SELECT * FROM chitietyecaunhapnguyenlieu WHERE idYeuCauNhapNL='$layid'");
                
                $success = true;
                
                foreach ($dsNguyenLieu as $nl) {
                    $maNL = $nl['maNL'];
                    $soLuongNhap = $nl['soLuongNhap'];
                    
                    // Kiểm tra xem nguyên liệu đã tồn tại chưa
                    $tonTai = $p->laycot("SELECT COUNT(*) FROM nguyenlieu WHERE maNL = '$maNL'");
                    
                    
                        // Nếu chưa tồn tại thì lấy thông tin và thêm mới
                        $info = $p->laycot("SELECT tenNguyenLieu, donGia, donViTinh, HSDChoPhep FROM nguyenlieu WHERE maNL = '$maNL'", true);
                        
                        $sql = "INSERT INTO nguyenlieu(maNL, tenNguyenLieu, donGia, donViTinh, soLuongTon, trangThai, ngayNhap, HSDChoPhep)
                                VALUES ('$maNL', '{$info['tenNguyenLieu']}', {$info['donGia']}, '{$info['donViTinh']}', $soLuongNhap, 1, NOW(), {$info['HSDChoPhep']})";
                    
                    
                    if (!$p->themxoasua($sql)) {
                        $success = false;
                        break;
                    }
                }
                
                if ($success) {
                    // Cập nhật trạng thái yêu cầu nhập
                    $p->themxoasua("UPDATE yeucaunhapnguyenlieu SET trangThai = 1 WHERE idYeuCauNhapNL = '$layid'");
                    
                    echo '<script> 
                            alert("Nhập kho thành công '.count($dsNguyenLieu).' nguyên liệu");
                            window.location.href = "nhanYCnhapNL.php?id='.$layid.'";
                          </script>';
                } else {
                    echo '<script>alert("Có lỗi xảy ra khi nhập kho");</script>';
                }
                break;
                  }
                }
              }
              ?>
          </form>
           
    </main>
</div>
<footer class="footer">
    <p>Bản quyền © 2025 - Hệ Thống Quản Lý Kho</p>
</footer>
</body>
</html>
<?php
ini_set('session.cookie_lifetime', 0);
require_once '../check_login.php';
include("../class/clsdsnhanyeucausanxuatsp.php");
$p = new qlykho();
$layid=$_REQUEST['id'];
$laymaSP= $p->laycot("select maSP from chitietyeucausanxuatsanpham where idYeuCauSXSP = '$layid'");
$laytensanPham= $p->laycot("select tensanPham from sanpham where maSP = '$laymaSP' group by maSP");
$laysoLuongSX= $p->laycot("select soLuongSX from chitietyeucausanxuatsanpham where idYeuCauSXSP = '$layid' and maSP='$laymaSP'");
$layngayYeuCau= $p->laycot("select ngayYeuCau from yeucausanxuatsanpham where idYeuCauSXSP = '$layid' ");
$laytrangThai= $p->laycot("select trangThai from yeucausanxuatsanpham where idYeuCauSXSP = '$layid' ");


if ($laytrangThai == 0) {
    $laytrangThaiText = "Chờ xử lý";
} else if($laytrangThai == 1) {
    $laytrangThaiText = "Đang sản xuất";
}else if($laytrangThai == 2) {
    $laytrangThaiText = "Đã sản xuất";
}
else if($laytrangThai == 3) {
    $laytrangThaiText = "Chờ nhập nguyên liệu";
}
// else if($laytrangThai == 2) {
//     $laytrangThaiText = "Đã duyệt";
// }
// else {
//     $laytrangThaiText = "Từ chối";
// }
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
        <li>Trang chủ</li>
        <li class="dropdown">
           Quản lý yêu cầu
          <ul class="dropdown-content">
            <li>Yêu cầu xuất nguyên liệu</li>
            <li><a href="yeucausanxuat.php">Yêu cầu sản xuất sản phẩm</a></li>
          </ul>
       </li>
        <li>Theo dõi sản phẩm</li>
        <li>Theo dõi nguyên liệu</li>
        <li><a href="thongtin.php"></a>Thông tin cá nhân</li>
      </ul>
      <button class="logout">Đăng xuất</button>
    </aside>
    
        <main class="content">
            <div >
                <h2>Chi tiết phiếu yêu cầu sản xuất sản phẩm </h2>
                <h2>Mã phiếu yêu cầu: <?php echo $layid ?></h2>
                
                
            </div>
            <div>
                <p>Ngày yêu cầu: <?php echo $layngayYeuCau?></p>
                <p>Trạng thái phiếu: <?php echo $laytrangThaiText?></p>
            </div>
           
            <?php
                $p->chitietsanxuatsp("select * from chitietyeucausanxuatsanpham where idYeuCauSXSP='$layid'");
            ?>  
            <form  method="post">
                <div style="text-align: right; margin-top: 30px;">
                
                        
                    <?php if($laytrangThai == 0): ?>
                    <button class="btn-cancel" name="nut" value="" type="button" onclick="window.location.href='yeucausanxuat.php'">Quay lại</button>                    
                    <button class="btn-create" name="nut" value="San Xuat San Pham" type="submit" style="margin-right: 100px;">Sản xuất sản phẩm</button>
                    <?php elseif($laytrangThai == 1): ?>
                        <button class="btn-cancel" name="nut" value="" type="button" onclick="window.location.href='yeucausanxuat.php'">Quay lại</button>                    
                        <button class="btn-create" name="nut" value="Hoan thanh san xuat" type="submit" style="margin-right: 100px;">Hoàn thành sản xuất</button>
                    <?php elseif($laytrangThai == 2): ?>
                        <button class="btn-cancel" name="nut" value="" type="button" onclick="window.location.href='yeucausanxuat.php'">Quay lại</button>
                    <?php elseif($laytrangThai == 3): ?>
                        <button class="btn-cancel" name="nut" value="" type="button" onclick="window.location.href='yeucausanxuat.php'">Quay lại</button> 
                        <button class="btn-create" 
                                onclick="window.open('themyeucauSX.php', '_blank')" 
                                style="background-color: #4CAF50;">
                            Tạo phiếu nhập nguyên liệu
                        </button>                   
                        <button class="btn-create" name="nut" value="San Xuat San Pham" type="submit" style="margin-right: 100px;">Sản xuất sản phẩm</button>
                        <?php endif; ?>
                        <?php
                            if (isset($_POST['nut'])) {
                                switch ($_POST['nut']) {
                                    case 'San Xuat San Pham': {
                                       // 1. Lấy thông tin yêu cầu sản xuất (join với bảng chính)
                                        $yeuCauSX = $p->laycot("SELECT c.maSP, c.soLuongSX 
                                                                    FROM chitietyeucausanxuatsanpham c
                                                                    JOIN yeucausanxuatsanpham y ON c.idYeuCauSXSP = y.idYeuCauSXSP
                                                                    WHERE c.idYeuCauSXSP = '$layid'", true);

                                        if(empty($yeuCauSX)) {
                                        echo '<script>alert("Không tìm thấy yêu cầu sản xuất");</script>';
                                        break;
                                        }

                                        $maSP = $yeuCauSX['maSP'];
                                        $soLuongSanXuat = $yeuCauSX['soLuongSX'];

                                        // 2. Lấy danh sách nguyên liệu cần cho sản phẩm (đúng tên bảng)
                                        $dsNguyenLieu = $p->laydanhsach("SELECT maNL, soLuong FROM nguyenlieu_sanpham WHERE maSP = '$maSP'");

                                        $coTheSanXuat = true;
                                        $thongBao = "";

                                        // 3. Kiểm tra đủ nguyên liệu
                                        foreach ($dsNguyenLieu as $nl) {
                                            $maNL = $nl['maNL'];
                                            $soLuongCan = $nl['soLuong'] * $soLuongSanXuat;

                                            $tongTonKho = $p->laycot("SELECT SUM(soLuongTon) FROM nguyenlieu 
                                                    WHERE maNL = '$maNL' AND trangThai = 1");

                                            if ($tongTonKho < $soLuongCan) {
                                                $coTheSanXuat = false;
                                                $tenNL = $p->laycot("SELECT tenNguyenLieu FROM nguyenlieu WHERE maNL = '$maNL' LIMIT 1");
                                                $thongBao .= "Không đủ nguyên liệu $tenNL (Cần: $soLuongCan, Tồn: $tongTonKho)\\n";
                                                $p->themxoasua("UPDATE yeucausanxuatsanpham SET trangThai = 3 
                                                WHERE idYeuCauSXSP = '$layid'");
                                            }
                                        }

                                        if (!$coTheSanXuat) {
                                            echo '<script>
                                            alert("'.$thongBao.'");
                                            window.location.href = "chitietyeucausxsp.php?id='.$layid.'";
                                            </script>';
                                        } 
                                        else {
                                            // 4. Trừ nguyên liệu theo FIFO
                                            foreach ($dsNguyenLieu as $nl) {
                                                $maNL = $nl['maNL'];
                                                $soLuongConLaiCan = $nl['soLuong'] * $soLuongSanXuat;

                                                $dsLoNL = $p->laydanhsach("SELECT idNguyenLieu, soLuongTon FROM nguyenlieu 
                                                            WHERE maNL = '$maNL' AND soLuongTon > 0 AND trangThai = 1
                                                            ORDER BY ngayNhap ASC");

                                                foreach ($dsLoNL as $loNL) {
                                                if ($soLuongConLaiCan <= 0) break;

                                                    $idNguyenLieu = $loNL['idNguyenLieu'];
                                                    $soLuongLo = $loNL['soLuongTon'];
                                                    $soLuongTru = min($soLuongLo, $soLuongConLaiCan);

                                                    $p->themxoasua("UPDATE nguyenlieu SET soLuongTon = soLuongTon - $soLuongTru 
                                                        WHERE idNguyenLieu = '$idNguyenLieu'");

                                                    $soLuongConLaiCan -= $soLuongTru;
                                                }
                                            }

                                            // 6. Cập nhật trạng thái yêu cầu
                                            $p->themxoasua("UPDATE yeucausanxuatsanpham SET trangThai = 1
                                            WHERE idYeuCauSXSP = '$layid'");

                                            echo '<script>
                                            alert("Đã chuyển sang trạng thái đang sản xuất '.$soLuongSanXuat.' sản phẩm '.$laytensanPham.'");
                                            window.location.href = "chitietyeucausxsp.php?id='.$layid.'";
                                            </script>';
                                        }
                                        break;
                                    }
                            
                                    case 'Hoan thanh san xuat': {
                                        // if ($p->themxoasua("UPDATE yeucausanxuatsanpham SET trangThai = 2 WHERE idYeuCauSXSP = '$layid'") == 1) {
                                        //     echo '<script>
                                        //             alert("Đã hoàn thành việc sản xuất sản phẩm!");
                                        //             window.location.href = "chitietyeucausxsp.php?id=' . $layid . '";
                                        //           </script>';
                                        // // 5. Cập nhật số lượng sản phẩm (cộng dồn)
                                        // $p->themxoasua("UPDATE sanpham SET soLuong = soLuong + $laysoLuongSX
                                        // WHERE maSP = '$maSP' AND trangThai = 1");
                                        // }
                                        // break;
                                        $dssanpham = $p->laydanhsach("SELECT * FROM chitietyeucausanxuatsanpham WHERE idYeuCauSXSP='$layid'");
                
                                        $success = true;
                                        
                                        foreach ($dssanpham as $nl) {
                                            $maSP = $nl['maSP'];
                                            $soLuongSX = $nl['soLuongSX'];
                                            
                                            // Kiểm tra xem nguyên liệu đã tồn tại chưa
                                            $tonTai = $p->laycot("SELECT COUNT(*) FROM sanpham WHERE maSP = '$maSP'");
                                            
                                            
                                                // Nếu chưa tồn tại thì lấy thông tin và thêm mới
                                                $info = $p->laycot("SELECT tensanpham, donGia, donViTinh, HSDChoPhep FROM sanpham WHERE maSP = '$maSP'", true);
                                                
                                                $sql = "INSERT INTO sanpham(maSP, tensanpham, donGia, donViTinh, soLuong, trangThai, ngaySanXuat, HSDChoPhep)
                                                        VALUES ('$maSP', '{$info['tensanpham']}', {$info['donGia']}, '{$info['donViTinh']}', $soLuongSX, 1, NOW(), {$info['HSDChoPhep']})";
                                            
                                            
                                            if (!$p->themxoasua($sql)) {
                                                $success = false;
                                                break;
                                            }
                                        }
                                        
                                        if ($success) {
                                            // Cập nhật trạng thái yêu cầu nhập
                                            $p->themxoasua("UPDATE yeucausanxuatsanpham SET trangThai = 2 WHERE idYeuCauSXSP = '$layid'");
                                            
                                            echo '<script> 
                                                    alert("Nhập kho thành công '.$laysoLuongSX.' sản phẩm '.$laytensanPham.'");
                                                    window.location.href = "chitietyeucausxsp.php?id='.$layid.'";
                                                </script>';
                                        } else {
                                            echo '<script>alert("Có lỗi xảy ra khi nhập kho");</script>';
                                        }
                                        break;
                                    }
                                }
                            }
                            
                        ?>
                </div>
                    
            </form>          
        </main>

        
</div>
<footer class="footer">
    <p>Bản quyền © 2025 - Hệ Thống Quản Lý Kho</p>
</footer>
</body>
</html>
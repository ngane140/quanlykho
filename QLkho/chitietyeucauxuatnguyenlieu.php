<?php
ini_set('session.cookie_lifetime', 0);
require_once '../check_login.php';
include("../class/clsdsnhanyeucauxuatNL.php");
$p = new qlykho();
$layid=$_REQUEST['id'];
$layngayYeuCau= $p->laycot("select ngayYeuCau from yeucauxuatnguyenlieu where idYeuCauXuatNL = '$layid'");
$laytrangThai= $p->laycot("select trangThai from yeucauxuatnguyenlieu where idYeuCauXuatNL = '$layid'");
$laymaNL= $p->laycot("SELECT maNL FROM chitietyeucauxuatnguyenlieu WHERE idYeuCauXuatNL ='$layid'");
$laysoLuongXuat = $p ->laycot("select soLuongXuat from chitietyeucauxuatnguyenlieu where maNL='$laymaNL' and idYeuCauXuatNL ='$layid'");

if ($laytrangThai == 0) {
    $laytrangThaiText = "Chờ xử lý";
} else if($laytrangThai == 1) {
    $laytrangThaiText = "Chờ nhập nguyên liệu";
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
  <title>Chi tiết yêu cầu xuất NL</title>
  <link rel="stylesheet" href="../CSS/style.css">
  <link rel="stylesheet" href="../CSS/danhsach.css">
  <link rel="stylesheet" href="../CSS/dropdown.css">
  <link rel="stylesheet" href="../CSS/btnql.css"> 
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
                <h2>Chi tiết đề xuất nhập nguyên liệu </h2>
                <h2>Mã phiếu yêu cầu: <?php echo $layid ?></h2>
                <form  method="post">
                    <?php if($laytrangThai == 0): ?>
                    <button class="btn-cancel" name="nut" value="Tu choi phieu" type="submit">Từ chối phiếu</button>
                    <button class="btn-create" name="nut" value="Xac nhan xuat" type="submit" style="margin-right: 100px;">Xác nhận Xuất</button>
                    <?php elseif($laytrangThai == 1): ?>
                        <!-- <button class="btn-cancel" name="nut" value="Tu choi phieu" type="submit">Từ chối phiếu</button> -->
                        <button class="btn-create" 
                                onclick="window.open('themyeucaunhapNL.php', '_blank')" 
                                style="background-color: #4CAF50; margin-right: 0px;" >
                            Nhập nguyên liệu
                        </button>
                        <button class="btn-create" name="nut" value="Xac nhan" type="submit" style="margin-right: 0px; ">Xác nhận</button>
                    <?php elseif($laytrangThai == 3): ?>
                        
                    <?php endif; ?>
                        <?php
                            if (isset($_POST['nut'])) {
                                switch ($_POST['nut']) {
                                    case 'Xac nhan xuat': {
                                        // Lấy tất cả sản phẩm trong yêu cầu xuất
                                        // $dsnguyenlieu = $p->laydanhsach("SELECT maNL, soLuongXuat FROM chitietyeucauxuatnguyenlieu WHERE idYeuCauXuatNL = '$layid'");
                                        
                                        // $coTheXuat = true;
                                        // $thongBao = "";
                                        
                                        // // Kiểm tra tồn kho cho từng sản phẩm
                                        // foreach ($dsnguyenlieu as $NL) {
                                        //     $maNL = $NL['maNL'];
                                        //     $soLuongXuat = $NL['soLuongXuat'];
                                            
                                        //     $soluongton = $p->laycot("SELECT SUM(soLuongTon) FROM nguyenlieu WHERE maNL = '$maNL' AND trangThai = 1");
                                            
                                        //     if($soluongton < $soLuongXuat) {
                                        //         $coTheXuat = false;
                                        //         $thongBao .= "Nguyên liệu $maNL không đủ số lượng tồn kho (Cần: $soLuongXuat, Tồn: $soluongton)\\n ";
                                        //     }
                                        // }
                                        
                                        // if(!$coTheXuat) {
                                            echo '<script>
                                                    alert("Đã chấp nhận phiếu. Vui lòng tạo phiếu Nhập nguyên liệu!");
                                                    window.location.href = "chitietyeucauxuatnguyenlieu.php?id='.$layid.'";
                                                  </script>';
                                            $p->themxoasua("UPDATE yeucauxuatnguyenlieu SET trangThai = 1 WHERE idYeuCauXuatNL = '$layid'");
                                        // }
                                        // else {
                                        //     // Xử lý xuất kho từng sản phẩm
                                        //     foreach ($dsnguyenlieu as $NL) {
                                        //         $maNL = $NL['maNL'];
                                        //         $soLuongXuat = $NL['soLuongXuat'];
                                        //         $soLuongConLai = $soLuongXuat;
                                                
                                        //         // Xuất theo FIFO
                                        //         while($soLuongConLai > 0) {
                                        //             // Lấy lô hàng cũ nhất
                                        //             $loHang = $p->laydanhsach("SELECT idnguyenlieu, soLuongTon FROM nguyenlieu 
                                        //                                      WHERE maNL = '$maNL' AND soLuongTon > 0 
                                        //                                      ORDER BY ngayNhap ASC LIMIT 1");
                                                    
                                        //             if(empty($loHang)) break;
                                                    
                                        //             $idnguyenlieu = $loHang[0]['idnguyenlieu'];
                                        //             $soLuongLo = $loHang[0]['soLuongTon'];
                                                    
                                        //             $soLuongXuatLo = min($soLuongLo, $soLuongConLai);
                                                    
                                        //             // Thực hiện xuất kho
                                        //             $p->themxoasua("UPDATE nguyenlieu SET soLuongTon = soLuongTon - $soLuongXuatLo 
                                        //                           WHERE idnguyenlieu = '$idnguyenlieu'");
                                                    
                                        //             $soLuongConLai -= $soLuongXuatLo;
                                        //         }
                                        //     }
                                            
                                        //     echo '<script>
                                        //             alert("Xuất kho thành công");
                                        //             window.location.href = "chitietyeucauxuatnguyenlieu.php?id='.$layid.'";
                                        //           </script>';
                                        //     $p->themxoasua("UPDATE yeucauxuatnguyenlieu SET trangThai = 2 WHERE idYeuCauXuatNL = '$layid'");
                                        // }
                                        break;
                                    }
                                    case 'Xac nhan': {
                                        echo '<script>
                                                    alert("Đã duyệt phiếu!");
                                                    window.location.href = "chitietyeucauxuatnguyenlieu.php?id='.$layid.'";
                                                  </script>';
                                            $p->themxoasua("UPDATE yeucauxuatnguyenlieu SET trangThai = 2 WHERE idYeuCauXuatNL = '$layid'");
                                            break;
                                        }
                            
                                    case 'Tu choi phieu': {
                                        if ($p->themxoasua("UPDATE yeucauxuatnguyenlieu SET trangThai = 3 WHERE idYeuCauXuatNL = '$layid'") == 1) {
                                            echo '<script>
                                                    alert("Bạn có chắc chắn Từ chối phiếu?");
                                                    window.location.href = "chitietyeucauxuatnguyenlieu.php?id=' . $layid . '";
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
               
                <p>Ngày yêu cầu: <?php echo $layngayYeuCau?></p>
                <p>Trạng thái phiếu: <?php echo $laytrangThaiText?></p>
            </div>
           
            <?php
                $p->chitietnguyenlieu("select * from chitietyeucauxuatnguyenlieu where idYeuCauXuatNL='$layid'");
            ?>   
            <button class="btn-cancel" name="nut" value="" type="button" onclick="window.location.href='yeucauxuatNL.php'" style="float:right; margin-top:50px; margin-right:50px;">Quay lại</button>                          
        </main>

        
</div>
<footer class="footer">
    <p>Bản quyền © 2025 - Hệ Thống Quản Lý Kho</p>
</footer>
</body>
</html>
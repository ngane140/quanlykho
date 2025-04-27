<?php
include_once('ketnoi.php');
session_start();
$idSanPham = isset($_GET['id']) ? $_GET['id'] : '';
echo "ID Sản Phẩm: " . $idSanPham;
if (empty($idSanPham)) {
    echo "Không có ID Sản phẩm!";
    exit();
}

$kho = new quanlikho();
$sql = "SELECT * FROM sanpham WHERE idSanPham = $idSanPham";
$result = $kho->connect()->query($sql);

if ($result->num_rows > 0) {
    $product = $result->fetch_assoc();
     // Gán biến
     $idSanPham=$product['idSanPham'];
     $maSP = $product['maSP'];
     $tensanPham = $product['tensanPham'];
     $donViTinh = $product['donViTinh'];
     $donGia = $product['donGia'];
     $soLuong = $product['soLuong'];
     $moTa = $product['moTa'];
     $trangThai = $product['trangThai'];
     $maQR = $product['maQR'];
    $ngaySanXuat = $product['ngaySanXuat'];
    $hsdChoPhep = $product['HSDChoPhep'];
// Tính hạn sử dụng
    if (!empty($ngaySanXuat) && $hsdChoPhep > 0) {
        $date = new DateTime($ngaySanXuat);
        $date->modify("+$hsdChoPhep days");
        $ngayHetHan = $date->format('d/m/Y');
    } else {
        $ngayHetHan = 'Không xác định';
    }
    
}
?>
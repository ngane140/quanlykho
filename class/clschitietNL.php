<?php
include_once('ketnoi.php');
session_start();
$idNguyenLieu = isset($_GET['id']) ? $_GET['id'] : '';
if (empty($idNguyenLieu)) {
    echo "Không có ID Nguyên Liệu!";
    exit();
}

$kho = new quanlikho();
$sql = "SELECT * FROM nguyenlieu WHERE idNguyenLieu = $idNguyenLieu";
$result = $kho->connect()->query($sql);

if ($result->num_rows > 0) {
    $product = $result->fetch_assoc();
     // Gán biến
     $idNguyenLieu=$product['idNguyenLieu'];
     $maNL = $product['maNL'];
     $tenNguyenLieu = $product['tenNguyenLieu'];
     $donViTinh = $product['donViTinh'];
     $donGia = $product['donGia'];
     $soLuongTon = $product['soLuongTon'];
     $moTa = $product['moTa'];
     $trangThai = $product['trangThai'];
     $maQR = $product['maQR'];
    $ngayNhap = $product['ngayNhap'];
    $hsdChoPhep = $product['HSDChoPhep'];
// Tính hạn sử dụng
    if (!empty($ngayNhap) && $hsdChoPhep > 0) {
        $date = new DateTime($ngayNhap);
        $date->modify("+$hsdChoPhep days");
        $ngayHetHan = $date->format('d/m/Y');
    } else {
        $ngayHetHan = 'Không xác định';
    }
    
}
?>
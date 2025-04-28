<?php
include_once('ketnoi.php'); // Kết nối database
session_start();
$idNguoiDung = isset($_SESSION['user']['id']) ? $_SESSION['user']['id'] : '';

if (empty($idNguoiDung)) {
    echo "Không có id người dùng!";
    exit();
}


// Tạo kết nối
$kho = new quanlikho();


$sql = "SELECT 
            maNL, 
            idNguyenLieu,
            tenNguyenLieu, 
            donViTinh, 
            donGia, 
            soLuongTon, ngayNhap,HSDChoPhep,maQR
        FROM nguyenlieu
        WHERE soLuongTon > 0
        ORDER BY maNL ASC"; 

// Thực thi truy vấn
$result = $kho->connect()->query($sql);

// Xử lý kết quả
$products = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
}


?>

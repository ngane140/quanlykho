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
            maSP, 
            idSanPham,
            tensanPham, 
            donViTinh, 
            donGia, 
            soLuong, ngaySanXuat,HSDChoPhep,maQR
        FROM sanpham
        WHERE soLuong > 0
        ORDER BY maSP ASC"; 

// Thực thi truy vấn
$result = $kho->connect()->query($sql);

// Xử lý kết quả
$products = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
}

// Hiển thị
// foreach ($products as $product) {
//     echo "Mã SP: " . $product['maSP'] . " - ";
//     echo "Tên SP: " . $product['tensanPham'] . " - ";
//     echo "Đơn vị: " . $product['donViTinh'] . " - ";
//     echo "Đơn giá: " . number_format($product['donGia']) . " VNĐ - ";
//     echo "Số lượng: " . $product['soLuong'] . "<br>";
// }
?>

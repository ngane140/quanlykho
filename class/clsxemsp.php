<?php
include_once('ketnoi.php'); 

$kho = new quanlikho(); 

session_start();
$id = isset($_SESSION['user']['id']) ? $_SESSION['user']['id'] : ''; 

// Kiểm tra nếu không có idNguoiDung, chuyển hướng hoặc thông báo lỗi
if (empty($id)) {
    echo "Không có id người dùng!";
    exit(); 
}
// Lấy giá trị filter từ URL nếu có
$filter = isset($_GET['filter']) ? $_GET['filter'] : '';

$sql="SELECT 
    maSP, 
    MIN(tensanPham) AS tensanPham, 
    MIN(donViTinh) AS donViTinh, 
     MIN(donGia) AS donGia,
    SUM(soLuong) AS tongSoLuong
    
FROM sanpham
GROUP BY maSP";
if ($filter === 'available') {
    $sql .= " HAVING SUM(soLuong) > 0";
} elseif ($filter === 'outofstock') {
    $sql .= " HAVING SUM(soLuong) = 0";
}

// Thực hiện truy vấn
$result = $kho->connect()->query($sql);

// Xử lý kết quả
$products = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
}
?>

<?php
include_once('ketnoi.php'); // Đảm bảo bạn đã kết nối với cơ sở dữ liệu

$kho = new quanlikho(); // Lớp kết nối của bạn
// Lấy giá trị của tham số 'id' từ URL
$id = isset($_GET['id']) ? $_GET['id'] : ''; // Nếu không có 'id', gán giá trị rỗng

// Kiểm tra nếu không có id, chuyển hướng hoặc thông báo lỗi
if (empty($id)) {
    echo "Không có id người dùng!";
    exit(); // Dừng thực thi chương trình
}
// Lấy giá trị filter từ URL nếu có
$filter = isset($_GET['filter']) ? $_GET['filter'] : '';
// Xây dựng câu truy vấn SQL theo điều kiện lọc
//$sql = "SELECT * FROM sanpham";
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

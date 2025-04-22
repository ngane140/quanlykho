<?php
include_once('ketnoi.php'); // Kết nối CSDL

$kho = new quanlikho(); // Lớp kết nối

// Lấy giá trị 'id' từ URL
session_start();
$id = isset($_SESSION['user']['id']) ? $_SESSION['user']['id'] : ''; // Kiểm tra xem session có lưu idNguoiDung không

// Kiểm tra nếu không có idNguoiDung, chuyển hướng hoặc thông báo lỗi
if (empty($id)) {
    echo "Không có id người dùng!";
    exit(); // Dừng thực thi chương trình
}

// Lấy giá trị filter từ URL nếu có
$filter = isset($_GET['filter']) ? $_GET['filter'] : '';

// Xây dựng câu truy vấn SQL theo điều kiện lọc
//$sql = "SELECT * FROM nguyenlieu";
$sql="SELECT 
    maNL, 
    MIN(tenNguyenLieu) AS tenNguyenLieu, 
    MIN(donViTinh) AS donViTinh, 
    SUM(soLuongTon) AS tongSoLuongTon
FROM nguyenlieu
GROUP BY maNL";
if ($filter === 'available') {
    $sql .= " HAVING SUM(soLuongTon) > 0";
} elseif ($filter === 'outofstock') {
    $sql .= " HAVING SUM(soLuongTon) = 0";
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
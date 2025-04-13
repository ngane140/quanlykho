<?php
include_once('ketnoi.php'); // Kết nối CSDL

$kho = new quanlikho(); // Lớp kết nối

// Lấy giá trị 'id' từ URL
$id = isset($_GET['id']) ? $_GET['id'] : '';

// Kiểm tra nếu không có id
if (empty($id)) {
    echo "Không có id người dùng!";
    exit();
}

// Lấy giá trị filter từ URL nếu có
$filter = isset($_GET['filter']) ? $_GET['filter'] : '';

// Xây dựng câu truy vấn SQL theo điều kiện lọc
$sql = "SELECT * FROM nguyenlieu";
if ($filter === 'available') {
    $sql .= " WHERE soLuongTon > 0";
} elseif ($filter === 'outofstock') {
    $sql .= " WHERE soLuongTon = 0";
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
<?php
include('../class/ketnoi.php');
$kho = new quanlikho();
$conn = $kho->connect();
// Lấy từ khóa tìm kiếm từ yêu cầu GET
$q = mysqli_real_escape_string($conn, $_GET['q']);

// Kiểm tra xem từ khóa có trống không
if (trim($q) === '') {
    echo json_encode(array()); // Nếu không có từ khóa, trả về mảng rỗng
    exit;
}

// Truy vấn cơ sở dữ liệu để tìm sản phẩm khớp với từ khóa
$sql = "SELECT * FROM sanpham WHERE maSP LIKE '%$q%' OR tensanPham LIKE '%$q%' LIMIT 10";
$result = mysqli_query($conn, $sql);

// Mảng để lưu trữ kết quả
$products =array();
while ($row = mysqli_fetch_assoc($result)) {
    $products[] = $row;
}
    
// Trả về kết quả dưới dạng JSON
echo json_encode($products);
?>

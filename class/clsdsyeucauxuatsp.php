<?php
session_start();
include('ketnoi.php'); 

$id = isset($_SESSION['user']['id']) ? $_SESSION['user']['id'] : ''; 


if (empty($id)) {
    echo "Không có id người dùng!";
    exit(); 
}
$kho = new quanlikho(); 
$conn = $kho->connect(); 
// Truy vấn để lấy danh sách nhân viên kho từ cơ sở dữ liệu

$danhsach = array();
$sql = "SELECT yc.idYeuCauXuatSP, yc.ngayYeuCau, yc.trangThai,kh.hoTen
        FROM yeucauxuatsanpham yc
        JOIN khachhang kh ON yc.idKhachHang = kh.idKhachHang
        ORDER BY yc.ngayYeuCau DESC";
$result = $conn->query($sql);
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $danhsach[] = $row;
    }
}
?>
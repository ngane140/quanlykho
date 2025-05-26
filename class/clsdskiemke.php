<?php
session_start();
include_once('ketnoi.php'); 
$kho = new quanlikho(); 

$id = isset($_SESSION['user']['id']) ? $_SESSION['user']['id'] : ''; 

// Kiểm tra nếu không có idNguoiDung, chuyển hướng hoặc thông báo lỗi
if (empty($id)) {
    echo "Không có id người dùng!";
    exit(); 
}
$conn = $kho->connect(); 
// Truy vấn để lấy danh sách nhân viên kho từ cơ sở dữ liệu

$kiemke = array();
$sql = "SELECT pk.idPhieuKiemKe, pk.maPhieu, pk.ngayKiemKe, nd.hoTen, l.tenLoaiNguoiDung
        FROM phieukiemke pk
        JOIN nguoidung nd ON pk.idNguoiDung = nd.idNguoiDung
        JOIN loainguoidung l ON nd.idLoaiNguoiDung = l.idLoaiNguoiDung";
$result = $conn->query($sql);
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $kiemke[] = $row;
    }
}
?>

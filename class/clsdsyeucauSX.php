<?php
session_start();
include('ketnoi.php'); // Đảm bảo bạn đã kết nối với cơ sở dữ liệu
// Lấy giá trị của tham số 'id' từ URL
$id = isset($_SESSION['user']['id']) ? $_SESSION['user']['id'] : ''; // Kiểm tra xem session có lưu idNguoiDung không

// Kiểm tra nếu không có idNguoiDung, chuyển hướng hoặc thông báo lỗi
if (empty($id)) {
    echo "Không có id người dùng!";
    exit(); // Dừng thực thi chương trình
}
$kho = new quanlikho(); // Lớp kết nối của bạn
$conn = $kho->connect(); // Lấy kết nối từ phương thức connect()
// Truy vấn để lấy danh sách nhân viên kho từ cơ sở dữ liệu

$danhsach = array();
$sql = "SELECT *FROM yeucausanxuatsanpham 
        ORDER BY ngayYeuCau DESC";
$result = $conn->query($sql);
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $danhsach[] = $row;
    }
}
?>
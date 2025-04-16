<?php
include('ketnoi.php'); // Đảm bảo bạn đã kết nối với cơ sở dữ liệu
// Lấy giá trị của tham số 'id' từ URL
$id = isset($_GET['id']) ? $_GET['id'] : ''; // Nếu không có 'id', gán giá trị rỗng

// Kiểm tra nếu không có id, chuyển hướng hoặc thông báo lỗi
if (empty($id)) {
    echo "Không có id người dùng!";
    exit(); // Dừng thực thi chương trình
}
$kho = new quanlikho(); // Lớp kết nối của bạn
$conn = $kho->connect(); // Lấy kết nối từ phương thức connect()
// Truy vấn để lấy danh sách nhân viên kho từ cơ sở dữ liệu

$danhsach = array();
$sql = "SELECT yc.idYeuCauXuatSP, yc.ngayYeuCau, yc.trangThai,kh.hoTen
        FROM yeucauxuatsanpham yc
        JOIN khachhang kh ON yc.idKhachHang = kh.idKhachHang";
$result = $conn->query($sql);
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $danhsach[] = $row;
    }
}
?>

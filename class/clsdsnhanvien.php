<?php
session_start();
include_once('ketnoi.php'); // Đảm bảo bạn đã kết nối với cơ sở dữ liệu
$kho = new quanlikho(); // Lớp kết nối của bạn
// Lấy giá trị của tham số 'id' từ URL
$id = isset($_SESSION['user']['id']) ? $_SESSION['user']['id'] : ''; // Kiểm tra xem session có lưu idNguoiDung không

// Kiểm tra nếu không có idNguoiDung, chuyển hướng hoặc thông báo lỗi
if (empty($id)) {
    echo "Không có id người dùng!";
    exit(); // Dừng thực thi chương trình
}


// Truy vấn để lấy danh sách nhân viên kho từ cơ sở dữ liệu
$sql = "SELECT * FROM nguoidung WHERE idLoaiNguoiDung = 3";  
$conn = $kho->connect(); // Lấy kết nối từ phương thức connect()

// Kiểm tra nếu kết nối thành công trước khi thực hiện truy vấn
if ($conn) {
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $employees = array(); // Khởi tạo mảng rỗng
        while ($row = $result->fetch_assoc()) {
            $employees[] = $row;  // Thêm từng dòng dữ liệu vào mảng
        }
    } else {
        $employees = array(); // Nếu không có dữ liệu, tạo mảng trống
    }
} else {
    echo "Không thể kết nối cơ sở dữ liệu!";
    exit(); // Dừng thực thi nếu không thể kết nối
}

?>

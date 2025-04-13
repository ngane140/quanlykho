<?php
include_once('ketnoi.php'); // Đảm bảo bạn đã kết nối với cơ sở dữ liệu
// Lấy giá trị của tham số 'id' từ URL
$id = isset($_GET['id']) ? $_GET['id'] : ''; // Nếu không có 'id', gán giá trị rỗng

// Kiểm tra nếu không có id, chuyển hướng hoặc thông báo lỗi
if (empty($id)) {
    echo "Không có id người dùng!";
    exit(); // Dừng thực thi chương trình
}
$kho = new quanlikho(); // Lớp kết nối của bạn

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

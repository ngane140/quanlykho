<?php
include_once('ketnoi.php'); // Đường dẫn đúng đến lớp quanlikho
$kho = new quanlikho();
// Lấy giá trị của tham số 'id' từ URL
$id = isset($_GET['id']) ? $_GET['id'] : ''; // Nếu không có 'id', gán giá trị rỗng
// Kiểm tra xem id có hợp lệ hay không (nếu không phải số)
if (!empty($id) && is_numeric($id)) {
    // Lấy thông tin nhân viên và loại người dùng
    $sql = "SELECT n.idNguoiDung, n.username, n.password, n.idLoaiNguoiDung, n.trangThai, 
                   n.hoTen, n.SDT, n.email, n.diaChi, n.ngaysinh, l.tenLoaiNguoiDung 
            FROM nguoidung n 
            JOIN loainguoidung l ON n.idLoaiNguoiDung = l.idLoaiNguoiDung 
            WHERE n.idNguoiDung = '$id'";

    $result = $kho->connect()->query($sql);
    if ($result) {
        $row = $result->fetch_assoc();
    } else {
        echo "Không tìm thấy nhân viên với mã số này.";
        exit();
    }
} else {
    echo "Mã nhân viên không hợp lệ.";
    exit();
}
?>
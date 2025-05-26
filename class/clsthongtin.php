<?php
include_once('ketnoi.php'); 
$kho = new quanlikho();

session_start();
$id = isset($_SESSION['user']['id']) ? $_SESSION['user']['id'] : ''; 


if (empty($id)) {
    echo "Không có id người dùng!";
    exit(); 
}
// Kiểm tra xem id có hợp lệ hay không (nếu không phải số)
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

?>
<?php
session_start();
include("ketnoi.php");
$id = isset($_SESSION['user']['id']) ? $_SESSION['user']['id'] : ''; 


if (empty($id)) {
    echo "Không có id người dùng!";
    exit(); 
}

// Hàm lấy mã nhân viên mới
function getNewUsername() {
    $kho = new quanlikho();
    $conn = $kho->connect();

    if ($conn) {
        // Lấy mã nhân viên cuối cùng
        $sql = "SELECT username FROM nguoidung WHERE username LIKE 'NVK%' ORDER BY username DESC LIMIT 1";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Lấy mã nhân viên cuối cùng và tăng số lên
            $row = $result->fetch_assoc();
            $lastUsername = $row['username'];
            $newId = intval(substr($lastUsername, 3)) + 1; // Lấy phần số từ mã nhân viên và tăng thêm 1
        } else {
            // Nếu chưa có mã nhân viên nào, bắt đầu từ 1
            $newId = 1;
        }

        // Tạo mã nhân viên mới
        $newUsername = "NVK" . str_pad($newId, 3, "0", STR_PAD_LEFT); // Đảm bảo mã có 4 chữ số

        return $newUsername;
    } else {
        echo "Không thể kết nối cơ sở dữ liệu!";
        return null;
    }
}
$newUsername = getNewUsername();

// Biến để lưu thông báo lỗi
$errorMessage = '';

// Kiểm tra xem form đã được gửi chưa
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = '1'; // Đặt mật khẩu mặc định là '1'
    $hoTen = $_POST['hoTen'];
    $SDT = $_POST['SDT'];
    $email = $_POST['email'];
    $diaChi = $_POST['diaChi'];
    $ngaysinh = $_POST['ngaysinh'];
    $trangThai = '1';

    // Tạo đối tượng quản lý nhân viên và gọi phương thức thêm nhân viên
    $kho = new quanlikho();
    $conn = $kho->connect();

    if ($conn) {
        // Kiểm tra xem SDT có bị trùng không
        $checkSDT = "SELECT * FROM nguoidung WHERE SDT = '$SDT'";
        $checkSDTResult = $conn->query($checkSDT);

        if ($checkSDTResult->num_rows > 0) {
            $errorMessage = 'Số điện thoại đã tồn tại trong hệ thống!';
        } else {
            // Kiểm tra xem email có bị trùng không
            $checkEmail = "SELECT * FROM nguoidung WHERE email = '$email'";
            $checkEmailResult = $conn->query($checkEmail);

            if ($checkEmailResult->num_rows > 0) {
                $errorMessage = 'Email đã tồn tại trong hệ thống!';
            } else {
                // Mã hóa mật khẩu với MD5
                $hashedPassword = md5($password); // Sử dụng MD5 để mã hóa mật khẩu

                // Câu lệnh SQL để thêm nhân viên mới vào cơ sở dữ liệu
                $sql = "INSERT INTO nguoidung (username, password, hoTen, SDT, email, diaChi, ngaysinh, trangThai, idLoaiNguoiDung) 
                        VALUES ('$username', '$hashedPassword', '$hoTen', '$SDT', '$email', '$diaChi', '$ngaysinh', '$trangThai', 3)";

                if ($conn->query($sql) === TRUE) {
                    echo "<script>alert('Thêm nhân viên thành công!'); window.location.href='quanlinv.php';</script>";
                } else {
                    $errorMessage = "Lỗi: " . $sql . "<br>" . $conn->error;
                }
            }
        }
    } else {
        $errorMessage = "Không thể kết nối cơ sở dữ liệu!";
    }
}
?>
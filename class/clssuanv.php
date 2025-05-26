<?php
include_once('ketnoi.php'); 

// Kiểm tra kết nối và ID nhân viên
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$kho = new quanlikho(); 
$conn = $kho->connect();

// Biến để chứa thông báo lỗi
$errorMessage = "";

if ($conn && $id > 0) {
    $sql = "SELECT * FROM nguoidung WHERE idNguoiDung = $id AND idLoaiNguoiDung = 3"; 
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $employee = $result->fetch_assoc();
    } else {
        echo "Không tìm thấy nhân viên!";
        exit();
    }
} else {
    echo "Lỗi kết nối hoặc ID không hợp lệ!";
    exit();
}

// Kiểm tra nếu người dùng gửi form sửa
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $hoTen = $_POST['hoTen'];
    $SDT = $_POST['SDT'];
    $email = $_POST['email'];
    $diaChi = $_POST['diaChi'];
    $ngaysinh = $_POST['ngaysinh'];
    $newUsername = $_POST['username'];  // Mã nhân viên mới

    // Kiểm tra tiền tố mã nhân viên có phải là NVK không
    $prefix = "NVK"; 
    if (substr($newUsername, 0, strlen($prefix)) != $prefix) {
        $errorMessage = "Mã nhân viên phải bắt đầu bằng 'NVK'!";
    } else {
        // Kiểm tra nếu phần số mới không bị trùng với mã đã có trong cơ sở dữ liệu
        $number = substr($newUsername, strlen($prefix)); // Lấy phần số từ mã nhân viên (sau "NVK")

        // Kiểm tra mã nhân viên mới có tồn tại không
        $check_sql = "SELECT * FROM nguoidung WHERE username LIKE '$prefix$number' AND idNguoiDung != $id";
        $check_result = $conn->query($check_sql);

        if ($check_result->num_rows > 0) {
            $errorMessage = "Mã nhân viên này đã tồn tại, vui lòng chọn mã khác!";
        } else {
            // Kiểm tra số điện thoại có bị trùng với nhân viên khác không
            $checkSDT = "SELECT * FROM nguoidung WHERE SDT = '$SDT' AND idNguoiDung != $id";
            $checkSDTResult = $conn->query($checkSDT);

            if ($checkSDTResult->num_rows > 0) {
                $errorMessage = "Số điện thoại này đã tồn tại trong hệ thống!";
            } else {
                // Kiểm tra email có bị trùng với nhân viên khác không
                $checkEmail = "SELECT * FROM nguoidung WHERE email = '$email' AND idNguoiDung != $id";
                $checkEmailResult = $conn->query($checkEmail);

                if ($checkEmailResult->num_rows > 0) {
                    $errorMessage = "Email này đã tồn tại trong hệ thống!";
                } else {
                    // Cập nhật thông tin nhân viên
                    $update_sql = "UPDATE nguoidung SET username='$newUsername', hoTen='$hoTen', SDT='$SDT', email='$email', diaChi='$diaChi', ngaysinh='$ngaysinh' WHERE idNguoiDung = $id";
                    
                    if ($conn->query($update_sql) === TRUE) {
                        echo "<script>alert('cập nhật nhân viên thành công!'); window.location.href='quanlinv.php';</script>";
                    } else {
                        $errorMessage = "Lỗi: " . $conn->error;
                    }
                }
            }
        }
    }
}
?>
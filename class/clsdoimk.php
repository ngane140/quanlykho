<?php
session_start(); // Khởi tạo session để sử dụng thông báo
include_once('ketnoi.php'); // Đảm bảo bạn đã kết nối với cơ sở dữ liệu

$kho = new quanlikho();

// // Lấy giá trị của tham số 'id' từ URL
// $id = isset($_GET['id']) ? $_GET['id'] : ''; // Nếu không có 'id', gán giá trị rỗng

// // Kiểm tra nếu không có id, chuyển hướng hoặc thông báo lỗi
// if (empty($id)) {
//     echo "Không có id người dùng!";
//     exit(); // Dừng thực thi chương trình
// }
// Lấy idNguoiDung từ session
session_start();
$id = isset($_SESSION['user']['id']) ? $_SESSION['user']['id'] : ''; // Kiểm tra xem session có lưu idNguoiDung không

// Kiểm tra nếu không có idNguoiDung, chuyển hướng hoặc thông báo lỗi
if (empty($id)) {
    echo "Không có id người dùng!";
    exit(); // Dừng thực thi chương trình
}
// Lấy thông tin người dùng từ cơ sở dữ liệu theo id
$sql = "SELECT * FROM nguoidung WHERE idNguoiDung = '$id'";
$result = $kho->connect()->query($sql);
if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    echo "Không tìm thấy người dùng với id này!";
    exit(); // Dừng nếu không tìm thấy người dùng
}
$message = ""; // Biến để lưu thông báo
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Lấy dữ liệu từ form
    $oldPassword = $_POST['oldPassword'];
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];

    // Kiểm tra mật khẩu cũ có đúng không
    if ($user['password']!= md5($oldPassword)) {
        $_SESSION['message'] = "Mật khẩu cũ không đúng!"; // Lưu thông báo vào session
    } else {
        // Kiểm tra mật khẩu mới và xác nhận mật khẩu có khớp không
        if ($newPassword != $confirmPassword) {
            $_SESSION['message'] = "Mật khẩu mới và xác nhận mật khẩu không khớp!";
        } else {
            // Cập nhật mật khẩu mới vào cơ sở dữ liệu
            $newPasswordHash = md5($newPassword); // Mã hóa mật khẩu mới
            $updateSql = "UPDATE nguoidung SET password = '$newPasswordHash' WHERE idNguoiDung = '$id'";
            if ($kho->connect()->query($updateSql)) {
                $_SESSION['message'] = "Mật khẩu đã được thay đổi thành công!";
            } else {
                $_SESSION['message']= "Lỗi khi thay đổi mật khẩu!";
            }
        }
    }
     // Redirect để tránh gửi lại form khi refresh
     header("Location: ".$_SERVER['PHP_SELF']);
     exit();
}
// Hiển thị thông báo nếu có
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    unset($_SESSION['message']); // Xóa thông báo sau khi hiển thị
}
?>

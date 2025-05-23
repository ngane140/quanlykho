<?php
include('ketnoi.php');
session_start();
$db = new quanlikho(); // Tạo đối tượng từ class
$conn = $db->connect(); // Lấy kết nối MySQLi

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = md5($_POST['password']); // Mã hóa MD5 như trong CSDL

    // Chuẩn bị truy vấn
    $stmt = $conn->prepare("SELECT idNguoiDung, username, hoTen, idLoaiNguoiDung FROM nguoidung WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password); // Gán giá trị biến
    $stmt->execute(); // Thực thi

    // Gán kết quả vào biến
    $stmt->bind_result($id, $uname, $hoTen, $loaiNguoiDung);

    if ($stmt->fetch()) {
        $_SESSION['user'] = array(
            'id' => $id,
            'username' => $uname,
            'fullname' => $hoTen,
            'role' => $loaiNguoiDung
        );

        // Chuyển hướng dựa trên vai trò
        switch ($loaiNguoiDung) {
            case 1: header('Location: QLkho/index.php'); break;
            case 2: header('Location: QlSanxuat/index.php'); break;
            case 3: header('Location: NVkho/index.php'); break;
            case 4: header('Location: NVbanhang/index.php'); break;
            default: header('Location: login.php'); break;
        }
        exit();
    } else {
        $error = "Tên đăng nhập hoặc mật khẩu không đúng";
    }
}

?>
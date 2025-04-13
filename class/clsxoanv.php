<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
include("ketnoi.php");

$id = isset($_GET['id']) ? intval($_GET['id']) : '';
// Kiểm tra nếu không có id, chuyển hướng hoặc thông báo lỗi
if (empty($id)) {
    echo "Không có id người dùng!";
    exit(); // Dừng thực thi chương trình
}
$kho = new quanlikho(); 
$conn = $kho->connect();

if ($conn && $id > 0) {
    $sql = "DELETE FROM nguoidung WHERE idNguoiDung = $id AND idLoaiNguoiDung = 3";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Xóa nhân viên thành công!'); window.location.href='../QLkho/quanlinv.php';</script>";
      
    } else {
        echo "Lỗi khi xóa: " . $conn->error;
    }
} else {
    echo "Lỗi kết nối hoặc ID không hợp lệ!";
}
?>
</body>
</html>

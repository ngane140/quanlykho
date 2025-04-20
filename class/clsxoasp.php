<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xóa Sản Phẩm</title>
</head>
<body>
<?php
include("ketnoi.php");


$id = isset($_GET['maSP']) ?($_GET['maSP']) : '';
// Kiểm tra nếu không có id, chuyển hướng hoặc thông báo lỗi
if (empty($id)) {
    echo "Không có id người dùng!";
    exit(); // Dừng thực thi chương trình
}
$kho = new quanlikho();
$conn = $kho->connect();

if ($conn && !empty($id)) {
            $sqlDeleteProduct = "DELETE FROM sanpham WHERE maSP = '$id'";
            if ($conn->query($sqlDeleteProduct) === TRUE) {
                echo "<script>alert('Xóa sản phẩm thành công!'); window.location.href='../QLkho/theodoisp.php';</script>";
            } else {
                echo "Lỗi khi xóa sản phẩm: " . $conn->error;
            }
        } else {
            echo "Bạn không có quyền xóa sản phẩm!";
        }
?>
</body>
</html>

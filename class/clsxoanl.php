<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xóa Nguyên Liệu</title>
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
            $sqlDeleteProduct = "DELETE FROM nguyenlieu WHERE idNguyenLieu = $id";
            if ($conn->query($sqlDeleteProduct) === TRUE) {
                echo "<script>alert('Xóa nguyên liệu thành công!'); window.location.href='../QLkho/theodoiNL.php';</script>";
            } else {
                echo "Lỗi khi xóa nguyên liệu: " . $conn->error;
            }
        } else {
            echo "Bạn không có quyền xóa nguyên liệu!";
        }
?>
</body>
</html>

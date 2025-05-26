<?php
include('../class/ketnoi.php');
require_once '../check_login3.php';
include("../phpqrcode/qrlib.php"); // Thư viện PHP QR Code


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idNguyenLieu = isset($_POST['idNguyenLieu']) ? $_POST['idNguyenLieu'] : '';
    if (empty($idNguyenLieu)) {
        echo "Không có ID Nguyên Liệu!";
        exit();
    }
    // Lấy thông tin từ form
    $maNL=$_POST['maNL'];
    $tenNguyenLieu = $_POST['tenNguyenLieu'];
    $donGia = $_POST['donGia'];
    $soLuongTon = $_POST['soLuongTon'];
    $donViTinh=$_POST['donViTinh'];
    $ngayNhap = $_POST['ngayNhap'];
    $ngayHetHan = $_POST['ngayHetHan'];
    $moTa = $_POST['moTa'];
    

    // Chuẩn bị thông tin sản phẩm
    $productInfo = "ID Nguyên liệu: " . $idNguyenLieu . "\n";
    $productInfo = "Mã Nguyên liệu: " . $maNL . "\n";
    $productInfo .= "Tên Nguyên liệu: " . $tenNguyenLieu . "\n";
    $productInfo .= "Đơn giá: " . number_format($donGia, 0, ',', '.') . " VNĐ\n";
    $productInfo .= "Ngày nhập: " . date('d/m/Y', strtotime($ngayNhap)) . "\n";
    $productInfo .= "Hạn sử dụng: " . $ngayHetHan . "\n";
    $productInfo .= "Mô tả: " . (!empty($moTa) ? $moTa : 'Không có mô tả');

    // Mã hóa thông tin sản phẩm
   
    $filename = 'qrcodesNL/' . $idNguyenLieu . '.png'; // Đường dẫn lưu file QR
   
    // Tạo mã QR và lưu vào thư mục qrcodes
    QRcode::png($productInfo, $filename, 'L', 4, 2);
    $kho = new quanlikho();
    $maQR = $idNguyenLieu . '.png';
$conn = $kho->connect(); // kết nối
$query = "UPDATE nguyenlieu SET maQR = ? WHERE idNguyenLieu = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('si', $filename, $idNguyenLieu); // s: string, i: integer
    if ($stmt->execute()) {
        // Sau khi cập nhật, chuyển hướng về trang chi tiết sản phẩm với mã QR
        header("Location: xemchitietNL.php?id=" . $idNguyenLieu);
        exit();
    } else {
        echo "Có lỗi xảy ra khi cập nhật mã QR.";
    }
}
?>
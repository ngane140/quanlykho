<?php
include('../class/ketnoi.php');
require_once '../check_login.php';
include("../phpqrcode/qrlib.php"); // Thư viện PHP QR Code


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idSanPham = isset($_POST['idSanPham']) ? $_POST['idSanPham'] : '';
    if (empty($idSanPham)) {
        echo "Không có ID Sản phẩm!";
        exit();
    }
    // Lấy thông tin từ form
    $maSP=$_POST['maSP'];
    $tensanPham = $_POST['tensanPham'];
    $donGia = $_POST['donGia'];
    $soLuong = $_POST['soLuong'];
    $donViTinh=$_POST['donViTinh'];
    $ngaySanXuat = $_POST['ngaySanXuat'];
    $ngayHetHan = $_POST['ngayHetHan'];
    $moTa = $_POST['moTa'];
    

    // Chuẩn bị thông tin sản phẩm
    $productInfo = "ID SP: " . $idSanPham . "\n";
    $productInfo = "Mã sản phẩm: " . $maSP . "\n";
    $productInfo .= "Tên sản phẩm: " . $tensanPham . "\n";
    $productInfo .= "Đơn giá: " . number_format($donGia, 0, ',', '.') . " VNĐ\n";
    $productInfo .= "Ngày sản xuất: " . date('d/m/Y', strtotime($ngaySanXuat)) . "\n";
    $productInfo .= "Hạn sử dụng: " . $ngayHetHan . "\n";
    $productInfo .= "Mô tả: " . (!empty($moTa) ? $moTa : 'Không có mô tả');

    // Mã hóa thông tin sản phẩm
   // $qrContent = urlencode($productInfo); // Mã hóa thông tin sản phẩm
    $filename = 'qrcodes/' . $idSanPham . '.png'; // Đường dẫn lưu file QR
   
    // Tạo mã QR và lưu vào thư mục qrcodes
    QRcode::png($productInfo, $filename, 'L', 4, 2);
    $kho = new quanlikho();
    $maQR = $idSanPham . '.png';
$conn = $kho->connect(); // kết nối
$query = "UPDATE sanpham SET maQR = ? WHERE idSanPham = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('si', $filename, $idSanPham); // s: string, i: integer
    if ($stmt->execute()) {
        // Sau khi cập nhật, chuyển hướng về trang chi tiết sản phẩm với mã QR
        header("Location: xemchitietsp.php?id=" . $idSanPham);
        exit();
    } else {
        echo "Có lỗi xảy ra khi cập nhật mã QR.";
    }
}
?>
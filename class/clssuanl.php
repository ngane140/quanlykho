<?php
include('ketnoi.php'); // Kết nối cơ sở dữ liệu

// Kiểm tra kết nối và ID sản phẩm
$id = isset($_GET['id']) ? intval($_GET['id']) : '';
$kho = new quanlikho(); 
$conn = $kho->connect();

// Biến để chứa thông báo lỗi
$errorMessage = "";

if ($conn && $id > 0) {
    $sql = "SELECT * FROM nguyenlieu WHERE idNguyenLieu = $id "; 
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
    } else {
        echo "Không tìm thấy Nguyên Liệu!";
        exit();
    }
} else {
    echo "Lỗi kết nối hoặc ID không hợp lệ!";
    exit();
}

// Kiểm tra nếu người dùng gửi form sửa
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $NewMaterialCode = $_POST['maNL']; // Mã sản phẩm không thay đổi
    $tenNguyenLieu = $_POST['tenNguyenLieu']; 
    $moTa = $_POST['moTa'];
    $donGia = $_POST['donGia'];
    $donViTinh = $_POST['donViTinh'];
    $soLuongTon = $_POST['soLuongTon']; // Cập nhật số lượng
    $maQR = $_POST['maQR'];
    $trangThai = $_POST['trangThai']; // Trạng thái sản phẩm
    $ngayNhap=$_POST['ngayNhap'];
    $HSDChoPhep=$_POST['HSDChoPhep'];

    // Kiểm tra giá sản phẩm phải lớn hơn 1000
    if ($donGia < 1000) {
        $errorMessage = 'Giá Nguyên liệu phải lớn hơn 1000!';
    } else {
        // Câu lệnh SQL để cập nhật sản phẩm
        $sql = "UPDATE nguyenlieu
        SET maNL='$NewMaterialCode', tenNguyenLieu='$tenNguyenLieu', moTa='$moTa', donGia='$donGia', donViTinh='$donViTinh',HSDChoPhep='$HSDChoPhep'
        WHERE idNguyenLieu = $id";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Cập nhật Nguyên liệu thành công!'); window.location.href='theodoiNL.php';</script>";
        } else {
            $errorMessage = "Lỗi: " . $conn->error;
        }
    }
}
?>

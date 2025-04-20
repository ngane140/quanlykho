<?php
include('ketnoi.php'); // Kết nối cơ sở dữ liệu

// Kiểm tra kết nối và ID sản phẩm
$maSP = isset($_GET['maSP']) ? $_GET['maSP'] : '';
$kho = new quanlikho(); 
$conn = $kho->connect();

// Biến để chứa thông báo lỗi
$errorMessage = "";

if ($conn &&  $maSP !== '') {
    $sql = "SELECT * FROM sanpham WHERE maSP = '$maSP'"; 
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
    } else {
        echo "Không tìm thấy sản phẩm!";
        exit();
    }
} else {
    echo "Lỗi kết nối hoặc ID không hợp lệ!";
    exit();
}

// Kiểm tra nếu người dùng gửi form sửa
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tensanPham = $_POST['tensanPham']; 
    $moTa = $_POST['moTa'];
    $donGia = $_POST['donGia'];
    $donViTinh = $_POST['donViTinh'];
    $soLuong = $_POST['soLuong']; // Cập nhật số lượng
    $maQR = $_POST['maQR'];
    $trangThai = $_POST['trangThai']; // Trạng thái sản phẩm
    $ngaySanXuat=$_POST['ngaySanXuat'];
    $HSDChoPhep=$_POST['HSDChoPhep'];

    // Kiểm tra giá sản phẩm phải lớn hơn 1000
    if ($donGia < 1000) {
        $errorMessage = 'Giá sản phẩm phải lớn hơn 1000!';
    } else {
        // Câu lệnh SQL để cập nhật sản phẩm
        $sql = "UPDATE sanpham 
        SET  tensanPham='$tensanPham', moTa='$moTa', donGia='$donGia', donViTinh='$donViTinh',HSDChoPhep='$HSDChoPhep'
        WHERE  maSP = '$maSP'";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Cập nhật sản phẩm thành công!'); window.location.href='theodoisp.php';</script>";
        } else {
            $errorMessage = "Lỗi: " . $conn->error;
        }
    }
}
?>

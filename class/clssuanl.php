<?php
include('ketnoi.php'); // Kết nối cơ sở dữ liệu

// Lấy mã nguyên liệu từ URL
$maNL = isset($_GET['maNL']) ? $_GET['maNL'] : '';
$kho = new quanlikho(); 
$conn = $kho->connect();

// Biến chứa thông báo lỗi
$errorMessage = "";

// Lấy thông tin nguyên liệu nếu mã hợp lệ
if ($conn && $maNL !== '') {
    $sql = "SELECT * FROM nguyenlieu WHERE maNL = '$maNL'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
    } else {
        echo "Không tìm thấy Nguyên Liệu!";
        exit();
    }
} else {
    echo "Lỗi kết nối hoặc mã nguyên liệu không hợp lệ!";
    exit();
}

// Xử lý khi người dùng gửi form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form
    $tenNguyenLieu = $_POST['tenNguyenLieu']; 
    $moTa = $_POST['moTa'];
    $donGia = $_POST['donGia'];
    $donViTinh = $_POST['donViTinh'];
    $HSDChoPhep = $_POST['HSDChoPhep'];

    // Kiểm tra giá
    if ($donGia < 1000) {
        $errorMessage = 'Giá Nguyên liệu phải lớn hơn 1000!';
    } else {
        // Cập nhật thông tin nguyên liệu
        $sql = "UPDATE nguyenlieu 
                SET tenNguyenLieu='$tenNguyenLieu', moTa='$moTa', donGia='$donGia', 
                    donViTinh='$donViTinh', HSDChoPhep='$HSDChoPhep' 
                WHERE maNL = '$maNL'";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Cập nhật Nguyên liệu thành công!'); window.location.href='theodoiNL.php';</script>";
            exit();
        } else {
            $errorMessage = "Lỗi khi cập nhật: " . $conn->error;
        }
    }
}
?>